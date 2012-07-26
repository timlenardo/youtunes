<?php

/*
 * Example implementation of the server-side form handling for DataTables Editor using
 * the mysql_* function in PHP.
 *
 * This is a port of the "DTF.pdo.class.php" file which uses the mysql_ functions
 * rather than PDO. Useful if you don't have PDO installed on your server.
 * 
 * Note that the examples use the PDO version by default - if you wish to use this
 * script with the examples, you'll need to modify the includes.
 */


include( "DTField.class.php" );
include( "DTFormat.class.php" );
include( "DTValidate.class.php" );


/**
 * DataTables Editor class - This class provides everything that is needed for a
 * full CRUD table using DataTables and Editor, on a single database table (note that
 * currently it does not support linked tables).
 *  @param resource $db The MySQL DB handle to use
 *  @param string $table The table name in the database to use for the CRUD table
 *  @param string $primaryKey Primary key column name in the table
 *  @param string $primaryKeyPrefix Prefix to add to the primary key to make it a
 *    valid DOM ID (i.e. must start with a letter), and also useful for cases where
 *    multiple Editor tables are used on a single page to ensure uniqueness of row IDs
 *  @param array $fields An array of DTField objects defining the filed to get and
 *    set, including formatting, validation etc, for the table / form.
 */
class DTEditor {
	private $_db = null;
	private $_primaryKey = "";
	private $_primaryKeyPrefix = "";
	private $_table = "";
	private $_fields = array();
	private $_out = array(
		"id" => -1,
		"error" => "",
		"fieldErrors" => array(),
		"data" => array()
	);


	function __construct( $db, $table, $primaryKey, $primaryKeyPrefix, $fields )
	{
		$this->_db = $db;
		$this->_table = $table;
		$this->_primaryKey = $primaryKey;
		$this->_primaryKeyPrefix = $primaryKeyPrefix;
		$this->_fields = $fields;
	}


	/**
	 * Process a request from DataTables to get data, or from Editor to set it
	 *  @param array $data $_POST or $_GET as required by what is sent by Editor
	 *  @return array Array that should be JSON encoded and sent back to Editor
	 */
	public function process ( $data )
	{
		$this->_formData = isset($data['data']) ? $data['data'] : null;

		if ( !isset($data['action']) ) {
			/* Get data */
			$this->_get();
		}
		else if ( $data['action'] == "remove" ) {
			/* Remove rows */
			$this->_remove( $data );
		}
		else {
			/* Create or edit row */

			// Individual field validation
			for ( $i=0 ; $i<count($this->_fields) ; $i++ ) {
				$field = $this->_fields[$i];
				$validation = $field->validate( $this->_formData );

				if ( $validation !== true ) {
					$this->_out['fieldErrors'][] = array(
						"name" => $field->name,
						"status" => $validation
					);
				}
			}

			// Global validation
			$this->_out['error'] = "";

			// Global validation - if you want global validation - do it here
			$this->_out['error'] = "";

			if ( count($this->_out['fieldErrors']) === 0 ) {
				if ( $data['action'] == "create" ) {
					$this->_insert();
				}
				else {
					$this->_update( $data['id'] );
				}
			}
		}

		return $this->_out;
	}


	/**
	 * Get an array of objects from the database to be given to DataTables as a
	 * result of an sAjaxSource request, such that DataTables can display the information
	 * from the DB in the table.
	 *  @private
	 */
	private function _get()
	{
		$fields = array();
		$fields[] = '`'.$this->_primaryKey.'`';
		for ( $i=0 ; $i<count($this->_fields) ; $i++ ) {
			$field = $this->_fields[$i];

			if ( $field->apply( 'get' ) ) {
				$fields[] = '`'.$field->dbField.'`';
			}
		}

		$sql = 
			"SELECT ".implode(", ", $fields)."
			 FROM {$this->_table}";
		$res = $this->_execute( $sql );
		if ( ! $res ) {
			return;
		}

		$this->_out['aaData'] = array();
		while ( $row=mysql_fetch_assoc( $res ) ) {
			$inner = array();
			$inner['DT_RowId'] = $this->_primaryKeyPrefix . $row[ $this->_primaryKey ];

			for ( $i=0 ; $i<count($this->_fields) ; $i++ ) {
				$field = $this->_fields[$i];
				if ( $field->apply('get') ) {
					$inner[ $field->name ] = $field->val('get', $row);
				}
			}

			$this->_out['aaData'][] = $inner;
		}
	}


	/**
	 * Insert a new row in the database
	 *  @private
	 */
	private function _insert( )
	{
		$fields = array();
		$values = array();
		for ( $i=0 ; $i<count($this->_fields) ; $i++ ) {
			$field = $this->_fields[$i];

			if ( $field->apply( 'set', $this->_formData ) ) {
				$fields[] = $field->dbField;
				$values[] = mysql_real_escape_string( $field->val('set', $this->_formData) );
			}
		}

		$sql = 
			"INSERT INTO {$this->_table} 
				(`".implode("`, `", $fields)."`)
			VALUES
				('".implode("', '", $values)."')";
		$res = $this->_execute( $sql );
		if ( ! $res ) {
			return;
		}

		$id = mysql_insert_id();

		// Dynamic get for fields which might have been updated on the DB
		$this->_dynamicGet( $id );

		$this->_out['id'] = $this->_primaryKeyPrefix . $id;
	}


	/**
	 * Update a row in the database
	 *  @private
	 */
	private function _update( $id )
	{
		$fields = array();
		for ( $i=0 ; $i<count($this->_fields) ; $i++ ) {
			$field = $this->_fields[$i];

			if ( $field->apply( 'set', $this->_formData ) ) {
				$fields[] =
					$field->dbField." = '".
					mysql_real_escape_string( $field->val('set', $this->_formData) )."'";
			}
		}

		$id = intval(str_replace($this->_primaryKeyPrefix, "", $id));
		$sql = 
			"UPDATE {$this->_table} 
			 SET ".implode(", ", $fields)."
			 WHERE {$this->_primaryKey} = {$id}";
		$res = $this->_execute( $sql );
		if ( ! $res ) {
			return;
		}

		// Dynamic get for fields which might have been updated on the DB
		$this->_dynamicGet( $id );

		$this->_out['id'] = $this->_primaryKeyPrefix . $id;
	}


	/**
	 * Delete one or more rows from the database
	 *  @private
	 */
	private function _remove( )
	{
		$values = array();
		for ( $i=0 ; $i<count($this->_formData) ; $i++ ) {
			$id = intval(str_replace($this->_primaryKeyPrefix, "", $this->_formData[$i]));
			$values[] = $this->_primaryKey .' = '. mysql_real_escape_string( intval($id) );
		}

		$sql = 
			"DELETE FROM {$this->_table} 
			 WHERE (".implode(" OR ", $values).")";
		$res = $this->_execute( $sql );
		if ( ! $res ) {
			return;
		}
	}
	

	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Support methods
	 */


	/**
	 * Get values from the row after an insert or edit action
	 *  @private
	 */
	private function _dynamicGet( $id )
	{
		$fields = array();

		for ( $i=0 ; $i<count($this->_fields) ; $i++ ) {
			$field = $this->_fields[$i];

			if ( $field->dynamicGet ) {
				$fields[] = '`'.$field->dbField.'`';
			}
		}

		if ( count( $fields ) === 0 ) {
			return;
		}

		$sql = 
			"SELECT ".implode(", ", $fields)."
			 FROM {$this->_table}
			 WHERE {$this->_primaryKey} = ".mysql_real_escape_string($id);
		$res = $this->_execute( $sql );
		if ( ! $res ) {
			return;
		}

		$row = mysql_fetch_assoc( $res );
		
		for ( $i=0 ; $i<count($this->_fields) ; $i++ ) {
			$field = $this->_fields[$i];

			if ( $field->dynamicGet ) {
				$this->_out['data'][ $field->name ] = $field->val('get', $row);
			}
		}
	}


	/**
	 * Execute an SQL query
	 *  @private
	 */
	private function _execute( $sql ) {
		$res = mysql_query( $sql );
		if ( $res === false ) {
			$this->_out['error'] = "An SQL error occurred: ".mysql_error();
			return false;
		}

		return $res;
	}
}



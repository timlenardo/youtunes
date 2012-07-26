<?php


/**
 * Field definitions for the DataTables Editor
 *
 * The constructor takes only a single parameter, but is is an array of options
 * which you can specify as needed for your field:
 *  @param array $inOpts 
 *     Array of input options which are:
 *  @param string $inOpts.dbField 
 *     Database column name to associate with the field
 *  @param string $inOpts.name 
 *     Name of the field that will be used in the JSON sent to DataTables in a GET 
 *     and returned from the Editor in a POST
 *  @param boolean $inOpts.get 
 *     Should this field be included in a data GET
 *  @param boolean $inOpts.set 
 *     Should this field be included in a POST
 *  @param boolean $inOpts.dynamicGet 
 *     Should the value of this field be read from the DB and returned when a create 
 *     or edit action is performed
 *  @param function|string $inOpts.getFormatter 
 *     Formatting function for the data read from the DB, before it is returned to 
 *     the DataTable
 *  @param function|string $inOpts.setFormatter 
 *     Formatting function for the data written to the DB as it is returned from 
 *     the client
 *  @param function|string $inOpts.validator 
 *     Validation function for the data
 *  @param array $inOpts.opts 
 *     Extra options that can be used for the formatting and validation functions
 */
class DTField {
	public $dbField = "";
	public $name = "";
	public $get = true;
	public $dynamicGet = false;
	public $set = true;
	public $validator = null;
	public $getFormatter = null;
	public $setFormatter = null;
	public $opts = array();


	private $_defaults = array(
		"dbField"      => "",
		"name"         => "",
		"get"          => true,
		"dynamicGet"   => false,
		"set"          => true,
		"getFormatter" => null,
		"setFormatter" => null,
		"validator"    => null,
		"opts"         => array()
	);
	

	function __construct( $inOpts )
	{
		$opts = array_merge( $this->_defaults, $inOpts);

		$this->dbField = $opts['dbField'];
		$this->name = $opts['name'];
		$this->get = $opts['get'];
		$this->dynamicGet = $opts['dynamicGet'];
		$this->set = $opts['set'];
		$this->getFormatter = $opts['getFormatter'];
		$this->setFormatter = $opts['setFormatter'];
		$this->validator = $opts['validator'];
		$this->opts = $opts['opts'];
	}


	/**
	 * Check to see if a field should be used for a particular action (get or set)
	 */
	public function apply ( $direction, $data=null )
	{
		if ( $direction === 'get' ) {
			// Get action - can we get this field
			return $this->get;
		}
		else {
			// Note that validation must be done on input data before we get here
			// Set action - can we set this field
			if ( ! $this->set ) {
				return false;
			}

			// Not required, and not given, so don't include
			if ( !isset( $data[$this->name] ) ) {
				return false;
			}

			// Default is to include
			return true;
		}
	}


	/**
	 * Get the value of the field, taking into account if it is coming from the
	 * DB or from a POST and also formatting
	 */
	public function val ( $direction, $data )
	{
		if ( $direction === 'get' ) {
			// Three cases for the getFormatter - closure, string or null
			if ( $this->getFormatter ) {
				if ( is_string( $this->getFormatter ) ) {
					return call_user_func( $this->getFormatter, $data[ $this->dbField ], $data, $this );
				}
				$getFormatter = $this->getFormatter;
				return $getFormatter( $data[ $this->dbField ], $data, $this );
			}
			return $data[ $this->dbField ];
		}
		else {
			// Three cases for the setFormatter - closure, string or null
			if ( $this->setFormatter ) {
				if ( is_string( $this->setFormatter ) ) {
					return call_user_func( $this->setFormatter, $data[ $this->dbField ], $data, $this );
				}
				$setFormatter = $this->setFormatter;
				return $setFormatter( $data[ $this->dbField ], $data, $this );
			}
			return $data[ $this->name ];
		}
	}


	/**
	 * Check to see if a field value is valid or not
	 */
	public function validate ( $data )
	{
		// Three cases for the validator - closure, string or null
		if ( ! $this->validator ) {
			return true;
		}

		$val = isset($data[ $this->name ]) ? $data[ $this->name ] : null;

		if ( is_string( $this->validator ) ) {
			return call_user_func( $this->validator, $val, $data, $this );
		}
		$validator = $this->validator;
		return $validator( $val, $data, $this );
	}
}


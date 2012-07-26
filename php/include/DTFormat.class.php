<?php

/**
 * Formatter methods for the DataTables Editor
 * 
 * All methods in this class should be static and have the following parameters and
 * return types (which are not reproduced with the methods below for brevity)
 *  @param string $val The value to format (from the POST or the DB)
 *  @param array $data The full data set for the row (from the POST or the DB)
 *  @param DTField $field The field object that we are working with
 *  @return string Formatted data
 */
class DTFormat {
	const DATE_ISO_8601 = "Y-m-d";    // 2012-03-09        -  jQuery UI equivalent format: yy-mm-dd
	const DATE_ISO_822 = "D, j M y";  // Fri, 9 Mar 12     -  jQuery UI equivalent format: D, d M y
	const DATE_ISO_850 = "l, d-M-y";  // Friday, 09-Mar-12 -  jQuery UI equivalent format: DD, dd-M-y 
	const DATE_ISO_1036 = "D, j M y"; // Fri, 9 Mar 12     -  jQuery UI equivalent format: D, d M y
	const DATE_ISO_1123 = "D, j M Y"; // Fri, 9 Mar 2012   -  jQuery UI equivalent format: D, d M yy
	const DATE_ISO_2822 = "D, j M Y"; // Fri, 9 Mar 2012   -  jQuery UI equivalent format: D, d M yy
	const DATE_TIMESTAMP = "U";       // 1331251200        -  jQuery UI equivalent format: @
	const DATE_EPOCH = "U";           // 1331251200        -  jQuery UI equivalent format: @


	/**
	 * Convert from MySQL date / date time format to a format given by the field
	 * options. You can specify 'getDateFormat' or 'dateFormat' in the DTField
	 * 'opts' array using standard PHP date() formatting options.
	 */
	static function date_mysql_to_format( $val, $data, $field ) {
		$format = isset( $field->opts['getDateFormat'] ) ?
			$field->opts['getDateFormat'] :
			$field->opts['dateFormat'];

		$date = explode(" ", $val);
		$date = date_create_from_format('Y-m-d', $date[0]);

		// Allow empty strings or invalid dates
		if ( $date ) {
			return date_format( $date, $format );
		}
		return '';
	}

	/**
	 * Convert from a format given by the field options to MySQL date format.
	 * You can specify 'setDateFormat' or 'dateFormat' in the DTField 'opts'
	 * array using standard PHP date() formatting options.
	 */
	static function date_format_to_mysql( $val, $data, $field ) {
		$format = isset( $field->opts['setDateFormat'] ) ?
			$field->opts['setDateFormat'] :
			$field->opts['dateFormat'];

		// Note that this assumes the date is in the correct format (should be
		// checked by validation before being used here!)
		$date = date_create_from_format($format, $val);

		// Invalidate dates are replaced with empty strings. Use the validation to
		// ensure the date given is valid if you don't want this!
		if ( $date ) {
			return date_format( $date, 'Y-m-d' );
		}
		return NULL;
	}

	/**
	 * As per the MySQL function - both accept ISO8601 - included for naming consistency
	 */
	static function date_postgres_to_format( $val, $data, $field ) {
		return DTFormat::date_mysql_to_format( $val, $data, $field );
	}

	/**
	 * As per the MySQL function - both accept ISO8601 - included for naming consistency
	 */
	static function date_format_to_postgres( $val, $data, $field ) {
		return DTFormat::date_format_to_mysql( $val, $data, $field );
	}
}


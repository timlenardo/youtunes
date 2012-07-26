<?php


/**
 * Validation methods for the DataTables Editor
 *
 * All methods in this class should be static and have the following parameters and
 * return types (which are not reproduced with the methods below for brevity)
 *  @param string $val The value to format (from the POST)
 *  @param array $data The full data set for the row (from the POST)
 *  @param DTField $field The field object that we are working with
 *  @return boolean true is the field data is valid, error string otherwise
 */
class DTValidate {
	/**
	 * No validation - all inputs are valid
	 */
	static function none( $val, $data, $field ) {
		// If empty string is given, check if required
		if ( $val === "" ) {
			if ( isset( $field->opts['required'] ) && $field->opts['required'] ) {
				return "This field is required";
			}
		}

		return true;
	}

	/**
	 * Field is required - there must be a value
	 */
	static function required( $val, $data, $field ) {
		if ( $val == "" ) {
			return "This field is required";
		}
		return true;
	}

	/**
	 * Boolean value
	 *  Options (use the DTField's 'opts' array to specify options):
	 *    - required - if the input must be given (i.e. not an empty string) - default false
	 */
	static function boolean( $val, $data, $field ) {
		// If empty string is given, check if required - default false
		if ( $val === "" ) {
			if ( !isset( $field->opts['required'] ) || $field->opts['required'] === false ) {
				return true;
			}
		}

		if ( filter_var($val, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === false ) {
			return "Please enter true or false";
		}
		return true;
	}



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Number validation methods
	 */

	/**
	 * Check that any input is numeric
	 */
	static function numeric ( $val, $data, $field ) {
		if ( ! is_numeric( $val ) ) {
			return "This input must be given as a number";
		}
		return true;
	}

	/**
	 * Check for a numeric input and that it is greater than a given value.
	 *  Options (use the DTField's 'opts' array to specify options):
	 *    - minNum - Minimum number that the input can be
	 */
	static function minNum ( $val, $data, $field ) {
		$numeric = DTValidate::numeric( $val, $data, $field );
		if ( $numeric !== true ) {
			return $numeric;
		}

		if ( $val < $field->opts['minNum'] ) {
			return "Number is too small, must be ".$field->opts['minNum']." or larger";
		}
		return true;
	}

	/**
	 * Check for a numeric input and that it is less than a given value
	 *  Options (use the DTField's 'opts' array to specify options):
	 *    - maxNum - Maximum number that the input can be
	 */
	static function maxNum ( $val, $data, $field ) {
		$numeric = DTValidate::numeric( $val, $data, $field );
		if ( $numeric !== true ) {
			return $numeric;
		}

		if ( $val > $field->opts['maxNum'] ) {
			return "Number is too large, must be ".$field->opts['maxNum']." or smaller";
		}
		return true;
	}

	/**
	 * Check for a numeric input and it is both greater and smaller than given numbers
	 *  Options (use the DTField's 'opts' array to specify options):
	 *    - minNum - Minimum number that the input can be
	 *    - maxNum - Maximum number that the input can be
	 */
	static function minMaxNum ( $val, $data, $field ) {
		$numeric = DTValidate::numeric( $val, $data, $field );
		if ( $numeric !== true ) {
			return $numeric;
		}

		$min = DTValidate::minNum( $val, $data, $field );
		if ( $min !== true ) {
			return $min;
		}

		return DTValidate::maxNum( $val, $data, $field );
	}



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * String validation methods
	 */

	/**
	 * E-mail address
	 *  Options (use the DTField's 'opts' array to specify options):
	 *    - required - if the input must be given (i.e. not an empty string) - default false
	 */
	static function email( $val, $data, $field ) {
		// If empty string is given, check if required - default false
		if ( $val === "" ) {
			if ( !isset( $field->opts['required'] ) || $field->opts['required'] === false ) {
				return true;
			}
		}

		if ( filter_var($val, FILTER_VALIDATE_EMAIL) === false ) {
			return "Please enter a valid e-mail address";
		}
		return true;
	}


	/**
	 * Min length of a string
	 *  Options (use the DTField's 'opts' array to specify options):
	 *    - minLen - min length allowed for the string
	 */
	static function minLen( $val, $data, $field ) {
		if ( strlen( $val ) < $field->opts['minLen'] ) {
			return "The input is too short. ".$field->opts['minLen']." characters required (".($field->opts['minLen']-strlen($val))." more to go)";
		}
		return true;
	}

	/**
	 * Max length of a string.
	 *  Options (use the DTField's 'opts' array to specify options):
	 *    - maxLen -max length allowed for the string
	 */
	static function maxLen( $val, $data, $field ) {
		if ( strlen( $val ) > $field->opts['maxLen'] ) {
			return "The input is ".(strlen($val)-$field->opts['maxLen'])." characters too long";
		}
		return true;
	}

	/**
	 * Require a string with a certain min or max of characters
	 *  Options (use the DTField's 'opts' array to specify options):
	 *    - minLen - min length allowed for the string
	 *    - maxLen - max length allowed for the string
	 */
	static function minMaxLen( $val, $data, $field ) {
		$min = DTValidate::minLen( $val, $data, $field );
		if ( $min === true ) {
			return DTValidate::maxLen( $val, $data, $field );
		}
		return $min;
	}

	/**
	 * IP address
	 *  Options (use the DTField's 'opts' array to specify options):
	 *    - required - if the input must be given (i.e. not an empty string) - default false
	 */
	static function ip( $val, $data, $field ) {
		// If empty string is given, check if required - default false
		if ( $val === "" ) {
			if ( !isset( $field->opts['required'] ) || $field->opts['required'] === false ) {
				return true;
			}
		}

		if ( filter_var($val, FILTER_VALIDATE_IP) === false ) {
			return "Please enter a valid IP address";
		}
		return true;
	}

	/**
	 * URL address
	 *  Options (use the DTField's 'opts' array to specify options):
	 *    - required - if the input must be given (i.e. not an empty string) - default false
	 */
	static function url( $val, $data, $field ) {
		// If empty string is given, check if required - default false
		if ( $val === "" ) {
			if ( !isset( $field->opts['required'] ) || $field->opts['required'] === false ) {
				return true;
			}
		}

		if ( filter_var($val, FILTER_VALIDATE_URL) === false ) {
			return "Please enter a valid URL";
		}
		return true;
	}


	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Date validation methods
	 */

	/**
	 * Check that a valid date input is given
	 *  Options (use the DTField's 'opts' array to specify options):
	 *    - validateDateFormat or dateFormat - PHP date() format
	 *    - dateError - error message to use (optional)
	 *    - required - if the input must be given (i.e. not an empty string) - default false
	 */
	static function date_format( $val, $data, $field ) {
		// If empty string is given, check if required - default false
		if ( $val === "" ) {
			if ( !isset( $field->opts['required'] ) || $field->opts['required'] === false ) {
				return true;
			}
		}

		$format = isset( $field->opts['validateDateFormat'] ) ?
			$field->opts['validateDateFormat'] :
			$field->opts['dateFormat'];

		$date = date_create_from_format($format, $val);
		if ( ! $date ) {
			return isset( $field->opts['dateError'] ) ?
				$field->opts['dateError'] :
				"Date is not in the expected format";
		}
		return true;
	}
}


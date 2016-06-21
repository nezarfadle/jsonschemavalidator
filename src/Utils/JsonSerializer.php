<?php  namespace Json\Validation\Utils;

/**
 * JsonSerializer
 */

class JsonSerializer
{	

	/**
	 * returns a string containing the JSON representation of value.
	 * 
	 * @param mixed $value
	 * 
	 * @return string
	 */
	public function encode($value)
	{
		return json_encode( $value );
	}

	/**
	 * takes a JSON encoded string and converts it into a PHP variable
	 * 
	 * @param string $json
	 * 
	 * @return StdClass
	 */
	public function decode($json)
	{
		return json_decode( $json );
	}
}
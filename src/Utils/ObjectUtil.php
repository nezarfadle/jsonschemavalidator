<?php  namespace Json\Validation\Utils;


/**
 * ObjectUtil
 */

class ObjectUtil
{

	/**
	 * finds whether the given variable is an Object
	 * 
	 * @return bool
	 */
	public function isObject( $obj )
	{
		return is_object( $obj );
	}

	/**
	 * finds whether the given object has members or not
	 * 
	 * @return bool
	 */
	public function hasMembers( $obj )
	{
		
		if( count(get_object_vars($obj)) <= 0 )
		{
			return false;
		}

		return true;
	}
}
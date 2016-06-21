<?php namespace Json\Validation\Validators;

use Json\Validation\Interfaces\IJsonValidator;

class ArrayValueValidator implements IJsonValidator
{
    public function validate( $propertyName, $value )
    {
        if( !is_array( $value )) { 
			throw new \InvalidArgumentException(  $propertyName . ": is not valid array" );
        }
    }
}

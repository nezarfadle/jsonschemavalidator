<?php namespace Json\Validation\Validators;

use Json\Validation\Interfaces\IJsonValidator;

class StringValueValidator implements IJsonValidator
{
    public function validate( $propertyName, $value )
    {
        if( !is_string( $value )) { 
			throw new \InvalidArgumentException( $propertyName . ": is not valid string value");
        }
    }
}

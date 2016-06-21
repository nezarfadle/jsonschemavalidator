<?php namespace Json\Validation\Validators;

use Json\Validation\Interfaces\IJsonValidator;

class ObjectValidator implements IJsonValidator
{
    public function validate( $propertyName, $value )
    {
        if( !is_object( $value )) { 
			throw new \InvalidArgumentException(  $propertyName . ": is not valid object");
        }
    }
}

<?php namespace Json\Validation\Validators;

use Json\Validation\Interfaces\IJsonValidator;

class RequiredStringValueValidator implements IJsonValidator
{
    public function validate( $propertyName, $value )
    {
        if( is_string( $value ) && trim( $value ) === '' ) { 
			throw new \InvalidArgumentException( $propertyName . ": is empty");
        }
    }
}

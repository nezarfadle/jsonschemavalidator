<?php namespace Json\Validation\Validators;

use Json\Validation\Interfaces\IJsonValidator;

class NumericValueValidator implements IJsonValidator
{
    public function validate( $propertyName, $value )
    {
        if( !is_numeric( $value )) { 
			throw new \InvalidArgumentException(  $propertyName . ": is not valid numeric value" );
        }
    }
}

<?php namespace Json\Validation\Validators;

use Json\Validation\IJsonValidator;

class JsonNumericValueValidator implements IJsonValidator
{
    public function validate( $attribute, $value )
    {
        if( !is_numeric( $value )) { 
			throw new \InvalidArgumentException(  $attribute . ": is not valid numeric value" );
        }
    }
}

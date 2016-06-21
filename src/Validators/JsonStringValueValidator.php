<?php namespace Json\Validation\Validators;

use Json\Validation\IJsonValidator;

class JsonStringValueValidator implements IJsonValidator
{
    public function validate( $attribute, $value )
    {
        if( !is_string( $value )) { 
			throw new \InvalidArgumentException( $attribute . ": is not valid string value");
        }
    }
}

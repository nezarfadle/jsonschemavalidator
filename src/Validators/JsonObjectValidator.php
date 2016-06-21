<?php namespace Json\Validation\Validators;

use Json\Validation\IJsonValidator;

class JsonObjectValidator implements IJsonValidator
{
    public function validate( $attribute, $value )
    {
        if( !is_object( $value )) { 
			throw new \InvalidArgumentException(  $attribute . ": is not valid object");
        }
    }
}

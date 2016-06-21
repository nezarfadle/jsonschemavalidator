<?php namespace App\Validators;

use Json\Validation\IJsonValidator;
use Json\Validation\Validators\JsonStringValueValidator;

class ArticleJsonApiValidator implements IJsonValidator
{
    public function validate( $value )
    {
        if( !is_object( $value->attributes ))
        { 
          throw new \InvalidArgumentException("Invalid array");
        }

        $stringValidator = new JsonStringValueValidator();
        $stringValidator->validate( $value->attributes->title );
        $stringValidator->validate( $value->attributes->content );

    }
}

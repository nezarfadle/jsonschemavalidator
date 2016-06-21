<?php namespace Json\Validation;

use Json\Validation\Exceptions\InvalidJsonPayloadException;
use Json\Validation\Exceptions\EmptyPayloadException;
use Json\Validation\Exceptions\NotExistsPropertyException;
use Json\Validation\Exceptions\EmptySchemaException;
use Json\Validation\Utils\ArrayUtil;
use Json\Validation\Utils\ObjectUtil;
use Json\Validation\Utils\JsonSerializer;


/**
 * JsonValidator
 * 
 * This class is working as a Json Validators Runner
 */

class JsonSchemaValidator
{

	private $serialzer, $arrayutil, $objectutil;

	public function __construct()
	{
		$this->serialzer = new JsonSerializer();
		$this->arrayutil = new ArrayUtil();
		$this->objectutil = new ObjectUtil();
	}
	
	/**
	 * iterate through the object's properties 
	 * the validation will be applied if the property has been found and true will be return, unless it will return false
	 * 
	 * @param StdClass $object 
	 * @param string $propertyToBeFounded 
	 * @param Arry $validators 
	 * 
	 * @return bool
	 */

	private function iterate($object, $propertyToBeFounded, $validators)
	{

		static $propertyHasBeenFound = false;

		foreach( $object as $propertyName => $property ) {

			// applay the validation and return true is the property has been found
			if( $propertyToBeFounded === $propertyName ) {

				if ( $this->arrayutil->isArray( $validators ) ) {
              
	                foreach ( $validators as $validator ) {
						$validator->validate( $propertyName, $object->{$propertyName} );  
	                }
	              
	            } else {
					$validators->validate( $propertyName, $object->{$propertyName} );  
	            }

				$propertyHasBeenFound = true;
				break;

			} else {
				
				// loop recursively if the property founded is an object
				if( $this->objectutil->isObject( $property )) {
					$propertyHasBeenFound = false;
					$this->iterate($property, $propertyToBeFounded, $validators);
				}
			}
		}

        return $propertyHasBeenFound;

	}

	/**
	 * iterate throw the sceham and apply the validate if we have valid json playload and schema 
	 * invalid payload and schema will throw expcetions
	 * 
	 * @param string $jsonPayload
	 * @param array $schema
	 */
	public function validate( $jsonPayload, $schema )
	{
		
		if( $this->arrayutil->isEmpty( $schema )) {
			throw new EmptySchemaException();
		}
		
		$jsonObject = $this->serialzer->decode( $jsonPayload );

		if( !$this->objectutil->isObject( $jsonObject )) {
			throw new InvalidJsonPayloadException();
		} 

		if( !$this->objectutil->hasMembers( $jsonObject )) {
			throw new EmptyPayloadException();
		} 

		foreach ( $schema as $property => $validators ) {

    		$property = $this->arrayutil->explode( ".", $property )->last();
 
	        if ( !$this->iterate( $jsonObject, $property, $validators )) {
	        	throw new NotExistsPropertyException($property);
	        }
		}
	}
}
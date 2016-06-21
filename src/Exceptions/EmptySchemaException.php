<?php  namespace Json\Validation\Exceptions;

class EmptySchemaException extends \Exception
{
	public function __construct()
	{
		parent::__construct("the schema seems empty");
	}
	
}
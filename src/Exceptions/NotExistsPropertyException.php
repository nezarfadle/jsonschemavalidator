<?php  namespace Json\Validation\Exceptions;

class NotExistsPropertyException extends \Exception
{

	private $property;

	public function __construct($property)
	{
		parent::__construct("[ " . $property . " ] property does't exist");
	}
	
}
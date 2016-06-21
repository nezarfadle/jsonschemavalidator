<?php  

use Json\Validation\Validators\JsonObjectValidator;

class JsonObjectValidatorTest extends \PHPUnit_Framework_TestCase
{

	public function test_ValidObject_ShouldPass()
	{
		$uow = new JsonObjectValidator();
		$uow->validate( 'fake attributeName', new StdClass() );
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_InvalidObject_ShouldThrowException()
	{
		$uow = new JsonObjectValidator();
		$uow->validate( 'fake attributeName', 'dummy text');
	}

	
}
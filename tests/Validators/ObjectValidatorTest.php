<?php  

use Json\Validation\Validators\ObjectValidator;

class ObjectValidatorTest extends \PHPUnit_Framework_TestCase
{

	public function test_ValidObject_ShouldPass()
	{
		$uow = new ObjectValidator();
		$uow->validate( 'fake attributeName', new StdClass() );
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_InvalidObject_ShouldThrowException()
	{
		$uow = new ObjectValidator();
		$uow->validate( 'fake attributeName', 'dummy text');
	}

	
}
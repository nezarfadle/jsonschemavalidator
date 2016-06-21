<?php  

use Json\Validation\Validators\ArrayValueValidator;

class ArrayValueValidatorTest extends \PHPUnit_Framework_TestCase
{

	public function test_ValidArrayValue_ShouldPass()
	{
		$uow = new ArrayValueValidator();
		$uow->validate( 'fake attributeName', array() );
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_InvalidArrayValue_ShouldThrowException()
	{
		$uow = new ArrayValueValidator();
		$uow->validate( 'fake attributeName', 'dummy text');
	}

	
}
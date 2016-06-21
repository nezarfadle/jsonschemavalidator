<?php  

use Json\Validation\Validators\JsonNumericValueValidator;

class JsonNumericValueValidatorTest extends \PHPUnit_Framework_TestCase
{

	
	public function test_ValidNumericValue_ShouldPass()
	{
		$uow = new JsonNumericValueValidator();
		$uow->validate( 'fake attributeName', '12');
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_InvalidNumericValue_ShouldThrowException()
	{
		$uow = new JsonNumericValueValidator();
		$uow->validate( 'fake attributeName', 'dummy text');
	}

}
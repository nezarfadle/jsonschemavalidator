<?php  

use Json\Validation\Validators\NumericValueValidator;

class NumericValueValidatorTest extends \PHPUnit_Framework_TestCase
{

	
	public function test_ValidNumericValue_ShouldPass()
	{
		$uow = new NumericValueValidator();
		$uow->validate( 'fake attributeName', '12');
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_InvalidNumericValue_ShouldThrowException()
	{
		$uow = new NumericValueValidator();
		$uow->validate( 'fake attributeName', 'dummy text');
	}

}
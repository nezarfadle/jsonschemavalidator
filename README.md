# Json Schema Validator

# Usage

Make sure that you import all the needed classes before every use caase:

```php
use Json\Validation\JsonSchemaValidator;
use Json\Validation\Validators\ArrayValueValidator;
use Json\Validation\Validators\NumericValueValidator;
use Json\Validation\Validators\ObjectValidator;
use Json\Validation\Validators\StringValueValidator;
use Json\Validation\Validators\RequiredStringValueValidator;

// Exceptions
use Json\Validation\Exceptions\EmptySchemaException;
use Json\Validation\Exceptions\InvalidJsonPayloadException;
use Json\Validation\Exceptions\EmptyPayloadException;
use Json\Validation\Exceptions\NotExistsPropertyException;
```

## 1. Simple Validation:

```php
$json = <<<EOL
{
	"id" : 1
}
EOL;

$validator = new JsonSchemaValidator();

$schema = [
	'id' => new NumericValueValidator() // validate weather the id is numeric or not
];

try {

	$validator->validate( $json, $schema );
	echo "Valid numeric value";

} 
catch (EmptySchemaException $e) {} 
catch (InvalidJsonPayloadException $e) {} 
catch (EmptyPayloadException $e) {} 
catch (\InvalidArgumentException $e) {} 
catch (NotExistsPropertyException $e) {}
```

## 2. Nested Validation:

```php
$json = <<<EOL
{
  "data": {
      "item1":{
      	"item2":{
      		"item3":{
      			"item4":{
      				"title": "Fake Content"
      			}
      		}
      	}
      }
  }
}
EOL;

$validator = new JsonSchemaValidator();

$schema = [
	'data.item1.item2.item3.item4' => new ObjectValidator(), // will validate that item4 is an object
	'data.item1.item2.item3.item4.title' => new StringValueValidator() // will validate that item4.title is a string
];

try {

	$validator->validate( $json, $schema );
	echo "Valid nested payload ";

} 
catch (EmptySchemaException $e) {} 
catch (InvalidJsonPayloadException $e) {} 
catch (EmptyPayloadException $e) {} 
catch (\InvalidArgumentException $e) {} 
catch (NotExistsPropertyException $e) {}
```

## 3. Multiple Validation:

```php
$json = <<<EOL
{
  "title" : "PHP is Cool"
}
EOL;

$validator = new JsonSchemaValidator();

$schema = [
  'title' => [ new StringValueValidator(), new RequiredStringValueValidator() ]
];

try {

  $validator->validate( $json, $schema );
  echo "Valid Title";

} 
catch (EmptySchemaException $e) {} 
catch (InvalidJsonPayloadException $e) {} 
catch (EmptyPayloadException $e) {} 
catch (\InvalidArgumentException $e) {} 
catch (NotExistsPropertyException $e) {}
```

## 4. JsonApi Spec Use Case:

```php
$json = <<<EOL
{
  "data": {
      "type": "photos",
      "attributes": {
        "title": "Ember Hamster",
        "src": "http://example.com/images/productivity.png"
      }
  }
}
EOL;

$validator = new JsonSchemaValidator();

$schema = [
  'data' => new ObjectValidator(), // validate weather data is an object
  'data.attributes' => new ObjectValidator(), // validate weather attributes is an object
  'data.attributes.title' => new StringValueValidator(), // validate weather title is string
  'data.attributes.src' => new StringValueValidator(), // validate weather src is string
];

try {

  $validator->validate( $json, $schema );
  echo "Valid json api spec payload ";

} 
catch (EmptySchemaException $e) {} 
catch (InvalidJsonPayloadException $e) {} 
catch (EmptyPayloadException $e) {} 
catch (\InvalidArgumentException $e) {} 
catch (NotExistsPropertyException $e) {}
```

## How to write your own Assertion class

1. You have to implement ```php Json\Validation\Interfaces\IJsonValidator```

```php
interface IJsonValidator
{
  public function validate( $propertyName, $value );
}
```

```php
$propertyName: The property name you want to validate
$value: The actual value you want to validate
```

####Greater than ten Validator

```php
class GreaterThanTenValidator implements Json\Validation\Interfaces\IJsonValidator
{
    public function validate( $propertyName, $value )
    {
         if( !is_numeric( $value ) || $value <= 10 ) { 
            throw new \InvalidArgumentException(  $propertyName . ": is less than 10" );
        }
    }
}

$json = <<<EOL
{
  "id" : 11
}
EOL;

$validator = new JsonSchemaValidator();

$schema = [
  'id' => new GreaterThanTenValidator()
];

try {

  $validator->validate( $json, $schema );
  echo "Greater than 10";

} 
catch (EmptySchemaException $e) {} 
catch (InvalidJsonPayloadException $e) {} 
catch (EmptyPayloadException $e) {} 
catch (\InvalidArgumentException $e) {} 
catch (NotExistsPropertyException $e) {}
```

#Json Schema Validator components:

### Json Validator:
```php
Json\Validation\JsonSchemaValidator
```

### Interfaces:
```php
Json\Validation\Interfaces\IJsonSchemaValidator
```

### Assertion Classes ( more will be added in future or [#how-to-write-your-own-assertion-class](take a look at how you can create your own assertion class) )
```php
Json\Validation\Validators\ArrayValueValidator
Json\Validation\Validators\NumericValueValidator
Json\Validation\Validators\ObjectValidator
Json\Validation\Validators\StringValueValidator
Json\Validation\Validators\RequiredStringValueValidator
```

### Exceptions
```php
Json\Validation\Exceptions\EmptySchemaException
Json\Validation\Exceptions\InvalidJsonPayloadException
Json\Validation\Exceptions\EmptyPayloadException
Json\Validation\Exceptions\NotExistsPropertyException
```

## Exceptions execution order:

####1. EmptySchemaException

This exception will be thrown if the given 
```php
$schema = [];
$validator->validate( $json, $schema );
```

####2. InvalidJsonPayloadException

This exception will be thrown if the given json payload is invalid
```php
$json = 'invalid json payload';
$validator->validate( $json, $schema );
```

####3. EmptyPayloadException

This exception will be thrown if the given json payload is empty object
```php
$json = '{}';
$validator->validate( $json, $schema );
```

####4. InvalidArgumentException

This exception will be thrown if the validation failed

####5. NotExistsPropertyException

This exception will be thrown if the given property is not exists in the json payload 

```php
$json = <<<EOL
{
  "title" : "PHP is Cool"
}
EOL;

$validator = new JsonSchemaValidator();

$schema = [
  'id' => new StringValueValidator()
];

$validator->validate( $json, $schema ); // NotExistsPropertyException will be thrown 
```


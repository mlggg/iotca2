<?php
require 'aws/aws-autoloader.php';

date_default_timezone_set('UTC');

// use class 
use Aws\DynamoDb\Exception\DynamoDbException;


// create new connection 
$sdk = new Aws\Sdk([
    'version' => 'latest',
    'region' => 'us-east-2',
    'credentials' => [
        'key' => '',
        'secret' => '',
    ],
        ]);



//function for scan all rows in the assigned table
function scanAllData($dynamodb,$table){

  $result = $dynamodb->scan(array(
        'TableName' => $table,
  
        'Select' => 'ALL_ATTRIBUTES'                
     )
  
  );
    return $result["Items"];
}
?>

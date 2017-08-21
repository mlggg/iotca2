<?php

require "config.php";

use Aws\DynamoDb\Marshaler;

$dynamodb = $sdk->createDynamoDb();
$marshaler = new Marshaler();
$LEDID = "";
$tableName = 'LED';
if ($_GET['led'] == '1') {
    $LEDID = "living1";
} else if ($_GET['led'] == '2') {
    $LEDID = "living2";
} else if ($_GET['led'] == '3') {
    $LEDID = "living3";
}else if ($_GET['led'] == 'baby') {
    $LEDID = "baby";
}else if ($_GET['led'] == 'master') {
    $LEDID = "master";
}
$key = $marshaler->marshalJson('
    {
        "LEDID": "' . $LEDID . '"
   
    }
');






if (isset($_GET['on'])) {
    $eav = $marshaler->marshalJson(
            '{
        
        ":p": "ON"
        
    }');

    $params = [
        'TableName' => $tableName,
        'Key' => $key,
        'UpdateExpression' =>
        'set currstat=:p',
        'ExpressionAttributeValues' => $eav,
        'ReturnValues' => 'UPDATED_NEW'
    ];
    try {
        $result = $dynamodb->updateItem($params);
        echo "Updated item.\n";
        print_r($result['Attributes']);
    } catch (DynamoDbException $e) {
        echo "Unable to update item:\n";
        echo $e->getMessage() . "\n";
    }
} else if (isset($_GET['off'])) {
    $eav = $marshaler->marshalJson(
            '{
        
        ":p": "OFF"
        
    }');

    $params = [
        'TableName' => $tableName,
        'Key' => $key,
        'UpdateExpression' =>
        'set currstat=:p',
        'ExpressionAttributeValues' => $eav,
        'ReturnValues' => 'UPDATED_NEW'
    ];
    try {
        $result = $dynamodb->updateItem($params);
        echo "Updated item.\n";
        print_r($result['Attributes']);
    } catch (DynamoDbException $e) {
        echo "Unable to update item:\n";
        echo $e->getMessage() . "\n";
    }
}
?>
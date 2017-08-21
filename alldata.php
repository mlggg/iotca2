<?php

require "config.php";


$dynamodb = $sdk->createDynamoDb();
$getobj = scanAllData($dynamodb, 'LivingRoom');
$getobj2 = scanAllData($dynamodb, 'MasterRoom');
$getobj3 = scanAllData($dynamodb, 'BabyRoom');

foreach ($getobj as $key => $row) {
    $volume[$key]  = $row['Time']['S'];
   
}
array_multisort($volume, SORT_ASC, $getobj);

foreach ($getobj2 as $key => $row) {
    $volume2[$key]  = $row['Time']['S'];
   
}
array_multisort($volume2, SORT_ASC, $getobj2);

foreach ($getobj3 as $key => $row) {
    $volume3[$key]  = $row['Time']['S'];
   
}
array_multisort($volume3, SORT_ASC, $getobj3);
?>


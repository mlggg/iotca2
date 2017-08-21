<?php

require "config.php";

$name="";
$arr=array();
if($_GET['id']=='living'){
    $name="LivingRoom";
    $dynamodb =  $sdk->createDynamoDb();

$getobj = scanAllData($dynamodb,$name);

foreach ($getobj as $key => $row) {
    $volume[$key]  = $row['Time']['S'];
   
}
array_multisort($volume, SORT_ASC, $getobj);
$last =count($getobj)-1;
array_push($arr, $getobj[$last]['Time']['S'],$getobj[$last]['Humidity']['S'],$getobj[$last]['Temperature']['S']);

}else if($_GET['id']=='master'){
    
    $name="MasterRoom";
    $dynamodb =  $sdk->createDynamoDb();

$getobj = scanAllData($dynamodb,$name);

foreach ($getobj as $key => $row) {
    $volume[$key]  = $row['Time']['S'];
   
}
array_multisort($volume, SORT_ASC, $getobj);
$last =count($getobj)-1;
array_push($arr, $getobj[$last]['Time']['S'],$getobj[$last]['Humidity']['S'],$getobj[$last]['Temperature']['S']);

}else if($_GET['id']=='baby'){
    
    $name="BabyRoom";
    $dynamodb =  $sdk->createDynamoDb();

$getobj = scanAllData($dynamodb,$name);

foreach ($getobj as $key => $row) {
    $volume[$key]  = $row['Time']['S'];
   
}
array_multisort($volume, SORT_ASC, $getobj);
$last =count($getobj)-1;
array_push($arr, $getobj[$last]['Time']['S'],$getobj[$last]['Humidity']['S'],$getobj[$last]['Temperature']['S'],$getobj[$last]['Light']['S']);

}


 echo json_encode($arr);
?>

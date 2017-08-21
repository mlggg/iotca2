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
$arr1=array();
$arr2=array();
$arr3=array();

$last =count($getobj)-1;

if($last <0){
    
    $last = 0;
}

array_push($arr1, $getobj[$last]['Time']['S'],$getobj[$last]['Humidity']['S'],$getobj[$last]['Temperature']['S']);

$last2 =count($getobj2)-1;

if($last2 <0){
    
    $last2 = 0;
}
array_push($arr2, $getobj2[$last2]['Time']['S'],$getobj2[$last2]['Humidity']['S'],$getobj2[$last2]['Temperature']['S']);


$last3 =count($getobj3)-1;

if($last3 <0){
    
    $last3 = 0;
}

array_push($arr3, $getobj3[$last3]['Time']['S'],$getobj3[$last3]['Humidity']['S'],$getobj3[$last3]['Temperature']['S'],$getobj3[$last3]['Light']['S']);
$newarr=array();
array_push($newarr,$arr1,$arr2,$arr3);
 echo json_encode($newarr);
?>
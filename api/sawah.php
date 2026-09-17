<?php
require_once "../config/database.php";
header("Content-Type: application/json; charset=utf-8");
$rows=$pdo->query("SELECT * FROM sawah")->fetchAll();
$features=[];
foreach($rows as $row){
    $geometry=null;
    if(!empty($row["geometry"])){ $decoded=json_decode($row["geometry"],true); if($decoded) $geometry=$decoded; }
    if(!$geometry) continue;
    $features[]=["type"=>"Feature","properties"=>$row,"geometry"=>$geometry];
}
echo json_encode(["type"=>"FeatureCollection","features"=>$features],JSON_UNESCAPED_UNICODE);
?>
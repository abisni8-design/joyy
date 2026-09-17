<?php
require_once "../config/database.php";header("Content-Type: application/json; charset=utf-8");
$rows=$pdo->query("SELECT * FROM irigasi")->fetchAll();$features=[];
foreach($rows as $row){$g=null;if(!empty($row["geometry"])){$d=json_decode($row["geometry"],true);if($d)$g=$d;}if($g)$features[]=["type"=>"Feature","properties"=>$row,"geometry"=>$g];}
echo json_encode(["type"=>"FeatureCollection","features"=>$features],JSON_UNESCAPED_UNICODE);
?>
<?php

if(isset($_POST['id'])) { 
	$url = "https://wfc2-image-api-259809.appspot.com/api/series/";
	$url .= $_POST['id'];
	$bookid_post = $_POST['id'];
	$previd_post = $_POST['previd'];

	$json = file_get_contents($url);
	$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
	$arr = json_decode($json, true);

	$title = $arr['title'];
	$author = $arr['author'];
	$publisher = $arr['publisher'];
	$volumes = $arr['volumes'];
	$description = $arr['description'];
	$img = $arr['seriesImage'];
	$bkidarray = [];
	$bkimarray = [];
	$bktiarray = [];

	for($i = 0; $i < count($arr['books']); $i++){
	array_push($bkidarray, $arr['books'][$i]['id']);
	array_push($bkimarray, $arr['books'][$i]['image']);
	array_push($bktiarray, $arr['books'][$i]['title']);
	} 
	$index = array_search($previd_post, $bkidarray);
    echo $bkidarray[$index+1];
}
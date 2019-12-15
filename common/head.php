<?php
function head($css){
  $css_links = "";
  for($i=0; $i<count($css); $i++){
    $css_links .= '<link rel="stylesheet" href="./css/'.$css[$i].'">';
  }

	echo '<!DOCTYPE html>'.
		 	'<html lang="ja">'.
  				'<head>'.
    				'<meta charset="UTF-8">'.
    				'<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">'.
    				'<meta http-equiv="X-UA-Compatible" content="ie=edge">'.
    				'<title>無料漫画</title>'.
    				'<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">'.
            $css_links.
  				'</head>'.
  				'<body>';
}
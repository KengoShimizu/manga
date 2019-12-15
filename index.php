<?php
  #エラーダンパー
  #ini_set("display_errors", 'On');
  #error_reporting(E_ALL);

  require "./common/head.php";
  require "./common/footer.php";

  #httpリクエスト（$arrにjsonインプット）
  $url = "https://wfc2-image-api-259809.appspot.com/api/series/";
  $json = file_get_contents($url);
  $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
  $arr = json_decode($json, true);

  $titlearray = [];
  $idarray = [];
  $autharray = [];
  $pubarray = [];
  $volumerarray = [];
  $descarray = [];
  $imgarray = [];
  $widtharray = [];
  $heightrarray = [];
  
  for($i = 0; $i < count($arr['data']); $i++){
    $arr['data'][$i]['description'] = wordwrap($arr['data'][$i]['description'], 45, '<br>', true);
    array_push($titlearray, $arr['data'][$i]['title']);
    array_push($idarray, $arr['data'][$i]['seriesId']);
    array_push($autharray, $arr['data'][$i]['author']);
    array_push($pubarray, $arr['data'][$i]['publisher']);
    #array_push($volumearray, $arr['data'][$i]['volumes']);
    array_push($descarray, $arr['data'][$i]['description']);
    array_push($imgarray, $arr['data'][$i]['seriesImage']);
    array_push($widtharray, $arr['data'][$i]['width']);
    array_push($widtharray, $arr['data'][$i]['height']);
  }
  #var_dump($descarray);

  head(["index.css"]);
?>

<!-- ヘッダー -->
<div class="card-header mb-3 text-center">
  <h3 class="mt-3 text-white">無料漫画</h3>
</div>

<div class="text-left p-3">トップ</div>

<div class="bg-info text-left p-3 mb-5 text-white">作品一覧</div>

<div class="container-row">
  <div class="row">
    <?php
      for($i = 0; $i < count($titlearray); $i++){
        echo 
            "<div class='mb-3 ml-5'>".
              "<div class='card' style='width: 18rem; height: 35rem;'>".
                "<a href='./next.php?id=$idarray[$i]' id='card-a'>".
                  "<div class='img_wrap'>".
                    "<img src='$imgarray[$i]' class='card-img-top'>".
                  "</div>".
                  "<div class='card-body'>".
                  "<p class='text-center mt-3'><strong>$titlearray[$i]</strong><p>".
                    "<p class='card-text line-3'>$descarray[$i]</p>".
                  "</div>".
                "</a>".
              "</div>".
            "</div>";
          }
    ?>
  </div>
</div>


<div class="bg-info text-left p-3 mb-5 text-white" id="rireki">閲覧履歴</div>

<div class="container-row" id="rireki_container">
  <div class="row">
  </div>
</div>

<?php
footer(["index.js"]);
?>
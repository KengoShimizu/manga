<?php
  session_start();
  if (!isset($_SESSION['title'])){
    $title_session = $_SESSION['title'];
  }

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
    array_push($titlearray, $arr['data'][$i]['title']);
    array_push($idarray, $arr['data'][$i]['seriesId']);
    array_push($autharray, $arr['data'][$i]['author']);
    array_push($pubarray, $arr['data'][$i]['publisher']);
    array_push($volumearray, $arr['data'][$i]['volumes']);
    array_push($descarray, $arr['data'][$i]['description']);
    array_push($imgarray, $arr['data'][$i]['seriesImage']);
    array_push($widtharray, $arr['data'][$i]['width']);
    array_push($widtharray, $arr['data'][$i]['height']);
  }
  #var_dump($descarray);
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>無料漫画</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/index.css">

  </head>

  <body>
    <!-- ヘッダー -->
    <div class="card-header mb-4">
      無料漫画
    </div>

    <div class="container">
      <div class="row row-cols-3">

<?php
  for($i = 0; $i < count($titlearray); $i++){
    
    echo 
        "<div class='col mb-3'>".
          "<div class='card' style='width: 18rem;'>".
            "<a href='./next.php?id=$idarray[$i]'>".
              "<div class='img_wrap'>".
                "<img src='$imgarray[$i]' class='card-img-top'>".
              "</div>".
              "<p class='text-center mt-3'>$titlearray[$i]<p>".
              "<div class='card-body'>".
                "<p class='card-text'>$descarray[$i]</p>".
              "</div>".
            "</a>".
          "</div>".
        "</div>";

      }
?>
  </div>
</div>

    


    
    <!-- フッター -->
    <div class="card-footer text-muted mt-3">
      フッター
    </div>

    <script src="./js/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="./js/index.js"></script>
  </body>
</html>

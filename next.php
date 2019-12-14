<?php

  ini_set("display_errors", 'On');
  error_reporting(E_ALL);

  session_start();
  if(isset($_POST['page'])) { $page = $_POST['page']; }

  #httpリクエスト（$arrにjsonインプット）
  $url = "https://wfc2-image-api-259809.appspot.com/api/series/";
  if(isset($_GET['id'])) { $url .= $_GET['id']; }
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
  #echo '<pre>';
  #var_dump($arr);
  #echo '</pre>';
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>無料漫画</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  </head>

  <body>
    <!-- ヘッダー -->
    <div class="card-header mb-4">
      無料漫画
    </div>

<script>
  //var page = "<?php echo $page;?>";
  //console.log(page);
</script>

    <div class="card border-white mb-3 mx-auto" style="max-width: 1000px;">
      <div class="row">
        <div class="col-md-4">
          <img src="<?php echo $img; ?>" class="card-img">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h3 class="card-title mb-3"><?php echo $title; ?></h3>
            <p class="text-muted">著者　<span style="color:black"><?php echo $author; ?></span></p>
            <p class="text-muted">出版社　<span style="color:black"><?php echo $publisher; ?></span></p>
            <p class="card-text text-muted">概要<br><span style="color:black"><?php echo $description; ?></span></p>
            <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
<?php
  for($i = 0; $i < count($bkidarray); $i++){
    $kan = $i + 1;
    echo 
    "<div class='card border-white mr-3 mb-3' style='width: 18rem;'>".
      "<a href='./viewer.php?id=$bkidarray[$i]'>".
        "<img src='$bkimarray[$i]' class='card-img-top'>".
        "<div class='card-body text-center'>".
          "<h5 class='card-title'>第 $kan 巻</h5>".
        "</div>".
      "</a>".
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

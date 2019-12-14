<?php
  session_start();

  #httpリクエスト（$arrにjsonインプット）
  $url = "https://wfc2-image-api-259809.appspot.com/api/books/";
  if(isset($_GET['id'])) { $url .= $_GET['id']; }
  $json = file_get_contents($url);
  $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
  $arr = json_decode($json, true);

  $title = $arr['title'];
  $sid = $arr['seriesId'];
  $pagenum = $arr['pageNum'];
  $imgdata = $arr['imageData'];

  $imgidarray = [];
  $imgarray = [];

  for($i = 0; $i < count($imgdata); $i++){
    array_push($imgidarray, $imgdata[$i]['imageId']);
    array_push($imgarray, $imgdata[$i]['imageUrl']);
  } 

  if (!isset($_SESSION['title']) || $_SESSION['title'] != $title) {
    // 登録されていなければ、設定
    $_SESSION['title'] = $title;
  }

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>無料漫画</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/viewer.css">

  </head>

  <script>
    var img = JSON.parse('<?php echo json_encode($imgarray); ?>');
  </script>

  <body>
    <div class="relative resizeimage text-center">
<?php
      $counter = 0;
      $counter_next = $counter + 1;
      echo "<img src='$imgarray[$counter_next]'>";
      echo "<img src='$imgarray[$counter]'>";
?>

<script>
  var count = <?php echo $counter;?>;
  var pagenum = <?php echo $pagenum;?>;
  var bookid =" <?php echo $sid;?>";
</script>

      <div class="absolute">

        <button type="button" class="btn btn-light" onclick="location.href='../next.php?id=<?php echo $sid;?>'"><</button>
        <div class="left"></div>
        <div class="right"></div>
      </div>
    </div>
    


    <script src="./js/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="./js/viewer.js"></script>
  </body>
</html>

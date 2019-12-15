<?php
  #エラーダンパー
  #ini_set("display_errors", 'On');
  #error_reporting(E_ALL);

  require "./common/head.php";
  require "./common/footer.php";

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

  head(["next.css"]);
?>

<!-- ヘッダー -->
<div class="card-header mb-3 text-center">
  <h3 class="mt-3 text-white">無料漫画</h3>
</div>

<div class="text-left p-3"><a href="./">トップ</a> ＞ <?php echo $title;?></div>

<!-- 漫画紹介トップ -->
<div class="card border-white mb-3 mx-auto" id="manga_top" style="max-width: 1000px;">
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

<script>
  var titlearray = JSON.parse('<?php echo json_encode($bktiarray); ?>');
  var bookidarray = JSON.parse('<?php echo json_encode($bkidarray); ?>');
  var imgarray = JSON.parse('<?php echo json_encode($bkimarray); ?>');
</script>


<!-- 漫画一覧 -->
<div class="container">
  <div class="row row-cols-5 justify-content-center">
    <?php
      for($i = 0; $i < count($bkidarray); $i++){
        $kan = $i + 1;
        echo 
        "<div class='card border-white mr-3 mb-3' style='width: 18rem;'>".
          "<a href='./viewer.php?id=$bkidarray[$i]'>".
            "<div class='img_wrap'>".
              "<img src='$bkimarray[$i]' class='card-img-top'>".
            "</div>".
            "<div class='card-body text-center'>".
              "<h5 class='card-title'>第 $kan 巻</h5>".
            "</div>".
          "</a>".
        "</div>";
      }
    ?>
  </div>
</div>

<?php
footer(["next.js"]);
?>

<?php

  #ini_set("display_errors", 'On');
  #error_reporting(E_ALL);

  require "./common/head.php";
  require "./common/footer.php";

  #httpリクエスト（$arrにjsonインプット）
  $url = "https://wfc2-image-api-259809.appspot.com/api/books/";

  if(isset($_GET['id'])) { 
    $url .= $_GET['id'];
    $bookid = $_GET['id'];
  }
  if(isset($_GET['page'])) { $counter = $_GET['page']; }
  else{ $counter = 0; }

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

  head(["viewer.css"]);
?>

<div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header mx-auto">
                <h4><div class="modal-title" id="myModalLabel">最後のページです</div></h4>
            </div>
        </div>
    </div>
</div>

<!-- 画像配列をjsに渡す -->
<script>
  var img = JSON.parse('<?php echo json_encode($imgarray); ?>');
</script>

<div class="relative resizeimage text-center">
  <!-- 画像の表示 -->
  <?php
  $counter_next = $counter + 1;
  echo "<img src='$imgarray[$counter_next]'>";
  echo "<img src='$imgarray[$counter]'>";
  ?>

  <!-- count = 初期ページ -->
  <!-- pagenum = 総ページ数 -->
  <!-- title = 巻のタイトル -->
  <script>
    var count = <?php echo $counter;?>;
    var pagenum = <?php echo $pagenum;?>;
    var topimg = "<?php echo $imgdata[0]['imageUrl'];?>";
    var id = "<?php echo $bookid;?>";
  </script>


  <!-- 戻るボタン、ページ送りブロックの配置 -->
  <div class="absolute">

    <button type="button" class="btn btn-light" onclick="location.href='../next.php?id=<?php echo $sid;?>'"><</button>
    <div data-toggle="" data-target="#testModal" class="left"></div>
    <div class="right"></div>
  </div>
</div>
    

<?php
footer(["viewer.js"]);
?>

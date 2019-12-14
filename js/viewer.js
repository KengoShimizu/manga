//最初に10ページ先まで読んでおく
for(i = 0; i< 10; i++){
    $("<img>").attr("src", img[i]);
}


//ページ送り
$('.right').on('click', function(){
	if(count-2 >= 0){
		count -= 2;
		$($('img')[0]).attr("src", img[count+1]);
		$($('img')[1]).attr("src", img[count]);
		loadpages(count);
	}
});

$('.left').on('click', function(){
	if(count+2 <= pagenum){
		count += 2;
		$($('img')[0]).attr("src", img[count+1]);
		$($('img')[1]).attr("src", img[count]);
		loadpages(count);
	}
});

//戻るボタン押されたらAjaxでページ数返却
$('button').on('click', function(){
	$.post('./next.php?id='+bookid, 'page='+count);
});

//ページ先読み関数
function loadpages(count){
	var sub = count - 5;
	//ロードするページ数が5ページあるの場合
	if(sub >= 0){
		for(i=1; i<6; i++){
			$("<img>").attr("src", img[count-i]);
			$("<img>").attr("src", img[count+1+i]);
		}
	}
	//ロードするページ数が5ページ以下の場合
	else{
		sub = sub * -1;
		var ind = 0;
		for(i=1; i<count+1; i++){
			$("<img>").attr("src", img[count-i]);
			$("<img>").attr("src", img[count+1+i]);
			ind = count+1+i;
		}
		for(i=1; i<6; i++){
			$("<img>").attr("src", img[ind+i]);
		}

	}
	
}
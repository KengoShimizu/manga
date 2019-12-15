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
		$('.left').attr('data-toggle', 'a');
	}
});

$('.left').on('click', function(){
	if(count+2 <= pagenum){
		count += 2;
		$($('img')[0]).attr("src", img[count+1]);
		$($('img')[1]).attr("src", img[count]);
		loadpages(count);
		if(count == pagenum || count == pagenum-1){
			//最後のページまで行けば登録しない
			$(this).attr('data-toggle', 'modal');
		}
		if(count == pagenum-1){
			//奇数ページの時最後は黒い画像
			$($('img')[0]).attr("src", "../black.png");
		}
	}
});

//戻るボタン押されたらlocalstrageにbookidとページ数を記録
$('button').on('click', function(){
	
	if(count == pagenum || count == pagenum-1){
		//最後のページまで行けば登録しない
	}
	//登録されていなければ
	else if(!localStorage.getItem('json')){
		var data = [{img: topimg, page: count, id: id}];
		localStorage.setItem('json', JSON.stringify(data));
	}
	else{
		var data = localStorage.getItem('json');
		data = JSON.parse(data);
		// 同じ作品が登録されている場合は先頭にもってきてページ数だけ更新
		data = data.filter(function(item, index){
  			if (item.id != id) return true;
		});
		data.unshift({img: topimg, page: count, id: id});
		if(data.length > 10){ 
			data.pop(); 
		}
		localStorage.setItem('json', JSON.stringify(data));
	}
	
	
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
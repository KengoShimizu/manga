//登録されていなければ
if(!localStorage.getItem('json')){
	$('#rireki').css('display', 'none');
	$('#rireki_container').css('display', 'none');
}
else{
	// 同じ作品が登録されている場合は先頭にもってきてページ数だけ更新
	var data = localStorage.getItem('json');
	data = JSON.parse(data);
	for(i=0; i<data.length; i++){
		$('#rireki_container .row').append(
			"<div class='mb-3 ml-5'>"+
	        	"<div class='card' style='width: 18rem;'>"+
	          		"<a href='./viewer.php?id="+data[i].id+"&page="+data[i].page+"'>"+
		              	"<div class='img_wrap'>"+
		                	"<img src='"+data[i].img+"' class='card-img-top'>"+
		              	"</div>"+
		              	"<p class='text-center mt-3'>"+(data[i].page+1)+"ページから読む<p>"+
	            	"</a>"+
	          	"</div>"+
	        "</div>"
	    );
	}
}
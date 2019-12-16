# 漫画ビューワ
某IT会社の2日間ハッカソン形式のインターンシップで，apiを使って漫画情報（テキスト・画像）を取得する漫画ビューワを作成した．
apiはインターンシップ専用に用意されたものなので，将来的に削除されるため　以下に画像とgifで記録しておく．
## 使用技術
php, jQuery, localstrage, bootstrap
## 外観
1ページ目：作品一覧
2ページ目：選択作品一覧
3ページ目：漫画ビューワ
<img src="https://github.com/KengoShimizu/manga/wiki/images/head.gif" width="50%">

## 工夫ポイントその①　履歴機能
一度閲覧した作品はページ数と共に記憶され作品一覧に登録される．直近で閲覧した作品10冊まで登録でき，一度読み切ると登録が解除される．
<img src="https://github.com/KengoShimizu/manga/wiki/images/kuhuu1.gif" width="50%">

## 工夫ポイントその②　次の巻への遷移
作品を読み切ると次の作品へ促すウィンドウが表示され，次の巻へ進むことができる．また，読んでいる作品が最後の作品である時自動的に選択作品一覧ページに戻る．
<img src="https://github.com/KengoShimizu/manga/wiki/images/kuhuu2.gif" width="50%">

## 工夫ポイントその③　ページの先読み機能
漫画ビューワではページ送りをするたびに表示ページの前後合計10ページを先に読み込むことで，ページ送りの画像読み込みを円滑にしユーザへのレスポンスを速くしている．

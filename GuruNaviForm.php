<!doctype html>
<html lang="ja">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/style.css">

<title>ぐるなびAPIを使って店舗検索</title>
</head>
<body>
<header>
<h1 class="font-weight-normal">PHP</h1>
</header>

<main>
<h2>ぐるなびAPIを使って店舗検索</h2>
<a href="https://api.gnavi.co.jp/api/scope/" target="_blank">
	<img src="https://api.gnavi.co.jp/api/img/credit/api_265_65.gif" width="265" height="65" border="0" alt="グルメ情報検索サイト　ぐるなび">
</a>
<pre>
	<?php
		$error = $_GET["error"];
		if(intval($error) === 1) {
			print('フリーワードと住所を入力してください');
		}
		if(intval($error) === 2) {
			print('フリーワードを入力してください');
		}
		if(intval($error) === 3) {
			print('住所を入力してください');
		}
	?>

	<form action="GuruNaviDisp.php"method="get">
	<span>フリーワード </span><input type="text" name="freeword/">
	<span>住所 </span><input type="text" name="address/">
	<input type="submit" value="送信">
	</form>
</pre>
</main>
</body>
</html>
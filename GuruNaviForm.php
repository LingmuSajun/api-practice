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
	<h6>フリーワード入力</h6>
	<?php
		$error = $_GET["error"];
		if(intval($error) === 1) {
			print('キーワードを入力してください');
		}
	?>
	<form action="GuruNaviDisp.php" method="get">
		<input type="text" name="keyword/"><br/>
		<input type="submit" value="送信">
	</form>
</pre>
</main>
</body>
</html>
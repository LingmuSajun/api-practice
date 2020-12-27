<?php
	require_once 'lib/GuruNaviUtil.php';
	$guruNaviUtil = new GuruNaviUtil($_GET["lang"]);
	$lang = $guruNaviUtil->lang;

	$keyword = $_GET["keyword/"];
	$address = $_GET["address/"];

	$guruNaviUtil->validate($lang, $keyword, $address);

	require_once 'API/ForeignRestSearchAPI.php';
	$frsAPIObj = new ForeignRestSearchAPI($lang, $keyword, $address);
	$list = $frsAPIObj->getResponse();
?>

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
キーワードは「<?php print($keyword); ?>」です<br/>
住所は「<?php print($address); ?>」です<br/>

<?php
	$count = 0;
	foreach($list as $key => $data) {
		$count++;
		print('No. ' . $count . '<br/>');
		print('店舗名 : ' . $data['name'] . '<br/>');
		print('カテゴリー : ' . $data['category'] . '<br/>');
		print('住所 : ' . $data['address'] . '<br/>');
		print('
		<a href="' . $data['url'] . '">' .
			'<img src="' .$data['image_url_1'] . '"width="300" height="100" border="0" alt="ぐるなびレストラン">
		</a>
		');
		print('<br/>');
	}
?>

	<input type="button" onclick="location.href='GuruNaviForm.php'" value="戻る">
</pre>
</main>
</body>
</html>
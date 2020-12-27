<?php
require_once 'lib/GuruNaviUtil.php';

$guruNaviUtil = new GuruNaviUtil($_GET["lang"]);
$lang = $guruNaviUtil->lang;
$errorText = $guruNaviUtil->getValidationErrorText($_GET["error"]);
$textKeyword = $guruNaviUtil->getFormText(GuruNaviUtil::TEXT_KEYWORD);
$textAddress = $guruNaviUtil->getFormText(GuruNaviUtil::TEXT_ADDRESS);
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
<a href="GuruNaviForm.php?lang=ja">日本語</a>
<a href="GuruNaviForm.php?lang=en">English</a>
<a href="GuruNaviForm.php?lang=zh_cn">中文</a>
<a href="GuruNaviForm.php?lang=ko">한국</a>
<a href="GuruNaviForm.php?lang=vi">Tiếng Việt</a>
<pre>
	<?php
	if(!empty($errorText)) {
		print($errorText);
	}
	?>

	<form action="GuruNaviDisp.php"method="get">
	<span><?php print($textKeyword); ?> </span><input type="text" name="keyword/">
	<span><?php print($textAddress); ?> </span><input type="text" name="address/">
	<input type="submit" value="送信">
	<input type="hidden" name="lang" value="<?php print($lang); ?>">
	</form>
</pre>
</main>
</body>
</html>
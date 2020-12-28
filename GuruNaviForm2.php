<?php
	$categoryCode = $_GET["category_l_code"];
	$prefCode = $_GET["pref_code"];

	require_once 'lib/GuruNaviUtil.php';
	$guruNaviUtil = new GuruNaviUtil($_GET["lang"]);
	$lang = $guruNaviUtil->lang;
	$guruNaviUtil->validate($categoryCode, $prefCode);
	$title = $guruNaviUtil->getTitle();
	// カテゴリー
	$categoryName = $guruNaviUtil->getCategoryNameByCode($categoryCode);
	// 都道府県
	$prefName = $guruNaviUtil->getPrefNameByCode($prefCode);
	// 小エリア
	$textSmallArea = $guruNaviUtil->getFormText(GuruNaviUtil::TEXT_SMALL_AREA);;
	$smallAreaList = $guruNaviUtil->getSmallAreaList($prefCode);
	// 送信ボタン
	$textSubmit = $guruNaviUtil->getSubmitText();
?>

<!doctype html>
<html lang="ja">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/style.css">

<title><?php print($title); ?></title>
</head>
<body>
<header>
<h1 class="font-weight-normal">PHP</h1>
</header>

<main>
<h2><?php print($title); ?></h2>
<a href="https://api.gnavi.co.jp/api/scope/" target="_blank">
	<img src="https://api.gnavi.co.jp/api/img/credit/api_265_65.gif" width="265" height="65" border="0" alt="グルメ情報検索サイト　ぐるなび">
</a>
<pre>
カテゴリーは「<?php print($categoryName); ?>」です<br/>
都道府県は「<?php print($prefName); ?>」です<br/>

	<form action="GuruNaviDisp.php"method="get">
		<span><?php print($textSmallArea); ?> </span>
		<select name="areacode_s">
			<?php
			foreach ($smallAreaList as $key => $areaData) {
				echo '<option value="', $areaData['areacode_s'], '">', $areaData['areaname_s'], '</option>';
			}
			?>
		</select>
		<input type="submit" value="<?php print($textSubmit); ?>">
		<input type="hidden" name="pref_code" value="<?php print($prefCode); ?>">
		<input type="hidden" name="category_l_code" value="<?php print($categoryCode); ?>">
		<input type="hidden" name="lang" value="<?php print($lang); ?>">
	</form>

	<input type="button" onclick="location.href='GuruNaviForm.php'" value="戻る">
</pre>
</main>
</body>
</html>
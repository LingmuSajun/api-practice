<?php
$categoryCode = $_GET["category_l_code"];
$prefCode = $_GET["pref_code"];

require_once 'lib/TranslationUtil.php';
$util = new TranslationUtil($_GET["lang"]);
$lang = $util->lang;
// タイトル
$title = $util->getTitle();
// カテゴリー
$textCategory = $util->getFormText($util::TEXT_CATEGORY);
$categoryName = $util->getCategoryNameByCode($categoryCode);
// 都道府県
$textPrefs = $util->getFormText($util::TEXT_PREFS);
$prefName = $util->getPrefNameByCode($prefCode);
// 小エリア
$smallAreaList = $util->getSmallAreaList($prefCode);
// 送信ボタン
$textSubmit = $util->getFormText($util::TEXT_SUBMIT);
// 戻るボタン
$textBack = $util->getFormText($util::TEXT_RETURN);
$returnUrl = $util->getReturnUrl();
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

<main>
<header>
	<h2><?php print($title); ?></h2>
	<a href="https://api.gnavi.co.jp/api/scope/" target="_blank">
		<img src="https://api.gnavi.co.jp/api/img/credit/api_265_65.gif" width="265" height="65" border="0" alt="グルメ情報検索サイト　ぐるなび">
	</a>
	<div class="language_url">
		<a href="<?php print($util->getLanguageUrl('ja')); ?>">日本語</a>
		<a href="<?php print($util->getLanguageUrl('en')); ?>">English</a>
		<a href="<?php print($util->getLanguageUrl('zh_cn')); ?>">中文</a>
		<a href="<?php print($util->getLanguageUrl('ko')); ?>">한국</a>
		<a href="<?php print($util->getLanguageUrl('vi')); ?>">Tiếng Việt</a>
	</div>
</header>
<pre>
	<?php print($textCategory); ?> : <?php print($categoryName); ?><br/>
	<?php print($textPrefs); ?> : <?php print($prefName); ?><br/>
</pre>

<pre>
	<form action="GuruNaviDisp.php" method="get">
		<div class="cp_ipselect cp_sl05">
		<select name="areacode_s">
			<?php
			foreach ($smallAreaList as $key => $areaData) {
				echo '<option value="', $areaData['areacode_s'], '">', $areaData['areaname_s'], '</option>';
			}
			?>
		</select>
		</div>
		<input type="submit" value="<?php print($textSubmit); ?>" class="btn btn--pink sb">
		<input type="hidden" name="pref_code" value="<?php print($prefCode); ?>">
		<input type="hidden" name="category_l_code" value="<?php print($categoryCode); ?>">
		<input type="hidden" name="lang" value="<?php print($lang); ?>">
	</form>

	<input type="button" onclick="location.href='<?php print($returnUrl); ?>'" value="<?php print($textBack); ?>" class="btn btn--pink">
</pre>
</main>
</body>
</html>
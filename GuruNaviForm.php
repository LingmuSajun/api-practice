<?php
require_once 'lib/GuruNaviUtil.php';
$guruNaviUtil = new GuruNaviUtil($_GET["lang"]);
$lang = $guruNaviUtil->lang;
// タイトル
$title = $guruNaviUtil->getTitle();
// カテゴリー
$textCategory = $guruNaviUtil->getFormText(GuruNaviUtil::TEXT_CATEGORY);
$categoryList = $guruNaviUtil->getCategoryList();
// 都道府県
$textPrefs = $guruNaviUtil->getFormText(GuruNaviUtil::TEXT_PREFS);
$prefList = $guruNaviUtil->getPrefList();
// 次へボタン
$textNext = $guruNaviUtil->getFormText(GuruNaviUtil::TEXT_NEXT);
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
<a href="GuruNaviForm.php?lang=ja">日本語</a>
<a href="GuruNaviForm.php?lang=en">English</a>
<a href="GuruNaviForm.php?lang=zh_cn">中文</a>
<a href="GuruNaviForm.php?lang=ko">한국</a>
<a href="GuruNaviForm.php?lang=vi">Tiếng Việt</a>
<pre>
	<form action="GuruNaviForm2.php"method="get">
		<span><?php print($textCategory); ?> </span>
		<select name="category_l_code">
			<?php
			foreach ($categoryList as $key => $categoryData) {
				echo '<option value="', $categoryData['category_l_code'], '">', $categoryData['category_l_name'], '</option>';
			}
			?>
		</select>
		<span><?php print($textPrefs); ?> </span>
		<select name="pref_code">
			<?php
			foreach ($prefList as $key => $prefData) {
				echo '<option value="', $prefData['pref_code'], '">', $prefData['pref_name'], '</option>';
			}
			?>
		</select>
		<input type="submit" value="<?php print($textNext); ?>">
		<input type="hidden" name="lang" value="<?php print($lang); ?>">
	</form>
</pre>
</main>
</body>
</html>
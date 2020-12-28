<?php
	$categoryCode = $_GET["category_l_code"];
	$prefCode = $_GET["pref_code"];
	$smallAreaCode = $_GET["areacode_s"];

	require_once 'lib/GuruNaviUtil.php';
	$guruNaviUtil = new GuruNaviUtil($_GET["lang"]);
	// タイトル
	$title = $guruNaviUtil->getTitle();
	// カテゴリー
	$textCategory = $guruNaviUtil->getFormText(GuruNaviUtil::TEXT_CATEGORY);
	$categoryName = $guruNaviUtil->getCategoryNameByCode($categoryCode);
	// 小エリア
	$textSmallArea = $guruNaviUtil->getFormText(GuruNaviUtil::TEXT_SMALL_AREA);
	$smallAreaName = $guruNaviUtil->getSmallAreaNameByCode($prefCode, $smallAreaCode);
	// レストラン
	$restList = $guruNaviUtil->getRestaurantList($categoryCode, $smallAreaCode);
	$textRestaurant = $guruNaviUtil->getFormText(GuruNaviUtil::TEXT_RESTAURANT);
	$textCategory = $guruNaviUtil->getFormText(GuruNaviUtil::TEXT_CATEGORY);
	$textTelNo = $guruNaviUtil->getFormText(GuruNaviUtil::TEXT_TEL_NO);
	$textAddress = $guruNaviUtil->getFormText(GuruNaviUtil::TEXT_ADDRESS);
	$textPR = $guruNaviUtil->getFormText(GuruNaviUtil::TEXT_PR);
	// 戻るボタン
	$textBack = $guruNaviUtil->getFormText(GuruNaviUtil::TEXT_RETURN);
	$returnUrl = $guruNaviUtil->getReturnUrl();
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
<?php print($textCategory); ?> : <?php print($categoryName); ?><br/>
<?php print($textSmallArea); ?> : <?php print($smallAreaName); ?><br/>

<?php
	$count = 0;
	foreach($restList as $key => $data) {
		$count++;
		print('No. ' . $count . '<br/>');
		print($textRestaurant . ' : ' . $data['name'] . '<br/>');
		print($textCategory . ' : ' . $data['category'] . '<br/>');
		print($textTelNo . ' : ' . $data['tel'] . '<br/>');
		print($textAddress . ' : ' . $data['address'] . '<br/>');
		print($textPR . ' : ' . $data['pr'] . '<br/>');
		print('
		<a href="' . $data['url'] . '">' .
			'<img src="' .$data['image_url_1'] . '"width="300" height="100" border="0" alt="ぐるなびレストラン">
		</a>
		');
		print('<br/>');
	}
?>

	<input type="button" onclick="location.href='<?php print($returnUrl); ?>'" value="<?php print($textBack); ?>">
</pre>
</main>
</body>
</html>
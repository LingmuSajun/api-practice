<?php
$categoryCode = $_GET["category_l_code"];
$prefCode = $_GET["pref_code"];
$smallAreaCode = $_GET["areacode_s"];

require_once 'lib/TranslationUtil.php';
$util = new TranslationUtil($_GET["lang"]);
// タイトル
$title = $util->getTitle();
// カテゴリー
$textCategory = $util->getFormText($util::TEXT_CATEGORY);
$categoryName = $util->getCategoryNameByCode($categoryCode);
// 小エリア
$textSmallArea = $util->getFormText($util::TEXT_SMALL_AREA);
$smallAreaName = $util->getSmallAreaNameByCode($prefCode, $smallAreaCode);
// レストラン
$restList = $util->getRestaurantList($categoryCode, $smallAreaCode);
$textRestaurant = $util->getFormText($util::TEXT_RESTAURANT);
$textBusinessHour = $util->getFormText($util::TEXT_BUSINESS_HOUR);
$textHoliday = $util->getFormText($util::TEXT_HOLIDAY);
$textCategory = $util->getFormText($util::TEXT_CATEGORY);
$textTelNo = $util->getFormText($util::TEXT_TEL_NO);
$textAddress = $util->getFormText($util::TEXT_ADDRESS);
$textPR = $util->getFormText($util::TEXT_PR);
$textImage = $util->getFormText($util::TEXT_IMAGE);
// 戻るボタン
$textReturn = $util->getFormText($util::TEXT_RETURN);
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

<div class="search_condition">
	<?php print($textCategory); ?> : <?php print($categoryName); ?><br/>
	<?php print($textSmallArea); ?> : <?php print($smallAreaName); ?><br/>
</div>

<table class="table6">
	<tbody>
	<?php if(is_array($restList)): ?>
		<?php foreach($restList as $key => $data): ?>
			<tr>
				<th class="restaurant_name"><?php print($textRestaurant); ?></th>
				<td class="restaurant_name"><?php print($data['name']); ?></td>
			</tr>
			<tr>
				<th><?php print($textBusinessHour); ?></th>
				<td><?php print($data['business_hour']); ?></td>
			</tr>
			<tr>
				<th><?php print($textHoliday); ?></th>
				<td><?php print($data['holiday']); ?></td>
			</tr>
			<tr>
				<th><?php print($textTelNo); ?></th>
				<td><?php print($data['tel']); ?></td>
			</tr>
			<tr>
				<th><?php print($textAddress); ?></th>
				<td><?php print($data['address']); ?></td>
			</tr>
			<tr>
				<th><?php print($textPR); ?></th>
				<td><?php print($data['pr']); ?></td>
			</tr>
			<tr>
				<th><?php print($textImage); ?></th>
				<td><?php print('<a href="' . $data['url'] . '">' .
					'<img src="' .$data['image_url_1'] . '" border="0" alt="ぐるなびレストラン"></a>'); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	<?php else: ?>
		<div class="search_condition">
		検索結果は0件です。違う条件でお探しください。
		</div>
	<?php endif; ?>
	</tbody>
</table>

<div class="return_block">
	<input type="button" onclick="location.href='<?php print($returnUrl); ?>'" value="<?php print($textReturn); ?>" class="btn btn--pink return">
</div>
</main>
</body>
</html>
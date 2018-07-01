<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("хочу дешевле");
?><?$APPLICATION->IncludeComponent(
	"mycomponents:my.hl.bid.admin.list",
	".default",
	Array(
		"BLOCK_ID" => "1",
		"CHECK_PERMISSIONS" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DETAIL_URL" => "",
		"FILTER_NAME" => "",
		"PAGEN_ID" => "page",
		"ROWS_PER_PAGE" => "20",
		"SORT_FIELD" => "ID",
		"SORT_ORDER" => "DESC"
	)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?><?$APPLICATION->IncludeComponent(
	"mycomponents:my.hl.bid.admin.view",
	".default",
	Array(
        "AJAX_MODE" => "Y",
		"BLOCK_ID" => "1",
		"CHECK_PERMISSIONS" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"LIST_URL" => "/admin/lowprice/",
		"ROW_ID" => $_REQUEST["ID"],
		"ROW_KEY" => "ID",
		"USER_PROFILE" => "/admin/users/#LOGIN#/"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
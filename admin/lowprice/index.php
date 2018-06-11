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


		 <? if (isset($_GET['id']) && !empty($_GET['id'])){
    $row_id = $_GET['id'];
$APPLICATION->IncludeComponent(
    "mycomponents:my.hl.bid.admin.view",
    ".default",
    Array(
        "AJAX_MODE" => "Y",
        "BLOCK_ID" => "1",
        "CHECK_PERMISSIONS" => "N",
        "COMPONENT_TEMPLATE" => ".default",
        "LIST_URL" => "/admin/lowprice/",
        "ROW_ID" => $row_id,
        "ROW_KEY" => "ID",
        "USER_PROFILE" => "/admin/users/#LOGIN#/"
    )
);
} ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
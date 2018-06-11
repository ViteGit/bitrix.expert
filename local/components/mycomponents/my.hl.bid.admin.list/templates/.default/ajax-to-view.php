<?
require($_SERVER["DOCUMENT_ROOT"] .
    "/bitrix/modules/main/include/prolog_before.php");
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CModule::IncludeModule('iblock');
?>


<?
//debug($_GET);
if (isset($_GET['id']) && !empty($_GET['id'])) {
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
}
?>
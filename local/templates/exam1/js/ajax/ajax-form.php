<?
require($_SERVER["DOCUMENT_ROOT"].
    "/bitrix/modules/main/include/prolog_before.php");
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?>

<?$APPLICATION->IncludeComponent(
    "mycomponents:form.result.edit",
    ".default",
    Array(
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "N",
        "CHAIN_ITEM_LINK" => "",
        "CHAIN_ITEM_TEXT" => "",
        "COMPONENT_TEMPLATE" => ".default",
        "EDIT_ADDITIONAL" => "Y",
        "EDIT_STATUS" => "Y",
        "IGNORE_CUSTOM_TEMPLATE" => "N",
        "LIST_URL" => "index.php",
        "RESULT_ID" => $_REQUEST["index_php?RESULT_ID"],
        "SEF_MODE" => "N",
        "USE_EXTENDED_ERRORS" => "N",
        "VIEW_URL" => "index.php"
    )
);?>

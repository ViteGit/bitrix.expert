<?
require($_SERVER["DOCUMENT_ROOT"] .
    "/bitrix/modules/main/include/prolog_before.php");
//if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<?
$data = $_POST["data"];
$data = json_decode($data, TRUE);

CModule::IncludeModule("iblock");

foreach ($data as $key => $id){
    if (is_numeric($id)) {
        CIBlockElement::CounterInc($id);
    }
}

debug($data);


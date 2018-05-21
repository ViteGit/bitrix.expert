<?
require($_SERVER["DOCUMENT_ROOT"].
    "/bitrix/modules/main/include/prolog_before.php");
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<?
$dEnd = new DateTime ($arResult['TIMESTAMP_X']);
$dStart = new DateTime($arResult['DATE_CREATE']);
$diff = $dStart->diff($dEnd);
$res = $diff->format("%H:%I:%S");

if (CFormResult::SetField($arResult["ID"], 'time', $res)) {
echo 'все ок';
} else {
    echo 'не ок';
}



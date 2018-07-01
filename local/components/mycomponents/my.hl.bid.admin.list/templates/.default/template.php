<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult['ERROR'])) {
    echo $arResult['ERROR'];
    return false;
}
?>

<?
$arSort["DATE_ASC"] = array("NAME" => 'По возрастанию');
$arSort["DATE_DESC"] = array("NAME" => 'По убыванию');

$arFields = array(
    array(
        "TITLE" => 'Поиск по артиклу',
        "NAME" => "artnumber",
        "TYPE" => "TEXT",
        "VALUE" => $_REQUEST["artnumber"]),

    array(
        "TITLE" => 'Поиск по дате',
        "NAME" => "date_from",
        "NAME_TO" => "date_to",
        "TYPE" => "PERIOD",
        "VALUE" => $_REQUEST["date_from"],
        "VALUE_TO" => $_REQUEST["date_to"]),

);

$arFields[] = array(
    "TITLE" => 'Статус',
    "NAME" => "status",
    "TYPE" => "SELECT",
    "VALUE" => ['', 'Обрабатывается', 'Готов'],
    "ACTIVE" => $_REQUEST["status"]);


$arFields[] = array(
    "TITLE" => "Сортировка по дате",
    "NAME" => "sort",
    "TYPE" => "SELECT",
    "VALUE" => $arSort,
    "ACTIVE" => $_REQUEST["sort"]);

?>

<div class="forum-info-box forum-filter">
    <div class="forum-info-box-inner">
        <?
        $APPLICATION->IncludeComponent("bitrix:forum.interface", "filter_simple",
            array(
                "FIELDS" => $arFields,
                "FORM_METHOD_GET" => 'Y',
            ),
            $component,
            array(
                "HIDE_ICONS" => "Y")
        ); ?><?
        ?>
    </div>
</div>


<table cellspacing="0" class="reports-list-table" id="report-result-table">
    <thead>
    <tr>
        <th>
            <?= 'Артикул' ?>
        </th>

        <th>
            <?= 'Название Продукта' ?>
        </th>

        <th>
            <?= 'Дата' ?>
        </th>

        <th>
            <?= 'Статус' ?>
        </th>
    </tr>

    </thead>
    <tbody>
    <? foreach ($arResult["rows"] as $key => $arItem): ?>

    <?
    $query = CIBlockElement::GetByID($arItem['UF_ELEMENT_ID']);
    $arProduct = $query->fetch();

    $query = CIBlockElement::GetProperty($arProduct['IBLOCK_ID'], $arProduct['ID'], $arOrder = []);
    while ($prop = $query->fetch()){
    if ($prop['CODE'] == 'ARTNUMBER'){
    $arProduct['ARTNUMBER'] = $prop['VALUE'];
    }
    }
    ?>


    <tr class="elem" data-id="<?= $arItem["ID"] ?>">
        <a href="">
            <td>
                <?= $arProduct['ARTNUMBER'] ?>
            </td>

            <td>
                <?= $arProduct['NAME'] ?>
            </td>

            <td>
                <?= $arItem["UF_DATE"] ?>
            </td>

            <td>
                <? if ($arItem["UF_STATUS"] == 0) {
                echo 'Обрабатывается';
                } else if ($arItem["UF_STATUS"] == 1) {
                echo 'Обработан';
                }
                ?>
            </td>
        </a>
    </tr>
    <? endforeach; ?>
    </tbody>

</table>

<?php
if ($arParams['ROWS_PER_PAGE'] > 0):
$APPLICATION->IncludeComponent(
'bitrix:main.pagenavigation',
'',
array(
'NAV_OBJECT' => $arResult['nav_object'],
'SEF_MODE' => 'N',
),
false
);
endif;
?>

<form action="/local/components/mycomponents/my.hl.bid.admin.list/templates/.default/export.php" method="get">
    <input type="submit" id="submit" value="Экспорт" name="submit">
</form>

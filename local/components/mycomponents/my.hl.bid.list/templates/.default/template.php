<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult['ERROR'])) {
    echo $arResult['ERROR'];
    return false;
}

?>


    <table cellspacing="0" class="reports-list-table" id="report-result-table">
        <thead>
        <tr>
            <th>
                <?= 'Артикул' ?>
            </th>

            <th>
                <?= 'Название товара' ?>
            </th>

            <th>
                <?= 'ссылка на товар' ?>
            </th>

            <th>
                <?= 'дата' ?>
            </th>

            <th>
                <?= 'статус' ?>
            </th>

            <th>
                <?= 'комментарий' ?>
            </th>
        </tr>

        </thead>
        <tbody>
        <? foreach ($arResult["rows"] as $key => $arItem): ?>

            <? $query = CIBlockElement::GetByID($arItem['UF_ELEMENT_ID']);
            $arProduct = $query->Fetch();

            $query = CIBlockElement::GetProperty($arProduct['IBLOCK_ID'], $arItem['UF_ELEMENT_ID'], $arOrder = []);
            while ($prop = $query->Fetch()) {
                if ($prop['CODE'] == 'ARTNUMBER') {
                    $arProduct['ARTNUMBER'] = $prop['VALUE'];
                }
            }

            $arProduct['URL'] = CIBlock::ReplaceDetailURL($arProduct['DETAIL_PAGE_URL'], $arProduct, true, 'E');
            ?>

            <tr>
                <td>
                    <?= $arProduct['ARTNUMBER'] ?>
                </td>

                <td>
                    <?= $arProduct['NAME'] ?>
                </td>

                <td>
                    <a href="<?= $arProduct['URL'] ?>">ссылка на товар</a>
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

                <td>
                    <?= $arItem["UF_COMMENT"] ?>
                </td>
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
<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult['ERROR'])) {
    echo $arResult['ERROR'];
    return false;
}

$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/js/highloadblock/css/highloadblock.css');

?>


<table cellspacing="0" class="reports-list-table" id="report-result-table">
    <thead>
    <tr>
        <th>
            <?= $arResult["fields"]["UF_ARTNUMBER"]["EDIT_FORM_LABEL"] ?>
        </th>

        <th>
            <?= $arResult["fields"]["UF_PRODUCT_NAME"]["EDIT_FORM_LABEL"] ?>
        </th>

        <th>
            <?= $arResult["fields"]["UF_DETAIL_PAGE_URL"]["EDIT_FORM_LABEL"] ?>
        </th>

        <th>
            <?= $arResult["fields"]["UF_DATE"]["EDIT_FORM_LABEL"] ?>
        </th>

        <th>
            <?= $arResult["fields"]["UF_STATUS"]["EDIT_FORM_LABEL"] ?>
        </th>

        <th>
            <?= $arResult["fields"]["UF_COMMENT"]["EDIT_FORM_LABEL"] ?>
        </th>
    </tr>

    </thead>
    <tbody>
    <? foreach ($arResult["rows"] as $key => $arItem): ?>

        <tr>
            <td>
                <?= $arItem["UF_ARTNUMBER"] ?>
            </td>

            <td>
                <?= $arItem["UF_PRODUCT_NAME"] ?>
            </td>

            <td>
                <a href="<?= $arItem["UF_DETAIL_PAGE_URL"] ?>">ссылка на товар</a>
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

<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult['ERROR'])) {
    ShowError($arResult['ERROR']);
    return false;
}
?>

<form id="admin_form" data-ajax-entity-id="<?=$arResult['row']['ID'] ?>" action="javascript:void(0)" method="post">
    <table cellspacing="10" >
        <!-- head -->
        <tbody>
        <tr>
            <th class="reports-first-column" style="cursor: default">
                <div class="reports-head-cell"><span
                            class="reports-head-cell-title"><?= GetMessage('HLBLOCK_ROW_VIEW_NAME_COLUMN') ?></span>
                </div>
            </th>
            <th class="reports-last-column" style="cursor: default">
                <div class="reports-head-cell"><span
                            class="reports-head-cell-title"><?= GetMessage('HLBLOCK_ROW_VIEW_VALUE_COLUMN') ?></span>
                </div>
            </th>
        </tr>

        <tr>
            <td class="reports-first-column">ID</td>
            <td class="reports-last-column"><?= $arResult['row']['ID'] ?></td>
        </tr>

        <tr>
            <td><?= $arResult['fields']['UF_DATE']['EDIT_FORM_LABEL'] ?>:</td>
            <td><?= $arResult['fields']['UF_DATE']['VALUE'] ?></td>
        </tr>

        <tr>
            <td><?= $arResult['fields']['UF_FULLNAME']['EDIT_FORM_LABEL'] ?>:</td>
            <? if (isset($arResult['USER_DETAIL_LINK'])): ?>
                <td>
                    <a href="<?= $arResult['USER_DETAIL_LINK'] ?>"><?= $arResult['fields']['UF_FULLNAME']['VALUE'] ?></a>
                </td>
            <? else: ?>
                <td><?= $arResult['fields']['UF_FULLNAME']['VALUE'] ?></td>
            <? endif; ?>
        </tr>

        <tr>
            <td><?= $arResult['fields']['UF_PHONE']['EDIT_FORM_LABEL'] ?>:</td>
            <td><?= $arResult['fields']['UF_PHONE']['VALUE'] ?></td>
        </tr>

        <tr>
            <td><?= $arResult['fields']['PRODUCT']['PROPERTIES']['ARTNUMBER']['NAME'] ?>:</td>
            <td><?= $arResult['fields']['PRODUCT']['PROPERTIES']['ARTNUMBER']['VALUE'] ?></td>
        </tr>

        <tr>
            <td>Название товара:</td>
            <td>
                <a href="<?= $arResult['fields']['UF_DETAIL_PAGE_URL']['VALUE'] ?>"><?= $arResult['fields']['PRODUCT']['NAME'] ?></a>
            </td>
        </tr>

        <tr>
            <td>Изображение товара:</td>
            <td><img src="<?= $arResult['fields']['PRODUCT']['PREVIEW_PICTURE']['SRC'] ?>"></td>
        </tr>

        <tr>
            <td><?= $arResult['fields']['PRODUCT']['PROPERTIES']['PRICE']['NAME'] ?>:</td>
            <td><?= $arResult['fields']['PRODUCT']['PROPERTIES']['PRICE']['VALUE'] ?> рублей</td>
        </tr>

        <tr>
            <td><?= $arResult['fields']['UF_DESIRED_PRICE']['EDIT_FORM_LABEL'] ?>:</td>
            <td><?= $arResult['fields']['UF_DESIRED_PRICE']['VALUE'] ?> рублей</td>
        </tr>
        <tr>
            <td><?= $arResult['fields']['UF_COMMENT']['EDIT_FORM_LABEL'] ?>:</td>

            <? if (empty($arResult['fields']['UF_COMMENT']['VALUE'])): ?>
                <td class="comment"><textarea name="comment" id="comment" required></textarea></td>
            <? else: ?>
                <td class="comment2"><?= $arResult['fields']['UF_COMMENT']['VALUE'] ?> </td>
            <? endif ?>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <th>
                <input type="submit" name="apply" value="Обработано" id="submit2">
            </th>
        </tr>
        </tfoot>
    </table>
</form>

<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div style="display:none">
    <div id="add_form">
        <? $APPLICATION->IncludeComponent(
            "mycomponents:my.hl.add.form",
            ".default",
            Array(
                "AJAX_MODE" => "Y",
                "ELEMENT_ID" => $arResult['ID'],
                "BLOCK_ID" => "1",
                "CHECK_PERMISSIONS" => "N",
                "COMPONENT_TEMPLATE" => ".default",
                "LIST_URL" => "",
                "ROW_ID" => $_REQUEST["ID"],
                "ROW_KEY" => "ID"
            )
        ); ?>
    </div>
</div>
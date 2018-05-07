<?php
/**
 * Created by PhpStorm.
 * User: Вован
 * Date: 03.05.2018
 * Time: 14:42
 */

$arr_words = explode (' ', $arResult["NAME"]);
foreach ($arr_words as $key => $value){
    if (strlen($value) < 4){
        unset($arr_words[$key]);
    }
}

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL", "PROPERTY_*");
$arFilter = Array("IBLOCK_ID"=>IntVal(1), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "?NAME" => $arr_words);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
$res->SetUrlTemplates($arParams["DETAIL_URL"]);

$i = 0;
while($ob = $res->GetNextElement()){

    $arFields = $ob->GetFields();
    if ($i<=5){
        if ($arFields["NAME"] != $arResult["NAME"]){
            $arResult["RELATIVE_ARTICLES"][] = $arFields;
        }
    }
    $i++;
}
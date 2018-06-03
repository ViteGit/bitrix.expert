<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/***************** ADDITIONAL **************************************/
$arParams["USERS_PER_PAGE"] = (intVal($arParams["USERS_PER_PAGE"]) > 0 ? intVal($arParams["USERS_PER_PAGE"]) : 3);
/***************** STANDART ****************************************/
$arParams["DISPLAY_BOTTOM_PAGER"] = $arParams["DISPLAY_BOTTOM_PAGER"] != 'N';
$arParams["SET_TITLE"] = ($arParams["SET_TITLE"] == "N" ? "N" : "Y");
if ($arParams["CACHE_TYPE"] == "Y" || ($arParams["CACHE_TYPE"] == "A" && COption::GetOptionString("main", "component_cache_on", "Y") == "Y"))
    $arParams["CACHE_TIME"] = intval($arParams["CACHE_TIME"]);
else
    $arParams["CACHE_TIME"] = 0;


/********************************************************************
 * /Input params
 ********************************************************************/

/********************************************************************
 * Default params
 ********************************************************************/
$arResult["USERS"] = array();
$strError = "";
$by = "data_register";
$order = "DESC";
$arFilter = [];

/********************************************************************
 * /Default params
 ********************************************************************/


/********************************************************************
 * Data
 ********************************************************************/

$cache = new CPHPCache();

$cache_id = "my_users_new_";
$cache_path = str_replace(array(":", "//"), "/", "/" . SITE_ID . "/" . $componentName . "/");

if ($arParams["CACHE_TIME"] > 0 && $cache->initCache($arParams["CACHE_TIME"], $cache_id, $cache_path)){
    $vars = $cache->GetVars();
    $arResult = $vars["arResult"];

} else {
    $db_res = CUser::GetList($by, $order, $arFilter);
    if ($db_res) {
        $db_res->NavStart($arParams["USERS_PER_PAGE"], false);
        $arResult["NAV_STRING"] = $db_res->GetPageNavStringEx($navComponentObject, GetMessage("LU_TITLE_USER"));
        $arResult["NAV_RESULT"] = $db_res;
    }

    $i = 0;
    while ($res = $db_res->GetNext()) {
        $arResult["USERS"][$i] = $res;
        $url = str_replace("#LOGIN#", $res["LOGIN"], $arParams["URL_TEMPLATES_PROFILE_VIEW"]);
        $arResult["USERS"][$i]["DETAIL_URL"] = $url;
        $i++;
    }
}


//debug($arResult);

/********************************************************************
 * /Data
 ********************************************************************/

if ($cache->StartDataCache($arParams["CACHE_TIME"], $cache_id, $cache_path)) {

    $this->IncludeComponentTemplate();
    $templateCachedData = $this->GetTemplateCachedData();

    $cache->EndDataCache([
        "templateCachedData" => $templateCachedData,
        "arResult" => $arResult,
    ]);

} else {
    extract($cache->GetVars());

    foreach ($templateCachedData["externalCss"] as $key => $value){
        $APPLICATION->SetAdditionalCSS($value);
    }
    $this->SetTemplateCachedData($templateCachedData);
}

if ($arParams["SET_TITLE"] != "N")
    $APPLICATION->SetTitle(GetMessage("LU_TITLE_USER"));
/******************************************************************/
?>
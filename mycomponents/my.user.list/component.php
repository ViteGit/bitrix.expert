<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!CModule::IncludeModule("forum")):
    ShowError(GetMessage("F_NO_MODULE"));
    return 0;
endif;
/********************************************************************
 * Input params
 ********************************************************************/
/***************** BASE ********************************************/
/***************** Sorting *****************************************/
InitSorting($GLOBALS["APPLICATION"]->GetCurPage() . "?PAGE_NAME=user_list");
global $by, $order;
/***************** URL *********************************************/
$URL_NAME_DEFAULT = array(
    "message_send" => "PAGE_NAME=message_send&TYPE=#TYPE#&UID=#UID#",
    "pm_edit" => "PAGE_NAME=pm_edit&FID=#FID#&MID=#MID#&UID=#UID#&mode=#mode#",
    "profile_view" => "PAGE_NAME=profile_view&UID=#UID#",
    "user_post" => "PAGE_NAME=user_post&UID=#UID#&mode=#mode#");

foreach ($URL_NAME_DEFAULT as $URL => $URL_VALUE) {
    if (strLen(trim($arParams["URL_TEMPLATES_" . strToUpper($URL)])) <= 0)
        $arParams["URL_TEMPLATES_" . strToUpper($URL)] = $APPLICATION->GetCurPage() . "?" . $URL_VALUE;
    $arParams["~URL_TEMPLATES_" . strToUpper($URL)] = $arParams["URL_TEMPLATES_" . strToUpper($URL)];
    $arParams["URL_TEMPLATES_" . strToUpper($URL)] = htmlspecialcharsbx($arParams["~URL_TEMPLATES_" . strToUpper($URL)]);
}
/***************** ADDITIONAL **************************************/
// Page elements
$arParams["USERS_PER_PAGE"] = (intVal($arParams["USERS_PER_PAGE"]) > 0 ? intVal($arParams["USERS_PER_PAGE"]) : 20);
// Data and data-time format
$arParams["DATE_FORMAT"] = trim(empty($arParams["DATE_FORMAT"]) ? $DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")) : $arParams["DATE_FORMAT"]);
$arParams["DATE_TIME_FORMAT"] = trim(empty($arParams["DATE_TIME_FORMAT"]) ? $DB->DateFormatToPHP(CSite::GetDateFormat("FULL")) : $arParams["DATE_TIME_FORMAT"]);
$arParams["NAME_TEMPLATE"] = (!empty($arParams["NAME_TEMPLATE"]) ? $arParams["NAME_TEMPLATE"] : false);
$arParams["PAGE_NAVIGATION_TEMPLATE"] = trim($arParams["PAGE_NAVIGATION_TEMPLATE"]);
$arParams["WORD_LENGTH"] = intVal($arParams["WORD_LENGTH"]);
/***************** STANDART ****************************************/
$arParams["SET_TITLE"] = ($arParams["SET_TITLE"] == "N" ? "N" : "Y");
$arParams["SET_NAVIGATION"] = ($arParams["SET_NAVIGATION"] == "N" ? "N" : "Y");
// $arParams["DISPLAY_PANEL"] = ($arParams["DISPLAY_PANEL"] == "Y" ? "Y" : "N");
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
$arResult["SHOW_RESULT"] = "N";
$arResult["USERS"] = array();
/*************** Options and default settings **********************/
$parser = new forumTextParser(false, false, false, "light");
$parser->MaxStringLen = $arParams["WORD_LENGTH"];
/******************************************************************/
$strError = "";
$cache = new CPHPCache();
$cache_path_main = str_replace(array(":", "//"), "/", "/" . SITE_ID . "/" . $componentName . "/");
/********************************************************************
 * /Default params
 ********************************************************************/

/********************************************************************
 * Data
 ********************************************************************/
$cache_id = "forum_forums_listex_" . (($tzOffset = CTimeZone::GetOffset()) <> 0 ? "_" . $tzOffset : "");
$cache_path = $cache_path_main . "forums";
if ($arParams["CACHE_TIME"] > 0 && $cache->InitCache($arParams["CACHE_TIME"], $cache_id, $cache_path)) {
    $res = $cache->GetVars();
    if (is_array($res["arForums"]))
        $arForums = CForumCacheManager::Expand($res["arForums"]);
}
if (!is_array($arForums) || empty($arForums)) {
    $db_res = CForumNew::GetListEx();
    while ($res = $db_res->GetNext())
        $arForums[$res["ID"]] = array("ID" => $res["ID"], "NAME" => $res["NAME"]);

    if ($arParams["CACHE_TIME"] > 0):
        $cache->StartDataCache($arParams["CACHE_TIME"], $cache_id, $cache_path);
        $cache->EndDataCache(array("arForums" => CForumCacheManager::Compress($arForums)));
    endif;
}

/******************************************************************/
if (!$USER->IsAdmin())
    $arFilter["ACTIVE"] = "Y";
if (strLen($_REQUEST["del_filter"]) <= 0 && strLen($_REQUEST["set_filter"]) > 0) {
    if (strlen($_REQUEST["date_last_visit1"]) > 0 && !$GLOBALS["DB"]->IsDate($_REQUEST["date_last_visit1"]))
        $strError .= GetMessage("LU_INCORRECT_LAST_MESSAGE_DATE");
    elseif (strlen($_REQUEST["date_last_visit2"]) > 0 && !$GLOBALS["DB"]->IsDate($_REQUEST["date_last_visit2"]))
        $strError .= GetMessage("LU_INCORRECT_LAST_MESSAGE_DATE");
    if (empty($strError)) {
        if (intVal($_REQUEST["date_last_visit1_DAYS_TO_BACK"]) > 0)
            $_REQUEST["date_last_visit1"] = GetTime(time() - 86400 * intval($_REQUEST["date_last_visit1_DAYS_TO_BACK"]));
        if (strlen($_REQUEST["date_last_visit1"]) > 0)
            $arFilter[">=LAST_VISIT"] = $_REQUEST["date_last_visit1"];
        if (strlen($_REQUEST["date_last_visit2"]) > 0)
            $arFilter["<=LAST_VISIT"] = $_REQUEST["date_last_visit2"];
    }

    $_REQUEST["user_mail"] = trim($_REQUEST["user_name"]);
    if (!empty($_REQUEST["user_mail"]))
        $arFilter["EMAIL"] = $_REQUEST["user_mail"];



    /************** For custom ****************************************/
    $arResult["filter"]["date_last_visit"] = CalendarPeriod("date_last_visit1", $_REQUEST["date_last_visit1"], "date_last_visit2",
        $_REQUEST["date_last_visit2"], "form1", "Y", "", "");
    $arResult["filter"]["~user_mail"] = $_REQUEST["user_mail"];
    $arResult["filter"]["user_mail"] = htmlspecialcharsbx($_REQUEST["user_mail"]);
    /************** For custom/****************************************/
} elseif (strLen($_REQUEST["del_filter"]) > 0) {
    unset($_REQUEST["user_mail"]);
    unset($_REQUEST["date_last_visit2"]);
    unset($_REQUEST["date_last_visit1"]);
    unset($_REQUEST["sort"]);
    /************** For custom ****************************************/
    unset($GLOBALS["date_last_visit1_DAYS_TO_BACK"]);
    $arResult["filter"] = array();
    $arResult["filter"]["date_last_visit"] = CalendarPeriod("date_last_visit1", "", "date_last_visit2", "", "form1", "Y", "", "");
    /************** For custom/****************************************/
}
if (!$by && !is_set($_REQUEST, "sort")) {
    $by = "NUM_POSTS";
    $order = "DESC";
    $_REQUEST["sort"] = "NUM_POSTS";
} elseif (!$by && is_set($_REQUEST, "sort")) {
    $by = $_REQUEST["sort"];
    $order = ($_REQUEST["sort"] == "SHOW_ABC" ? "ASC" : "DESC");
}
/******************************************************************/
$arResult["ERROR_MESSAGE"] = $strError;
CPageOption::SetOptionString("main", "nav_page_in_session", "N");

$db_res = CUser::GetList(
    $by, $order, $arFilter
//    array("bDescPageNumbering" => false,
//        "nPageSize" => $arParams["USERS_PER_PAGE"],
//        "bShowAll" => false,
//        "sNameTemplate" => $arParams["NAME_TEMPLATE"]
//    )
);

if ($db_res) {
    $db_res->NavStart($arParams["USERS_PER_PAGE"], false);
    $arResult["NAV_STRING"] = $db_res->GetPageNavStringEx($navComponentObject, GetMessage("LU_TITLE_USER"), $arParams["PAGE_NAVIGATION_TEMPLATE"]);
    $arResult["NAV_RESULT"] = $db_res;
    $arResult["SHOW_RESULT"] = "Y";
    $arResult["SortingEx"]["SHOW_ABC"] = SortingEx("SHOW_ABC", $APPLICATION->GetCurPageParam());
    $arResult["SortingEx"]["NUM_POSTS"] = SortingEx("NUM_POSTS", $APPLICATION->GetCurPageParam());
    $arResult["SortingEx"]["POINTS"] = SortingEx("POINTS", $APPLICATION->GetCurPageParam());
    $arResult["SortingEx"]["DATE_REGISTER"] = SortingEx("DATE_REGISTER", $APPLICATION->GetCurPageParam());
    $arResult["SortingEx"]["LAST_VISIT"] = SortingEx("LAST_VISIT", $APPLICATION->GetCurPageParam());

    if ($res = $db_res->GetNext()) {
        do {
            $arUserGroup = array();
            $UserPerm = array();
            $res["AUTHOR_STATUS"] = "";
            $res["AUTHOR_STATUS_CODE"] = "";
            // geting max permisson of User from all forums

            $res["URL"] = array(
                "DETAIL" => CComponentEngine::MakePathFromTemplate($arParams["URL_TEMPLATES_PROFILE_VIEW"], array("UID" => $res["USER_ID"])),
                "~DETAIL" => CComponentEngine::MakePathFromTemplate($arParams["~URL_TEMPLATES_PROFILE_VIEW"], array("UID" => $res["USER_ID"])),
                );

            $res["profile_view"] = $res["URL"]["DETAIL"];

            ////
            $url = str_replace("#LOGIN#", $res["LOGIN"], $res["profile_view"]);
            $res["DETAIL_URL"] = $url;
            ////

            $arResult["USERS"][] = $res;

        } while ($res = $db_res->GetNext()

        );

    }
}

/********************************************************************
 * /Data
 ********************************************************************/
$this->IncludeComponentTemplate();
if ($arParams["SET_NAVIGATION"] != "N")
    $APPLICATION->AddChainItem(GetMessage("LU_TITLE_USER"));
if ($arParams["SET_TITLE"] != "N")
    $APPLICATION->SetTitle(GetMessage("LU_TITLE_USER"));
/******************************************************************/
?>
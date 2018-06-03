<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!CModule::IncludeModule("forum"))
    return;
$arComponentParameters = array(
    "GROUPS" => array(
        "URL_TEMPLATES" => array(
            "NAME" => GetMessage("F_URL_TEMPLATES"),
        ),
    ),
    "PARAMETERS" => array(

        "URL_TEMPLATES_PROFILE_VIEW" => Array(
            "PARENT" => "URL_TEMPLATES",
            "NAME" => GetMessage("F_PROFILE_VIEW_TEMPLATE"),
            "TYPE" => "STRING",
            "DEFAULT" => "/admin/users/#LOGIN#/"),

        "USERS_PER_PAGE" => Array(
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME" => GetMessage("F_USERS_PER_PAGE"),
            "TYPE" => "STRING",
            "DEFAULT" => "3"),

        "DISPLAY_BOTTOM_PAGER" => Array(
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME" => GetMessage("SHOW_BOTTOM_PAGER"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "N",
        ),


        "SET_TITLE" => Array(),
        "CACHE_TIME" => Array(),
    )
);


?>
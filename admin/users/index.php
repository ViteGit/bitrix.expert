<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Пользователи");
?><?$APPLICATION->IncludeComponent(
	"mycomponents:my.user.list", 
	".default", 
	array(
		"CACHE_TIME" => "30",
		"CACHE_TYPE" => "N",
		"DATE_FORMAT" => "d.m.Y",
		"DATE_TIME_FORMAT" => "d.m.Y H:i:s",
		"PAGE_NAVIGATION_TEMPLATE" => "",
		"SEO_USER" => "Y",
		"SET_NAVIGATION" => "Y",
		"SET_TITLE" => "Y",
		"URL_TEMPLATES_PROFILE_VIEW" => "#LOGIN#/",
		"USERS_PER_PAGE" => "20",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentDescription = array(
	"NAME" => GetMessage("MY_USER_LIST"),
	"DESCRIPTION" => GetMessage("MY_USER_LIST_DESCRIPTION"),
	"ICON" => "/images/icon.gif",
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "my",
			"NAME" => GetMEssage("MY")
		)
	),
);
?>
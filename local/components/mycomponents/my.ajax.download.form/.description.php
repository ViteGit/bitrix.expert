<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("FORM_RESULT_NEW_COMPONENT_NAME"),
	"DESCRIPTION" => GetMessage("FORM_RESULT_NEW_COMPONENT_DESCR"),
	"ICON" => "/images/comp_result_new.gif",
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "my",
			"NAME" => GetMessage("MY"),
			"CHILD" => array(
				"ID" => "form_cmpx",
			),
		)
	),
);
?>
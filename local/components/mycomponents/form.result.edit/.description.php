<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("FORM_RESULT_EDIT_COMPONENT_NAME"),
	"DESCRIPTION" => GetMessage("FORM_RESULT_EDIT_COMPONENT_DESCR"),
	"ICON" => "/images/comp_result_edit.gif",
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "my",
			"NAME" => GetMessage("MY"),
		)
	),
);
?>
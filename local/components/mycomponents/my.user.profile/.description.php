<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("MY_USER_PROFILE_TITLE"),
	"DESCRIPTION" => GetMessage("MY_USER_PROFILE_DESCR"),
	"ICON" => "/images/user_profile.gif",
	"PATH" => array(
			"ID" => "content",
			"CHILD" => array(
				"ID" => "my",
				"NAME" => GetMessage("MY")
			)
		),
);
?>
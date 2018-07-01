<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle(""); ?><?$APPLICATION->IncludeComponent(
	"bitrix:main.register",
	"",
Array(),
false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("хочу дешевле");
?><?

//Подготовка:
//if (CModule::IncludeModule('highloadblock')) {
//    $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(1)->fetch();
//    $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
//    $strEntityDataClass = $obEntity->getDataClass();
//}
//
//////Добавление:
////if (CModule::IncludeModule('highloadblock')) {
////    $arElementFields = array(
////        'UF_NAME' => $arPost['name'],
////        'UF_MESSAGE' => $arPost['message'],
////        'UF_DATETIME' => new \Bitrix\Main\Type\DateTime
////    );
////    $obResult = $strEntityDataClass::add($arElementFields);
////    $ID = $obResult->getID();
////    $bSuccess = $obResult->isSuccess();
////}
//
////Получение списка:
//if (CModule::IncludeModule('highloadblock')) {
//    $rsData = $strEntityDataClass::getList(array(
//        'order' => array('ID' => 'DESC'),
//    ));
//    while ($arItem = $rsData->Fetch()) {
//        $arItems[] = $arItem;
//    }
//
//    debug($arItems);
//}

?> <br>
<br>
 <br>
 <?$APPLICATION->IncludeComponent(
	"mycomponents:my.hl.bid.list", 
	".default", 
	array(
		"BLOCK_ID" => "1",
		"CHECK_PERMISSIONS" => "N",
		"DETAIL_URL" => "",
		"FILTER_NAME" => "",
		"PAGEN_ID" => "page",
		"ROWS_PER_PAGE" => "5",
		"SORT_FIELD" => "ID",
		"SORT_ORDER" => "DESC",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
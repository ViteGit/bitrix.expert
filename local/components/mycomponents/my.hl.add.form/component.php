<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
$requiredModules = ['highloadblock', 'iblock'];
foreach ($requiredModules as $requiredModule)
{
	if (!\Bitrix\Main\Loader::includeModule($requiredModule))
	{
		ShowError(GetMessage('F_NO_MODULE'));
		return 0;
	}
}

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

global $USER_FIELD_MANAGER;

$arResult['ERROR']  = '';

// hlblock info
$hlblock_id = $arParams['BLOCK_ID'];

if (empty($hlblock_id))
{
	$arResult['ERROR'] = GetMessage('HLBLOCK_VIEW_NO_ID');
}
else
{
	$hlblock = HL\HighloadBlockTable::getById($hlblock_id)->fetch();
	if (empty($hlblock))
	{
		$arResult['ERROR'] = GetMessage('HLBLOCK_VIEW_404');
	}
}

// check rights
if (isset($arParams['CHECK_PERMISSIONS']) && $arParams['CHECK_PERMISSIONS'] == 'Y' && !$USER->isAdmin())
{
	$operations = HL\HighloadBlockRightsTable::getOperationsName($hlblock_id);
	if (empty($operations))
	{
		$arResult['ERROR'] = GetMessage('HLBLOCK_VIEW_404');
	}
}

if ($arResult['ERROR'] == '')
{
	$entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();


    if (!isset($arParams['ROW_KEY']) || trim($arParams['ROW_KEY']) == '')
	{
		$arParams['ROW_KEY'] = 'ID';
	}


    $user_id = CUser::GetID();
    if ($user_id){
        $CDBResult = CUser::GetByID($user_id);
        $user = $CDBResult->fetch();
        $arResult['FULLNAME'] = $user['NAME'] . ' ' . $user['LAST_NAME'] . ' ' . $user['SECOND_NAME'];
        $arResult['PERSONAL_PHONE'] = $user['PERSONAL_PHONE'];
    }

   // debug($GLOBALS['HLblock']);

    $element_id =  isset($GLOBALS['HLblock']['ELEMENT_ID']) ? $GLOBALS['HLblock']['ELEMENT_ID'] : 0;

    $date = date('d.m.Y H:i:s');
    $artnumber = $GLOBALS['HLblock']['ARTNUMBER'];
    $product_name = $GLOBALS['HLblock']['NAME'];
    $detail_page_url = $GLOBALS['HLblock']['DETAIL_PAGE_URL'];
    $status = 0;

    if (isset($_POST["submit"])){
        $fullname = isset($_POST["fullname"])? $_POST["fullname"] : null;
        $phone = isset($_POST["phone"])? $_POST["phone"] : null;
        $desired_price = isset($_POST["desired_price"])? $_POST["desired_price"] : null;


        if ($fullname && $phone && $desired_price){

            $arElementFields = array(
            'UF_USER_ID' => $user_id,
            'UF_FULLNAME' => $fullname,
            'UF_PHONE' => $phone,
            'UF_DESIRED_PRICE' => $desired_price,
            'UF_ELEMENT_ID' => $element_id,
            'UF_DATE' => $date,
            'UF_ARTNUMBER' => $artnumber,
            'UF_PRODUCT_NAME' => $product_name,
            'UF_DETAIL_PAGE_URL' => $detail_page_url,
            'UF_STATUS' => $status,
        );

        $obResult = $entity_data_class::add($arElementFields);
        $ID = $obResult->getID();
        $bSuccess = $obResult->isSuccess();

        LocalRedirect($_SERVER['REQUEST_URI']);

        }
    }

}


$this->IncludeComponentTemplate();

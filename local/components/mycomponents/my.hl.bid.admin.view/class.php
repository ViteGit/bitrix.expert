<?php

use Myclass\Lowprice\LowPriceTable;

use Bitrix\Highloadblock as HL;

/**
 * Created by PhpStorm.
 * User: Вован
 * Date: 30.06.2018
 * Time: 13:49
 */
class HLBidAdminView extends CBitrixComponent
{
    public function executeComponent()
    {
        try {
            $this->includeModules();
            $this->MainMethod();
            $this->includeComponentTemplate();

        } catch (Exception $e) {
            $this->__showError($e->getMessage());
        }


        return parent::executeComponent(); // TODO: Change the autogenerated stub
    }

    public function onPrepareComponentParams($arParams)
    {
        return parent::onPrepareComponentParams($arParams); // TODO: Change the autogenerated stub
    }

    private function includeModules()
    {
        $modules = ['highloadblock', 'iblock'];
        foreach ($modules as $module) {
            if (!\Bitrix\Main\Loader::includeModule($module)) {
                return;
            }
        }
    }

    private function MainMethod()
    {
        global $USER_FIELD_MANAGER;

        $hlblock_id = $this->arParams['BLOCK_ID'];
        if (empty($hlblock_id)) {
            $this->arResult['ERROR'] = GetMessage('HLBLOCK_VIEW_404');
        } else {
            $hlblock = HL\HighloadBlockTable::getById($hlblock_id)->fetch();
        }

        $parameters = [
            'select' => ['*'],
            'filter' => [
                '=ID' => $this->arParams['ROW_ID']
            ]
        ];

        $result = LowPriceTable::GetById($this->arParams['ROW_ID']);
        $this->arResult['row'] = $result->fetch();


        $fields = $USER_FIELD_MANAGER->getUserFieldsWithReadyData(
            'HLBLOCK_' . $hlblock['ID'],
            $this->arResult['row'],
            LANGUAGE_ID
        );

        if (!empty($this->arResult['row']['UF_USER_ID'])) {
            $rsUser = CUser::GetByID($this->arResult['row']['UF_USER_ID']);
            $user = $rsUser->fetch();
            $this->arResult['USER_DETAIL_LINK'] = str_replace('#LOGIN#', $user['LOGIN'], $this->arParams['USER_PROFILE']);
        }

        $result = CIBlockElement::GetByID($this->arResult['row']['UF_ELEMENT_ID']);
        $product = $result->fetch();
        $preview_picture = CFile::GetFileArray($product['PREVIEW_PICTURE']);
        $properties_query = CIBlockElement::GetProperty($product['IBLOCK_ID'], $product['ID'], $arOrder = []);
        while ($properties = $properties_query->fetch()) {
            if ($properties['CODE'] == 'PRICE') {
                $prop['PRICE'] = $properties;
            } elseif ($properties['CODE'] == 'ARTNUMBER') {
                $prop['ARTNUMBER'] = $properties;
            }
        }

        $this->arResult['fields'] = $fields;
        $this->arResult['fields']["PRODUCT"] = $product;
        $this->arResult['fields']["PRODUCT"]["PREVIEW_PICTURE"] = $preview_picture;
        $this->arResult['fields']["PRODUCT"]["PROPERTIES"] = $prop;
        $this->arResult['fields']['DETAIL_PAGE_URL']['VALUE'] = CIBlock::ReplaceDetailUrl($product['DETAIL_PAGE_URL'], $product, true, 'E');

    }

}
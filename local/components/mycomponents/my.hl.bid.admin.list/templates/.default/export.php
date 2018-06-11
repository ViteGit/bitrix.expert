<?php
/**
 * Created by PhpStorm.
 * User: Вован
 * Date: 11.06.2018
 * Time: 10:46
 */

require($_SERVER["DOCUMENT_ROOT"].
    "/bitrix/modules/main/include/prolog_before.php");
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


CModule::IncludeModule('highloadblock');

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

const HL_BLOCK_ID = 1;

$hlblock = HL\HighloadBlockTable::getById(HL_BLOCK_ID)->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $main_query = new Entity\Query($entity);
    $main_query->setSelect(array('*'));
    $main_query->setFilter(array('=UF_STATUS' => 1));

    $result = $main_query->exec();
    $result = new CDBResult($result);

    while ($row = $result->Fetch()) {
        $rows[] = $row;
    }

    $arExport['hlblock'] = $hlblock;
    $arExport['row'] = $rows;

    $xml = new xml();
    $xml->StartFile();
    $xml->OpenTag('hiblock');
    $xml->WriteItem($arExport['hlblock'], 'hlblock');
    $xml->WriteItem($arExport['row'],'items', 'item');
    $xml->EndTag('hiblock');
    $xml->CloseFile();

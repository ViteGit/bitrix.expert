<?php

namespace Myclass\Lowprice;
use Bitrix\Main\DB\Exception;
use Bitrix\Main\Entity;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


class LowPriceTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'lowprice';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),

            new Entity\IntegerField('UF_USER_ID', array(
            )),

            new Entity\IntegerField('UF_ELEMENT_ID', array(
                'required' => true,
            )),

            new Entity\StringField('UF_FULLNAME', array(
                'required' => true,
            )),

            new Entity\StringField('UF_PHONE', array(
                'required' => true,
            )),

            new Entity\StringField('UF_DESIRED_PRICE', array(
                'required' => true,
            )),

            new Entity\DateField('UF_DATE'),

            new Entity\IntegerField('UF_STATUS'),

            new Entity\StringField('UF_COMMENT'),

        );
    }

//    public static function onBeforeAdd(Entity\Event $event){
//
//        $result = new Entity\EventResult;
//        $data = $event->getParameter("fields");
//
//        //debug($data);
//        if (empty($data['UF_DESIRED_PRICE'])){
//        }
//
//    }


}

<?php
/**
 * Created by PhpStorm.
 * User: Вован
 * Date: 30.04.2018
 * Time: 16:09
 */

if (file_exists($_SERVER["DOCUMENT_ROOT"] . '/local/templates/exam1/includes/event_handlers.php')){
    require_once ($_SERVER["DOCUMENT_ROOT"] . '/local/templates/exam1/includes/event_handlers.php');
}

if (file_exists($_SERVER["DOCUMENT_ROOT"] . '/local/templates/exam1/includes/agent.php')){
    require_once ($_SERVER["DOCUMENT_ROOT"] . '/local/templates/exam1/includes/agent.php');
}

if (file_exists($_SERVER["DOCUMENT_ROOT"] . '/local/templates/exam1/includes/myclasses/xml.php')){
    require_once ($_SERVER["DOCUMENT_ROOT"] . '/local/templates/exam1/includes/myclasses/xml.php');

}if (file_exists($_SERVER["DOCUMENT_ROOT"] . '/local/templates/exam1/includes/myclasses/LowPrice.php')){
    require_once ($_SERVER["DOCUMENT_ROOT"] . '/local/templates/exam1/includes/myclasses/LowPrice.php');
}


function debug($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}


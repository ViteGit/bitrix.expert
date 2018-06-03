<?php
/**
 * Created by PhpStorm.
 * User: Вован
 * Date: 01.06.2018
 * Time: 15:30
 */

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (!CModule::IncludeModule("form"))
    die();

    if (CUser::GetID()){
        $arFile = CFile::GetFileArray($_REQUEST["id"]);
        if ($arFile)
        {
            set_time_limit(0);

            $options = array();
            if ($_REQUEST["action"] == "download")
            {
                $options["force_download"] = true;
            }

            CFile::ViewByUser($arFile, $options);
        }
    } else {
        CHTTP::SetStatus("404 Not Found");
        @define("ERROR_404","Y");
        LocalRedirect("/404.php");
    }


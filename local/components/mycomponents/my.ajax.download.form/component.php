<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?

if (CModule::IncludeModule("form"))
{

        $arIMAGE = $_FILES['file'];

        $fid = CFile::SaveFile($arIMAGE, "form");

        if ($fid) {
            $href = "/local/components/mycomponents/my.ajax.download.form/templates/.default/download.php?id=" . $fid . "&action=download";
            $GLOBALS['APPLICATION']->RestartBuffer();

            echo "<a href=\"$href\">скачать</a>";

            die();
        };

		$this->IncludeComponentTemplate();
}
?>
<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$GLOBALS['APPLICATION']->SetAdditionalCSS("/local/templates/exam1/css/template_style.css");

?>

<table class="form-table data-table">
    <form method="post" action="" enctype="multipart/form-data">
        <thead>
        <tr>
            <th colspan="2">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>ФИО</td>
            <td><input type="text" id="fullname" value="<?if(isset($arResult["FULLNAME"])) {echo $arResult["FULLNAME"];}?>" name="fullname"/></td>
        </tr>
        <tr>
        <td>Телефон</td>
            <td><input type="text" value="<?if(isset($arResult["FULLNAME"])) {echo $arResult["PERSONAL_PHONE"];}?>" id="phone" name="phone"/></td>
        </tr>
        <tr>
        <td>Желаемая цена</td>
            <td><input type="text" id="desired_price" name="desired_price"/></td>
        </tr>
        </tbody>

        <tfoot>
        <tr>
            <th colspan="2"><input type="submit" name="submit" id="aply"/></th>
        </tr>
        </tfoot>
    </form>
</table>

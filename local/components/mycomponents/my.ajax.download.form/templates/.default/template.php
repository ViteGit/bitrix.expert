<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$bxajaxid = CAjax::GetComponentID($component->__name, $component->__template->__name);
?>

    <table class="form-table data-table">
        <form  data-ajax-id="<?=$bxajaxid?>" id="ajax-form" method="post" action="javascript:void(0)" enctype="multipart/form-data">

            <thead>
            <tr>
                <th colspan="2">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Изображение</td>

                <td id="link"><input type="file" id="img" name="img"/></td>
            </tr>
            </tbody>

            <tfoot>
            <tr>
                <th colspan="2"><input type="submit" name="submit" id="aply"/></th>
            </tr>
            </tfoot>

        </form>
    </table>

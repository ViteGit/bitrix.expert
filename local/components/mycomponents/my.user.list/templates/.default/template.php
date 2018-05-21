<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?><?
if (!$this->__component->__parent || empty($this->__component->__parent->__name)):
    $GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/forum/templates/.default/style.css');
    $GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/forum/templates/.default/themes/blue/style.css');
    $GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/forum/templates/.default/styles/additional.css');
endif;


/********************************************************************
 * Input params
 ********************************************************************/
$arParams["SEO_USER"] = (in_array($arParams["SEO_USER"], array("Y", "N", "TEXT")) ? $arParams["SEO_USER"] : "Y");
$arParams["USER_TMPL"] = '<noindex><a rel="nofollow" href="#URL#" title="' . GetMessage("F_USER_PROFILE") . '">#NAME#</a></noindex>';
if ($arParams["SEO_USER"] == "N") $arParams["USER_TMPL"] = '<a href="#URL#" title="' . GetMessage("F_USER_PROFILE") . '">#NAME#</a>';
elseif ($arParams["SEO_USER"] == "TEXT") $arParams["USER_TMPL"] = '#NAME#';
/********************************************************************
 * /Input params
 ********************************************************************/


$arSort = array(
    "NUM_POSTS" => array("NAME" => GetMessage("LU_FILTER_SORT_NUM_POSTS")),
    "SHOW_ABC" => array("NAME" => GetMessage("LU_FILTER_SORT_NAME")),
);
if ($arResult["SHOW_VOTES"] == "Y"):
    $arSort["POINTS"] = array("NAME" => GetMessage("LU_FILTER_SORT_POINTS"));
endif;
$arSort["DATE_REGISTER"] = array("NAME" => GetMessage("LU_FILTER_SORT_DATE_REGISTER"));
$arSort["LAST_VISIT"] = array("NAME" => GetMessage("LU_FILTER_SORT_LAST_VISIT"));
$arFields = array(
    array(
        "NAME" => "PAGE_NAME",
        "TYPE" => "HIDDEN",
        "VALUE" => "user_list"),
    array(
        "TITLE" => GetMessage("LU_FILTER_USER_NAME"),
        "NAME" => "user_name",
        "TYPE" => "TEXT",
        "VALUE" => $_REQUEST["user_name"]),
    array(
        "TITLE" => GetMessage("LU_FILTER_LAST_VISIT"),
        "NAME" => "date_last_visit1",
        "NAME_TO" => "date_last_visit2",
        "TYPE" => "PERIOD",
        "VALUE" => $_REQUEST["date_last_visit1"],
        "VALUE_TO" => $_REQUEST["date_last_visit2"]),

);

?>

<div class="forum-info-box forum-filter">
    <div class="forum-info-box-inner">
        <?
        $APPLICATION->IncludeComponent("bitrix:forum.interface", "filter_simple",
            array(
                "FIELDS" => $arFields,
                "FORM_METHOD_GET" => 'Y',
            ),
            $component,
            array(
                "HIDE_ICONS" => "Y")
        ); ?><?
        ?>
    </div>
</div>

<br/>
<?
if (!empty($arResult["ERROR_MESSAGE"])):
?>
<div class="forum-note-box forum-note-error">
    <div class="forum-note-box-text"><?= ShowError($arResult["ERROR_MESSAGE"], "forum-note-error"); ?></div>
</div>
<?
endif;
if (!empty($arResult["OK_MESSAGE"])):
?>
<div class="forum-note-box forum-note-success">
    <div class="forum-note-box-text"><?= ShowNote($arResult["OK_MESSAGE"], "forum-note-success") ?></div>
</div>
<?
endif;

if ($arResult["NAV_RESULT"]->NavPageCount > 0):
?>
<div class="forum-navigation-box forum-navigation-top">
    <div class="forum-page-navigation">
        <?= $arResult["NAV_STRING"] ?>
    </div>
    <div class="forum-clear-float"></div>
</div>
<?
endif;

?>
<div class="forum-header-box">
    <div class="forum-header-title"><span><?= GetMessage("LU_TITLE_USER") ?></span></div>
</div>
<div class="forum-block-container">
    <div class="forum-block-outer">
        <div class="forum-block-inner">
            <table cellspacing="0" class="forum-table forum-users">
                <thead>
                <tr>
                    <th class="forum-first-column forum-column-username">
                        <span><?= GetMessage("FLU_HEAD_NAME") ?></span><? /*&nbsp;<br/><?=$arResult["SortingEx"]["SHOW_ABC"]?>*/ ?>
                    </th>
                    <th class="forum-column-posts">
                        <span><?= GetMessage("FLU_HEAD_EMAIL") ?></span><? /*&nbsp;<br/><?=$arResult["SortingEx"]["NUM_POSTS"]?>*/ ?>
                    </th>

                    <th class="forum-column-datereg">
                        <span><?= GetMessage("FLU_HEAD_DATE_REGISTER") ?></span><? /*?>&nbsp;<br/><?=$arResult["SortingEx"]["DATE_REGISTER"]?><?*/ ?>
                    </th>
                    <th class="forum-last-column forum-column-lastvisit">
                        <span><?= GetMessage("FLU_HEAD_LAST_VISIT") ?></span><? /*?>&nbsp;<br/><?=$arResult["SortingEx"]["LAST_VISIT"]?><?*/ ?>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?
                if ($arResult["SHOW_RESULT"] != "Y"):
                ?>
                <tr class="forum-row-first forum-row-odd">
                    <td class="forum-first-column"
                        colspan="<?= ($arResult["SHOW_VOTES"] == "Y" ? 5 : 4) ?>"><?= GetMessage("FLU_EMPTY") ?></td>
                </tr>
                <?
                return false;
                endif;

                $iCount = 0;


                foreach ($arResult["USERS"] as $res):

                $full_name = $res["NAME"] .' '. $res["LAST_NAME"];
                $iCount++;
                ?>
                <tr class="<?= ($iCount == 1 ? "forum-row-first " : (
                $iCount == count($arResult["USERS"]) ? "forum-row-last " : "")) ?><?= ($iCount%2 == 1 ? "forum-row-odd" : "forum-row-even") ?>">
                    <td class="forum-first-column forum-column-username">

                        <div class="forum-user-name">
                            <?= str_replace(array("#URL#", "#NAME#"), array($res["DETAIL_URL"], $full_name), $arParams["USER_TMPL"]) ?>
                        </div>


                        <div class="forum-user-status <?= (!empty($res["LOGIN"]) ? "forum-user-".$res["LOGIN"]."-status" : "") ?>">
                            <span><?= htmlspecialcharsbx($res["LOGIN"]) ?></span>
                        </div>
                    </td>

                    <td class="forum-column-posts">
                        <? if (!empty($res["EMAIL"])): ?>
                            <?= ($res["EMAIL"]) ?>
                        <? endif; ?>
                    </td>

                    <td class="forum-column-datereg">
                        <? if (!empty($res["DATE_REGISTER"])): ?>
						<?= $res["DATE_REGISTER"] ?>
                            &nbsp;
                        <? endif; ?>
                    </td>
                    <td class="forum-last-column forum-column-lastvisit">
                        <? if (!empty($res["LAST_LOGIN"])): ?>
						<?= $res["LAST_LOGIN"] ?>
                            &nbsp;
                        <? endif; ?>
                    </td>
                </tr>
                <?
                endforeach;
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?

if ($arResult["NAV_RESULT"]->NavPageCount > 0):
?>
<div class="forum-navigation-box forum-navigation-bottom">
    <div class="forum-page-navigation">
        <?= $arResult["NAV_STRING"] ?>
    </div>
    <div class="forum-clear-float"></div>
</div>
<?
endif;

?>
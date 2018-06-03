<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?

if (!$this->__component->__parent || empty($this->__component->__parent->__name)):
    $this->addExternalCss('/bitrix/components/bitrix/forum/templates/.default/style.css');
    $this->addExternalCss('/bitrix/components/bitrix/forum/templates/.default/themes/blue/style.css');
    $this->addExternalCss('/bitrix/components/bitrix/forum/templates/.default/styles/additional.css');
endif;

///********************************************************************
// * Input params
// ********************************************************************/
$arParams["SEO_USER"] = (in_array($arParams["SEO_USER"], array("Y", "N", "TEXT")) ? $arParams["SEO_USER"] : "Y");
$arParams["USER_TMPL"] = '<noindex><a rel="nofollow" href="#URL#" title="' . GetMessage("F_USER_PROFILE") . '">#NAME#</a></noindex>';
if ($arParams["SEO_USER"] == "N") $arParams["USER_TMPL"] = '<a href="#URL#" title="' . GetMessage("F_USER_PROFILE") . '">#NAME#</a>';
elseif ($arParams["SEO_USER"] == "TEXT") $arParams["USER_TMPL"] = '#NAME#';
///********************************************************************
// * /Input params
// ********************************************************************/
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
                            <span><?= GetMessage("FLU_HEAD_NAME") ?></span>
                        </th>
                        <th class="forum-column-posts">
                            <span><?= GetMessage("FLU_HEAD_EMAIL") ?></span>
                        </th>

                        <th class="forum-column-datereg">
                            <span><?= GetMessage("FLU_HEAD_DATE_REGISTER") ?></span>&nbsp;<br/><?= $arResult["SortingEx"]["DATE_REGISTER"] ?>
                        </th>
                        <th class="forum-last-column forum-column-lastvisit">
                            <span><?= GetMessage("FLU_HEAD_LAST_VISIT") ?></span>&nbsp;<br/><?= $arResult["SortingEx"]["LAST_VISIT"] ?>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?
                    $iCount = 0;

                    foreach ($arResult["USERS"] as $res):

                        $full_name = $res["NAME"] . ' ' . $res["LAST_NAME"];
                        $iCount++;
                        ?>
                        <tr class="<?= ($iCount == 1 ? "forum-row-first " : (
                        $iCount == count($arResult["USERS"]) ? "forum-row-last " : "")) ?><?= ($iCount % 2 == 1 ? "forum-row-odd" : "forum-row-even") ?>">
                            <td class="forum-first-column forum-column-username">

                                <div class="forum-user-name">
                                    <?= str_replace(array("#URL#", "#NAME#"), array($res["DETAIL_URL"], $full_name), $arParams["USER_TMPL"]) ?>
                                </div>


                                <div class="forum-user-status <?= (!empty($res["LOGIN"]) ? "forum-user-" . $res["LOGIN"] . "-status" : "") ?>">
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
                    <? endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>

    <? if ($arResult["NAV_RESULT"]->NavPageCount > 0): ?>
        <div class="forum-navigation-box forum-navigation-bottom">
            <div class="forum-page-navigation">
                <?= $arResult["NAV_STRING"] ?>
            </div>
            <div class="forum-clear-float"></div>
        </div>
    <? endif; ?>

<? endif; ?>
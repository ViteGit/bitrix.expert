<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
?>

<!DOCTYPE HTML>
<html lang="<?=LANGUAGE_ID?>">
<head>
    <meta charset="windows-1251">
    <title><?$APPLICATION->ShowTitle()?></title>
    <?$APPLICATION->SetAdditionalCSS("/local/templates/exam1/css/template_style.css")?>
    <?$APPLICATION->AddHeadScript("/local/templates/exam1/js/jquery-1.8.2.min.js")?>
    <?$APPLICATION->AddHeadScript("/local/templates/exam1/js/slides.min.jquery.js")?>
    <?$APPLICATION->AddHeadScript("/local/templates/exam1/js/jquery.carouFredSel-6.1.0-packed.js")?>
    <?$APPLICATION->AddHeadScript("/local/templates/exam1/js/functions.js")?>

    <?$APPLICATION->SetAdditionalCSS("/local/templates/exam1/fancybox/jquery.fancybox-1.3.4.css")?>
    <?$APPLICATION->AddHeadScript("/local/templates/exam1/fancybox/jquery.easing-1.3.pack.js")?>
    <?$APPLICATION->AddHeadScript("/local/templates/exam1/fancybox/jquery.fancybox-1.3.4.js")?>
    <?$APPLICATION->AddHeadScript("/local/templates/exam1/fancybox/jquery.fancybox-1.3.4.pack.js")?>
    <?$APPLICATION->AddHeadScript("/local/templates/exam1/fancybox/jquery.mousewheel-3.0.4.pack.js")?>

    <?$APPLICATION->ShowHead();?>

    <!--[if gte IE 9]><style type="text/css">.gradient {filter: none;}</style><![endif]-->
</head>
<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>

<div class="wrap">
    <div class="hd_header_area">
        <div class="hd_header">
            <table>
                <tr>
                    <td rowspan="2" class="hd_companyname">
                        <h1><a href="">
                                <?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	"logo", 
	array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"COMPONENT_TEMPLATE" => "logo",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/local/templates/exam1/includes/logo.php"
	),
	false
);?>
                            </a>
                        </h1>
                    </td>
                    <td rowspan="2" class="hd_txarea">
                        <span class="tel">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	"phone", 
	array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"COMPONENT_TEMPLATE" => "phone",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/local/templates/exam1/includes/phone.php"
	),
	false
);?>
                        </span>	<br/>
                        <?=GetMessage("WT")?><span class="workhours">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "working_time",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "COMPONENT_TEMPLATE" => "working_time",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => "/local/templates/exam1/includes/working_time.php"
                                )
                            );?>
                        </span>
                    </td>
                    <td style="width:232px">
                        <form action="">
                            <div class="hd_search_form" style="float:right;">
                                <input placeholder="Поиск" type="text"/>
                                <input type="submit" value=""/>
                            </div>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 11px;">
							<span class="hd_singin"><a id="hd_singin_but_open" href="">Войти на сайт</a>
							<div class="hd_loginform">
								<span class="hd_title_loginform">Войти на сайт</span>
								<form name="" method="" action="">

									<input placeholder="Логин"  type="text">
									<input  placeholder="Пароль"  type="password">
									<a href="/" class="hd_forgotpassword">Забыли пароль</a>

									<div class="head_remember_me" style="margin-top: 10px">
										<input id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" type="checkbox">
										<label for="USER_REMEMBER_frm" title="Запомнить меня на этом компьютере">Запомнить меня</label>
									</div>
									<input value="Войти" name="Login" style="margin-top: 20px;" type="submit">
									</form>
								<span class="hd_close_loginform">Закрыть</span>
							</div>
							</span><br>
                        <a href="" class="hd_signup">Зарегистрироваться</a>
                    </td>
                </tr>
            </table>

            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "admin_main_menu",
                Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "3",
                    "MENU_CACHE_GET_VARS" => array(0=>"",),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "Y",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "top",
                    "USE_EXT" => "N"
                )
            );?>

        </div>
    </div>

    <!--- // end header area --->

    <?$APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "admin_breadcrumbs",
        Array(
            "PATH" => "",
            "SITE_ID" => "s1",
            "START_FROM" => "0"
        )
    );?>


    <div class="main_container page">
        <div class="mn_container">
            <div class="mn_content">
                <div class="main_post">
                    <div class="main_title">
                        <p class="title"><?$APPLICATION->ShowTitle()?></p>
                    </div>
                    <!-- workarea -->



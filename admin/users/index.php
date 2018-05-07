<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Пользователи");
?><?$APPLICATION->IncludeComponent("mycomponents:my.user.list", "my.user.list", Array(
	"CACHE_TIME" => "0",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"DATE_TIME_FORMAT" => "d.m.Y H:i:s",	// Формат показа даты и времени
		"PAGE_NAVIGATION_TEMPLATE" => "",	// Название шаблона для вывода постраничной навигации
		"SEO_USER" => "Y",	// Не индексировать ссылку на профиль
		"SET_NAVIGATION" => "Y",	// Показывать навигацию
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"SHOW_USER_STATUS" => "N",
		"URL_TEMPLATES_MESSAGE_SEND" => "message_send.php?TYPE=#TYPE#&UID=#UID#",
		"URL_TEMPLATES_PM_EDIT" => "pm_edit.php?FID=#FID#&MID=#MID#&UID=#UID#&mode=#mode#",
		"URL_TEMPLATES_PROFILE_VIEW" => "/admin/users/#LOGIN#/",	// Страница профиля пользователя
		"URL_TEMPLATES_USER_POST" => "user_post.php?UID=#UID#&mode=#mode#",
		"USERS_PER_PAGE" => "20",	// Количество пользователей на одной странице
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
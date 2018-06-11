<?
/**
 * Created by PhpStorm.
 * User: Вован
 * Date: 04.06.2018
 * Time: 14:16
 */
AddEventHandler("main", "OnBeforeUserAdd", Array("MyClass", "OnBeforeUserAddHandler"));

class MyClass
{
    public function OnBeforeUserAddHandler(&$arFields)
    {
        if ($arFields["EMAIL"]) {
            $res = preg_match('~(list.ru|rambler.ru)~', $arFields["EMAIL"]);
            if ($res) {
                global $APPLICATION;
                $APPLICATION->throwException("Почтовые домены rambler.ru и list.ru запрещены ");
                return false;
            } else {
                $query = Cuser::GetList($by = "id", $order = "DESC", $arFilter = ['EMAIL' => $arFields["EMAIL"]], $arParams = ['FIELDS' => ['NAME']]);

                if ($User = $query->fetch()) {
                    global $APPLICATION;
                    $APPLICATION->throwException("Такая почта уже существует");
                    return false;
                } else {
                    if (!preg_match('~yandex.ru~', $arFields["EMAIL"] )) {
                        $query = CUSER::GetList($by = "id", $order = "DESC", $arFilter = ['GROUPS_ID' => [1]], $arParams = ['FIELDS' => ['EMAIL']]);
                        while ($user = $query->Fetch()) {
                            $emails[] = $user['EMAIL'];
                        }

                        $emails = implode(', ', $emails);

                        $arEventFields = [
                            "ADMINS" => $emails,
                            "DATA" => date('H:i:s'),
                            "LOGIN" => $arFields["LOGIN"],
                            "EMAIL" => $arFields["EMAIL"],
                            "PAGE" => $_SERVER["HTTP_REFERER"],
                        ];

                        CEvent::Send("NEW_REGISTERED", 's1', $arEventFields);
                        CBitrixComponent::clearComponentCache('mycomponents:my.users_new');

                    }
                };
            }
        }
    }

}

?>
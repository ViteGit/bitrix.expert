<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


use Bitrix\Main\Entity;
use Bitrix\Main\Type;
use Myclass\Lowprice\LowPriceTable;

class HLAddForm extends CBitrixComponent
{

    public function executeComponent()
    {
        try {
            $modules = ['highloadblock'];
            foreach ($modules as $module) {
                CModule::IncludeModule($module);
            }

            $this->MainMethod();

            $this->includeComponentTemplate();

        } catch (Exception $e) {
            $this->__showError($e->getMessage());
        }

    }

    private function MainMethod()
    {
        $user_id = CUser::GetID();
        if ($user_id) {
            $CDBResult = CUser::GetByID($user_id);
            $user = $CDBResult->fetch();
            $this->arResult['FULLNAME'] = $user['NAME'] . ' ' . $user['LAST_NAME'] . ' ' . $user['SECOND_NAME'];
            $this->arResult['PERSONAL_PHONE'] = $user['PERSONAL_PHONE'];
        }

        if (isset($_POST['submit']) && !empty($_POST['phone'])
            && !empty($_POST['fullname']) && !empty($_POST['desired_price'])
        ) {
            $element_id = isset($this->arParams['ELEMENT_ID']) ? $this->arParams['ELEMENT_ID'] : 0;

            $arRows = [
                'UF_USER_ID' => $user_id,
                'UF_ELEMENT_ID' => $element_id,
                'UF_FULLNAME' => $_POST['fullname'],
                'UF_PHONE' => $_POST['phone'],
                'UF_DESIRED_PRICE' => $_POST['desired_price'],
                'UF_DATE' => new Type\Date('', 'Y-m-d'),
                'UF_STATUS' => 0,
            ];

            $result = LowPriceTable::add($arRows);

            if (!$result->isSuccess()) {
                  $this->arResult['ERROR'] = 'Что-то пошло не так, попробуйте позже';
            } else {
                ShowMessage(['TYPE' => 'OK', 'MESSAGE' => 'Мы вам сообщим свое решение']);
            }
        }

    }

}


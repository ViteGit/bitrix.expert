<?php
/**
 * Created by PhpStorm.
 * User: Вован
 * Date: 05.06.2018
 * Time: 17:47
 */

CAgent::AddAgent("findNewUsers();");

function findNewUsers()
{
    $arFilter = [
        'TIMESTAMP_1' => date('d.m.Y'),
        'TIMESTAMP_2' => date('d.m.Y')
    ];

    $arParams = ['FIELDS' => ['EMAIL', 'DATE_REGISTER']];

    $query = CUser::GetList($by = "date_register", $order = 'DESC', $arFilter, $arParams);

    while ($user = $query->Fetch()) {
        $unix = strtotime($user['DATE_REGISTER']);
        $date = date('d.m.Y', $unix);

        if ($date == date('d.m.Y')) {
            $users[] = $user;
        }
    }

    if (!empty($users)){

    $data = '';
    foreach ($users as $key => $value) {
        $data .= $value['EMAIL'] . ": ";
        $data .= $value['DATE_REGISTER'] . ", \r\n";
    }
    $datas = rtrim($data, ", \r\n");

    $query = CUSER::GetList($by = "id", $order = "DESC", $arFilter = ['GROUPS_ID' => [1]], $arParams = ['FIELDS' => ['EMAIL']]);

    while ($admin = $query->Fetch()) {
        $admins[] = $admin['EMAIL'];
    }

    $admins = implode(', ', $admins);

    $arEventFields = [
        'ADMIN' => $admins,
        'INFO' => $datas,
    ];

    CEvent::Send("SEARCHING_NEW_USERS", SITE_ID, $arEventFields);
    }

    return 'findNewUsers();';
}

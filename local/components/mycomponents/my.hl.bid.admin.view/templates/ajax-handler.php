<?
require($_SERVER["DOCUMENT_ROOT"].
    "/bitrix/modules/main/include/prolog_before.php");
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CModule::IncludeModule('highloadblock');
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
const HL_BLOCK_ID = 1;

$data = $_POST['data'];
$data = (array)json_decode($data);

$hlblock   = HL\HighloadBlockTable::getById( HL_BLOCK_ID )->fetch();
$entity   = HL\HighloadBlockTable::compileEntity( $hlblock );
$entityClass = $entity->getDataClass();

$dataForUpdate = [
        'UF_COMMENT' => $data['comment'],
        'UF_STATUS' => 1,
];

$entityClass::update($data['entity_id'], $dataForUpdate);

$query = new Entity\Query($entity);
$query->setSelect(['UF_USER_ID', 'UF_COMMENT']);
$query->setFilter(['=ID' => $data['entity_id']]);
$result = $query->exec();
$result = new CDBResult($result);
$hl_post = $result->Fetch();

if (isset($hl_post['UF_USER_ID']) && !empty($hl_post['UF_USER_ID'])){
   $user_id =  $hl_post['UF_USER_ID'];
   $comment =  $hl_post['UF_COMMENT'];

   $query = CUser::GetByID($user_id);
   $user = $query->Fetch();
   $user_mail = $user['EMAIL'];

   if (!empty($user_mail)){
       $arEventFields = [
           'USER' => $user_mail,
           'COMMENT' => $comment,
       ];

       CEvent::Send("INFORM_USERS", SITE_ID, $arEventFields);
   }
}

echo $data['comment'];


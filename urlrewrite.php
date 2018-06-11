<?php
$arUrlRewrite=array (
  5 => 
  array (
    'CONDITION' => '#^/admin/users/([0-9a-zA-Z]+)/(.*)#',
    'RULE' => '/admin/users/detail.php',
    'ID' => '',
    'PATH' => '',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/admin/i-blocks/([0-9]+).*#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/admin/i-blocks/detail.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^/services/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/services/index.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/products/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/products/index.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
);

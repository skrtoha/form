<?php
global $APPLICATION;

require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->IncludeComponent('webpro:geo-ip', 'ajax', [
    'AJAX' => 'Y',
    'IP' => $_POST['IP']
]);

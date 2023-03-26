<?php
global $APPLICATION;

use Bitrix\Main\UI\Extension;

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');
Extension::load('ui.bootstrap4');
$APPLICATION->SetTitle('Форма GeoIP поиска');
$APPLICATION->IncludeComponent('webpro:geo-ip', '.default');
?>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>
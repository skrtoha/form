<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/* @global CMain $APPLICATION */

use Bitrix\Main\Page\Asset;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?$APPLICATION->ShowHead();?>
    <meta charset="utf-8">
    <title>Maximus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?
    CJSCore::Init(['jquery']);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/script.js');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/styles.css');
    ?>
</head>
<body>
<?$APPLICATION->ShowPanel()?>
<?php

use Bitrix\Main\Mail\Event;
use Bitrix\Main\SystemException;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

if ($arParams['AJAX'] == 'Y' && $arParams['IP']){
    try{
        $this->validateIP();
        $arResult['RESPONSE']['result'] = $this->getIPInfo();
        $arResult['RESPONSE']['status'] = 'ok';
        $arResult['RESPONSE']['error_message'] = '';
    }
    catch(SystemException $e){
        $arResult['RESPONSE']['error_message'] = $e->getMessage();
        $arResult['RESPONSE']['status'] = 'error';
        $arResult['RESPONSE']['result'] = [];

        Event::send([
            "EVENT_NAME" => "EVENT_LOG_NOTIFICATION",
            "LID" => "s1",
            "C_FIELDS" => [
                "EMAIL" => Config::ADMIN_EMAIL,
                "ITEM_ID" => 'IP'
            ]
        ]);
    }
}

$this->IncludeComponentTemplate();

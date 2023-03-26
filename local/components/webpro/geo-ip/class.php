<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @global array $arParams */
/** @global array $arResult */
/** @global CMain $APPLICATION */

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\SystemException;
use Bitrix\Main\Web\HttpClient;
use Bitrix\Highloadblock\HighloadBlockTable;

CModule::IncludeModule('highloadblock');

class GeoIP extends \CBitrixComponent{
    /**
     * Получает информацию об ip
     * @throws Exception
     */
    public function getIPInfo(){
        $fromDatabase = $this->getFromDatabase();

        if ($fromDatabase) return $fromDatabase['UF_DESCRIPTION'];

        $result = $this->getFromSypexgeo();

        if ($result){
            $strEntityDataClass = $this->getDataEntity();
            $res = $strEntityDataClass::add([
                'UF_IP' => $this->arParams['IP'],
                'UF_DESCRIPTION' => $result
            ]);
            if ($res->isSuccess()) return $result;
        }
        else{
            throw new SystemException('Ничего не найдено');
        }

        return $result;
    }

    /**
     * Получает данные ip адреса из sypexgeo.net
     * @return string
     */
    private function getFromSypexgeo(): string
    {
        $httpClient = new HttpClient();
        $httpClient->query(
            HttpClient::HTTP_GET,
            "https://api.sypexgeo.net/json/{$this->arParams['IP']}",
        );
        return $httpClient->getResult();
    }

    /**
     * Возвращает сущность highload-блока ip адресов
     * @return DataManager|string
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    private function getDataEntity(){
        $arHLBlock = HighloadBlockTable::getById(Config::HIGNLOADBLOCK_ID)->fetch();
        $obEntity = HighloadBlockTable::compileEntity($arHLBlock);
        return $obEntity->getDataClass();
    }

    /**
     * Получает данные ip адреса из базы данных
     * @return array|false
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    private function getFromDatabase(){
        $strEntityDataClass = $this->getDataEntity();
        $resData = $strEntityDataClass::getList([
            'filter' => ['UF_IP' => $this->arParams['IP']]
        ])->fetch();
        return $resData;
    }

    /**
     * Проверяет на корректность IP
     * @throws SystemException
     */
    public function validateIP(){
        $array = explode('.', $this->arParams['IP']);
        foreach($array as $value){
            if ($value < 1 || $value > 255) throw new SystemException('Не валидный IP');
        }
    }
}
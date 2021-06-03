<?php

namespace App\Controllers;


use \App\Models\QuoteModel;
use \App\Models\CurrencyModel;
use CodeIgniter\Model;
use Config\Database;
use Config\Services;

helper('xml');

class Quote extends BaseController
{
    protected $CURLClient = null;

    public function __construct()
    {
        $this->CURLClient = Services::curlrequest();
    }

    public function getExchanges($code, $from, $to){
        $db = Database::connect();
        $query = $db->query("SELECT  quotes.currency_id , `value`, `date`, `name`, `nominal`, `value`, `char_code` FROM `quotes` JOIN `currency` ON currency.currency_id LIKE '%{$code}%' WHERE quotes.currency_id = '{$code}' AND quotes.date >= '{$from}' AND quotes.date <= '{$to}'");
        return json_encode( $query->getResult('array'));
    }

    /**
     * @throws \ReflectionException
     */
    public function refreshQuotes($days)
    {
        $quoteModel = new QuoteModel();

        for ($i = 0; $i < $days; $i++){
            $soughtDate = date("d/m/Y", strtotime("-$i day"));

            $response = $this->CURLClient->request('GET', "http://www.cbr.ru/scripts/XML_daily.asp?date_req={$soughtDate}");
            $data = simplexml_load_string($response->getBody());

            foreach ($data->Valute as $valute){
                $valute = (array)$valute;
                $id = array_shift($valute)['ID'];

                $raw = [
                    'currency_id' => $id,
                    'value'  => floatval(str_replace(',', '.', $valute['Value'])),
                    'date' => date("Y-m-d", strtotime("-$i day"))
                ];

                $quoteModel->insert($raw);

            }
        }
    }

    /**
     * @throws \ReflectionException
     */
    public function getCurrencies(){
        $currencyModel = new CurrencyModel();
        return json_encode($currencyModel->find());
    }
    public function fillCurrencies(){
        $currencyModel = new CurrencyModel();

        $response = $this->CURLClient->request('GET', "http://www.cbr.ru/scripts/XML_valFull.asp");
        $data = simplexml_load_string($response->getBody());

        foreach ($data->Item as $currency){
            $currency = (array)$currency;

            $raw = [
                'id' => $currency['ParentCode'],
                'name' => $currency['Name'],
                'eng_name' => $currency['EngName'],
                'nominal' => intval($currency['Nominal']),
                'num_code' => intval($currency['ISO_Num_Code']),
                'char_code'   => $currency['ISO_Char_Code'],
            ];

            $currencyModel->insert($raw);
        }
    }


}

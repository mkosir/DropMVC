<?php
namespace DroplineMVC\Controllers;

use DroplineMVC\Core\Controller;
use DroplineMVC\Utils\HTTP;
use DroplineMVC\Core\View;
use DroplineMVC\Utils\Messages;

class WordCloud extends Controller
{
    private $wordsData = array();

//    protected function index()
//    {
//        $model = new \DropLine\Models\Drop();
//        list($status, $data) = $model->getDropsFreqWords(2);
//
//        // Data handling success
//        if ($status === \ModelReturnStatus::SUCCESS) {
//            $this->wordsData = $this->calcWordFreq($data);
//            $this->wordsData = $this->prepareData($this->wordsData);
//            View::render($this->className, $this->action, json_encode($this->wordsData), true);
//            // Data handling failure
//        } elseif ($status === \ModelReturnStatus::FAILURE_GENERAL) {
//            Messages::setMsg('Problem occurred when trying to display word cloud.', \MSG::USER_ERROR);
//            HTTP::headerRedirectTo(ROOT_URL . 'wordcloud');
//        }
//    }

    protected function index()
    {
        View::render($this->className, $this->action, null, true);
    }

    protected function getDataWordCloudTitles()
    {
        $model = new \DroplineMVC\Models\Drop();
        list($status, $data) = $model->getWordsDropsTitles(20);

        // Data handling success
        if ($status === \ModelReturnStatus::SUCCESS) {
            $this->wordsData = $this->calcWordFreq($data);
            $this->wordsData = $this->prepareData($this->wordsData);
            echo json_encode($this->wordsData);
            // Data handling failure
        } elseif ($status === \ModelReturnStatus::FAILURE_GENERAL) {
            Messages::setMsg('Problem occurred when trying to display word cloud data.', \MSG::USER_ERROR);
            HTTP::headerRedirectTo('/wordcloud');
        }
    }

    private function calcWordFreq(array $data): array
    {
        $wordsFreqArray = array();

        $words = explode(' ', $data['LastDropsTitles']);
        foreach ($words as $key => $value) {

            $word = strtolower($value);

            if (array_key_exists($word, $wordsFreqArray)) {
                $wordsFreqArray[$word]++;
            } else {
                $wordsFreqArray[$word] = 1;
            }
        }
        return $wordsFreqArray;
    }

    private function prepareData(array $data): array
    {
        $wordsDataTemp = array();

        // word with highest frequency (scaled 100%)
        $max = max($data);

        // prepare data for json format
        foreach ($data as $key => $value) {
            // scale 0-100%
            $scaleValue = (($value / $max) * 100);
            // cast all keys to string and all the values to int
            $wordsDataTemp[] = array('text'=>(string)$key, 'size'=>(int)$scaleValue);
        }
        return $wordsDataTemp;
    }
}
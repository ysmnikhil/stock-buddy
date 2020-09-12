<?php

namespace Controller;

use Helper\Core;

Class Index extends Core
{
    protected $separator = ',';
    protected $year = 2020;
    protected $month = 'AUG';
    protected $date = false;
    protected $fileName = '';
    protected $file = false;
    protected $indexes = [];
    protected $fileData = [];
    protected $request;

    use \Helper\Traits\ResultTrait;

    public function __construct()
    {
//        $this->date = '27' . $this->month . $this->year;
//        $this->fileName = STOCK . "$this->year/$this->month/$this->date/cm" . $this->date . "bhav.csv";
//        if ($this->isFileExists()) {
//            $this->getSingleDayStocks();
//        }

        $this->readFolder();

        $this->calculateStocksPerformance();

        $this->fileData = array_reverse($this->fileData);

        $this->getResponse()->set('stocks', $this->result());
    }

    private function readFolder()
    {
        $it = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(STOCK, \RecursiveDirectoryIterator::SKIP_DOTS));
        $files = [];
        foreach ($it as $file) {
            preg_match('/' . $this->year . '/', $fileName = basename($file), $matches);
            if (count($matches) && pathinfo($fileName, PATHINFO_EXTENSION) === 'csv') {
                $files[] = $file;
            }
        }
        usort($files, function($x, $y) {
            return filemtime($x) > filemtime($y);
        });
        foreach ($files as $file) {
            $this->fileName = $file;
            $this->getSingleDayStocks();
        }
    }

    private function isFileExists()
    {
        return file_exists($this->fileName);
    }

    private function openFile()
    {
        $this->file = fopen($this->fileName,'r');
    }

    private function closeFile()
    {
        return fclose($this->file);
    }

    private function setIndexes()
    {
        $this->indexes = fgetcsv($this->file, 4096, $this->separator);
    }

    private function setFileData()
    {
        while (($line = fgetcsv($this->file, 4096, $this->separator)) !== FALSE ) {
//            if($line[0] !== 'ADANIGREEN') continue;
            $index = $line[0] . '-' . $line[1];
            if (isset($this->fileData[$index])) {
                $this->fileData[$index]->setDateData($line);
            } else {
                $stock = new \Entity\Stock($line);

                if (!$stock->isSkipped) {
                    $this->fileData[$index] = $stock;
                }
            }
        }
    }

    private function getSingleDayStocks()
    {
        $this->openFile();
        $this->setIndexes();
        $this->setFileData();
        $this->closeFile();
    }

    private function sortStockBasedOnChange($a, $b)
    {
        return strcmp($a->changeInPercentage, $b->changeInPercentage);
    }

    private function calculateStocksPerformance()
    {
        usort($this->fileData, [$this, 'sortStockBasedOnChange']);
    }
}

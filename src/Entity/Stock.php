<?php

namespace Entity;

use Helper\Core;

class Stock extends Core
{
    const KEY = [
        'symbol',
        'series',
        12 => 'isin',
    ];

    public $symbol;

    protected $series;

    protected $isin;

    protected $dates = [];

    protected $isSkipped = false;

    public $chartDataWithDates = [
        'labels' => [],
        'data' => [],
        'dataInPercentage' => [],
    ];

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            if (isset(self::KEY[$key])) {
                $this->{self::KEY[$key]} = $value;
            }
        }

        $this->setDateData($data);

        $this->filter();
    }

    public function setDateData($data)
    {
        $date = $data['10'];
        $this->dates[$date] = new \Entity\Date($data);

        $this->calculatePerformanceForCreatedDates();

        /** Chart Data */
        $this->chartDataWithDates['labels'][] = $date;
        $this->chartDataWithDates['data'][] = $this->dates[$date]->change;
        $this->chartDataWithDates['dataInPercentage'][] = $this->dates[$date]->changeInPercentage;
    }

    public $change;
    public $changeInPercentage;
    public $initialPrice;
    public $lastPrice;

    use \Helper\Traits\CalculationTrait;
    use \Helper\Traits\FilterTrait;

    private function lastDate(): \Entity\Date
    {
        return end($this->dates);
    }

    private function calculatePerformanceForCreatedDates()
    {
        if (count($this->dates) > 1) {
            $this->initialPrice = current($this->dates)->open;
            $this->lastPrice = end($this->dates)->close;

            $this->change = round($this->lastPrice - $this->initialPrice, 2);
            $this->changeInPercentage = $this->getPercentage($this->change, $this->initialPrice);
        } else {
            $stock = current($this->dates);
            $this->initialPrice = $stock->open;
            $this->lastPrice = $stock->close;
            $this->change = $stock->change;
            $this->changeInPercentage = $stock->changeInPercentage;
        }
        reset($this->dates);
    }
}

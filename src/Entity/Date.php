<?php

namespace Entity;

use Helper\Core;

class Date extends Core
{
    const KEY = [
        'symbol',
        2 => 'open',
        'high',
        'low',
        'close',
        'last',
        'prevClose',
        'totalTradeQuantity',
        'totalTradeVolume',
        11 => 'totalTrades',
    ];

    protected $open;

    protected $high;

    protected $low;

    protected $close;

    protected $last;

    protected $prevClose;

    protected $totalTradeQuantity;

    protected $totalTradeVolume;

    protected $totalTrades;

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            if (isset(self::KEY[$key])) {
                $this->{self::KEY[$key]} = $value;
            }
        }

        $this->realCalculation();
    }

    protected $jump;
    protected $jumpInPercentage;
    protected $jumpText;

    protected $change;
    protected $changeInPercentage;
    protected $changeText;

    use \Helper\Traits\CalculationTrait;

    public function initialJump()
    {
        $this->jump = round($this->open - $this->prevClose, 2);
        $this->jumpInPercentage = $this->getPercentage($this->jump, $this->prevClose);
        $this->jumpText = $this->jump . ' / ' . $this->jumpInPercentage . '%';
    }

    public function percentageChange()
    {
        $this->change = round($this->close - $this->open, 2);
        $this->changeInPercentage = $this->getPercentage($this->change, $this->open);
        $this->changeText = $this->change . ' / ' . $this->changeInPercentage . '%';
    }

    private function realCalculation()
    {
        $this->initialJump();
        $this->percentageChange();
    }
}

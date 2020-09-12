<?php

namespace Helper;

class Request
{
    private $allowedFields = [
        'symbol',
        'open',
        'high',
        'low',
        'close',
        'last',
        'prevClose',
        'totalTradeQuantity',
        'totalTradeVolume',
        'totalTrades',

        'change',
        'changeInPercentage',
        'jump',
        'jumpInPercentage',
    ];

    private $filters = [];

    private function filter()
    {
        foreach ($this->all() as $key => $get) {
            if (in_array($key, $this->allowedFields, true)) {
                $values = explode(',', $get);
                if (isset($values[0])) {
                    $values[0] = $key === 'symbol' ? strtoupper($values[0]) : $values[0];
                    $this->filters[$key] = [
                        'value' => $values[0],
                        'condition' => $values[1] ?? 'equal',
                    ];
                }
            }
        }

        $GLOBALS['response']->set('filters', $this->filters);
    }

    public function __construct()
    {
        $this->filter();
    }

    public function getFilters()
    {
        return $this->filters;
    }

    public function get($key)
    {
        return $_GET[$key] ?? null;
    }

    public function all()
    {
        return $_GET ?? [];
    }
}

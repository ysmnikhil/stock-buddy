<?php

namespace Helper\Traits;

trait FilterTrait
{
    private function filter()
    {
        foreach ($this->getRequest()->getFilters() as $key => $filter) {
            switch ($filter['condition']) {
                case 'greater':
                    if ($this->lastDate()->{$key} <= $filter['value']) {
                        $this->isSkipped = true;
                    }
                    break;
                case 'less':
                    if ($this->lastDate()->{$key} >= $filter['value']) {
                        $this->isSkipped = true;
                    }
                    break;
                case 'notEqual':
                    if ($this->lastDate()->{$key} == $filter['value']) {
                        $this->isSkipped = true;
                    }
                    break;
                case 'like':
                    $key = strpos($this->lastDate()->{$key}, $filter['value']);
                    if (in_array($key, [false], true)) {
                        $this->isSkipped = true;
                    }
                    break;
                case 'equal':
                default:
                    if ($this->lastDate()->{$key} != $filter['value']) {
                        $this->isSkipped = true;
                    }
                    break;
            }
        }
    }
}

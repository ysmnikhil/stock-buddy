<?php

namespace Helper\Traits;

trait ResultTrait {

    protected $call = '';

    public function result() {
        return $this->call ? $this->{$this->call}() : $this->fileData;
    }

    public function top10() {
        return array_slice($this->fileData, 0, 10);
    }
}
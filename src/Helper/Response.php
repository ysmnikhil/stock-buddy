<?php

namespace Helper;

class Response
{
    private $data = [];

    public function set($key, $value)
    {
        return $this->data[$key] = $value;
    }

    public function get($key)
    {
        return $this->data[$key] ?? null;
    }

    public function all()
    {
        return $this->data;
    }
}

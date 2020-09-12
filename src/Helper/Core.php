<?php

namespace Helper;

abstract class Core
{
    public function getResponse()
    {
        return $GLOBALS['response'];
    }

    public function getRequest()
    {
        return $GLOBALS['request'];
    }

    public function __set($key, $value)
    {
        $this->{$key} = $value;
    }

    public function __get($key)
    {
        return $this->{$key};
    }
}

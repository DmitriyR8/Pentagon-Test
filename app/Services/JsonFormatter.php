<?php

namespace App\Services;

/**
 * Class JsonFormatter
 * @package App\Services
 */
class JsonFormatter
{
    /**
     * @param string $string
     * @return mixed
     */
    public function decode(string $string)
    {
        return json_decode($string, true);
    }
}

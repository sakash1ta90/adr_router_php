<?php

class TopDomain implements Domain
{
    /**
     * @param string $val
     * @return string
     */
    public function get(string $val = ''): string
    {
        return 'Hello!' . $val;
    }
}
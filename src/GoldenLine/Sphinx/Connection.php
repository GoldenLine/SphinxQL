<?php

namespace GoldenLine\Sphinx;

interface Connection
{
    public function execute($sql);
}

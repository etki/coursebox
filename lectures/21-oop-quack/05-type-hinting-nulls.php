<?php

class Sszb
{
    private $options;
    public function __construct(Options $options = null)
    {
        $this->options = $options ?: new DefaultOptions;
    }
}
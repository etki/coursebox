<?php

class Base
{
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
}

class Derivative
{
    private $dataType;
    public function __construct($data)
    {
        parent::__construct($data);
        $this->dataType = gettype($data);
    }
    public function getDataType()
    {
        return $this->dataType;
    }
}
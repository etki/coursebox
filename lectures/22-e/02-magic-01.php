<?php

class Magician
{
    private $storage = [];
    public function __set($name, $value)
    {
        echo '__set called', PHP_EOL;
        $this->storage[$name] = $value;
    }
    public function __get($name)
    {
        echo '__get called', PHP_EOL;
        return $this->storage[$name];
    }
}

$mmmagician = new Magician();
$mmmagician->whatever = 12;
var_dump($mmmagician->whatever); // 12
var_dump(isset($mmmagician->whatever)); // false
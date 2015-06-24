<?php

class UltraMagician
{
    public function __call($name, array $arguments)
    {
        echo "$name() method called with following arguments:";
        var_dump($arguments);
        return 'call!';
    }
    public function __invoke($a = null, $b = null, $c = null)
    {
        echo '__invoke() called with following arguments:';
        var_dump($a, $b, $c);
        return 'invoke!';
    }
    public function __toString()
    {
        return 'PI is something like 3.14';
    }
}

$mMmMm = new UltraMagician();

var_dump($mMmMm->method());
echo '<hr/>';
var_dump($mMmMm->method(12, 13, 14));
echo '<hr/>';
var_dump($mMmMm());
echo '<hr/>';
var_dump($mMmMm(12, 13, 14));
echo '<hr/>';
var_dump('toString: ' . $mMmMm);
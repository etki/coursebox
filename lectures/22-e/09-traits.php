<?php

trait Magic
{
    public function multiply($a, $b)
    {
        return $a * $b;
    }
}

class NoMagic
{
    use Magic;
}

$m = new NoMagic();

var_dump($m->multiply(12, 13));
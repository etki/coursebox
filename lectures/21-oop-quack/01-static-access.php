<?php

class StaticCounter
{
    private static $counter = 0;
    public static function counter()
    {
        static::$counter++;
        return static::$counter;
    }
}
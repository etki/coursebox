<?php

class Animal
{
    public function eat($food)
    {
        // ...
    }

    public function sleep($time)
    {
        // ...
    }

    public function disregard($human)
    {
        // ...
    }
}

class Dog extends Animal
{
    public function barkAt($times, $human)
    {
        for ($i = 0; $i < $times; $i++) {
            echo 'bark!', PHP_EOL;
        }
        $this->disregard($human);
    }
}

class Bat extends Animal
{
    public function turnUpsideDown()
    {
        // ...
    }

    public function sleep($time)
    {
        $this->turnUpsideDown();
        parent::sleep($time);
    }
}
<?php

class Hideous
{
    private function privateAccess()
    {
        return true;
    }
    protected function protectedAccess()
    {
        return $this->privateAccess();
    }
    public function publicAccess() {}
}

class Extravert extends Hideous
{
    public function publicAccess()
    {
        return $this->protectedAccess();
    }
    public function donkey()
    {
        $this->privateAccess();
    }
}
$instance = new Extravert;
$instance->publicAccess(); // true
$instance->donkey(); // умрет
$instance->protectedAccess(); // умрет
$instance->privateAccess(); // умрет


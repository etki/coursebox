<?php

class MegaMagician
{
    public function __isset($name)
    {
        echo '__isset called', PHP_EOL;
        return rand(0, 1) > 0;
    }
    public function __unset($name)
    {
        echo '__unset called', PHP_EOL;
    }
}

$mmmmm = new MegaMagician;
var_dump(isset($mmmmm->a)); // true|false
var_dump(isset($mmmmm->a)); // true|false
var_dump(isset($mmmmm->a)); // true|false
unset($mmmmm->a);
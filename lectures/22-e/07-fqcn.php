<?php

namespace DeveloperA\Utilities;

class Abcd
{
    private $utilities;
    public function __construct()
    {
        $this->utilities = new \DeveloperB\Utilities\StringUtilities;
    }
}
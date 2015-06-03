<?php

function queryTableExists($table, $flavour)
{
    if ($flavour === 'mysql') {
        return "SHOW TABLES LIKE '$table'";
    } elseif ($flavour === 'sqlite') {
        return "";
    } elseif ($flavour === 'postgresql') {

    }
}
<?php

$var = 12;
function dummy() {
    global $var;
    $var += 13;
}
dummy();
echo $var; // 25

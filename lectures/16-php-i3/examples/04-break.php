<?php

for ($i = 0; $i < 5; $i++) {
    for ($j = 0; $j < 10; $j++) {
        if ($i > 3 && $j > $i * 2) {
            break 2;
        }
    }
}

echo 'i: ' . $i . ', j: ' . $j;

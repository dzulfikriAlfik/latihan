<?php

$counter = 1;
while ($counter <= 10) {
    echo "Ini while loop ke-$counter" . PHP_EOL;
    $counter++;
}

while ($counter >= 1) :
    echo "Ini while loop ke-$counter" . PHP_EOL;
    $counter--;
endwhile;

<?php


for ($counter = 1; $counter <= 10; $counter++) {
    echo "Ini foorloop ke-$counter" . PHP_EOL;
}

for ($counter = 1; $counter <= 10; $counter++) :
    echo "Ini foorloop ke-$counter" . PHP_EOL;
endfor; 

// infinite loop
// for (;;) {
//     echo "Infinite Loop" . PHP_EOL;
// }

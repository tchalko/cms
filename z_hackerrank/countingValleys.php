<?php

// Complete the countingValleys function below.
function countingValleys($n, $s) {
   echo "\nin countingValleys";
   return 0;
}

$fptr = fopen(getenv("MYOUTPUT_PATH"), "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

$s = '';
fscanf($stdin, "%[^\n]", $s);

print_r($s);
$ar = str_split($s);
print_r($ar);
$result = countingValleys($n, $s);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);

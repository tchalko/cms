<?php

// Complete the sockMerchant function below.
function sockMerchant($n, $ar) {
    sort($ar);
    $totpairs = 0;
    for ($i=0; $i<($n-1); $i++){
        $next = $i+1;
        if ($ar[$i] == $ar[$next]){
            $totpairs++;
            $i++;
        }
    }
    return $totpairs;
}

$fptr = fopen(getenv("MYOUTPUT_PATH"), "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

fscanf($stdin, "%[^\n]", $ar_temp);

$ar = array_map('intval', preg_split('/ /', $ar_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = sockMerchant($n, $ar);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);

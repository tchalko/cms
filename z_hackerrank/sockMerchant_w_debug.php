<?php
function sockMerchant($n, $ar, $fptr) {
    sort($ar);
    print_r($ar);

    $len = count($ar);
    $totpairs = 0;
    for ($i=0; $i<$len-1; $i++){
        $next = $i+1;
        if ($ar[$i] == $ar[$next]){
            $totpairs++;
            fwrite($fptr, "\n"."ar[".$i."]=".$ar[$i]." ar[".$next."]=".$ar[$next]." totpairs=".$totpairs."\n");
            $i++;
            fwrite($fptr, "end of if, i is now = ".$i."\n");
        }
        fwrite($fptr, "\n"."before end of loop, i=".$i."\n");
    }
    return $totpairs;
}

$fptr = fopen(getenv("MYOUTPUT_PATH"), "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

fscanf($stdin, "%[^\n]", $ar_temp);

$ar = array_map('intval', preg_split('/ /', $ar_temp, -1, PREG_SPLIT_NO_EMPTY));
print_r($ar);

$result = sockMerchant($n, $ar, $fptr);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);

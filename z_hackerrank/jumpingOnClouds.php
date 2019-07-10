<?php
function jumpingOnClouds($c) {
    $len = count($c);
    $jumps=0;

    for ($i=0; $i<($len-2); $i++){
        if ($c[$i+2] == 0){
            $i++;
        }
        $jumps++;
    }
    return $jumps;
}
$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

fscanf($stdin, "%[^\n]", $c_temp);

$c = array_map('intval', preg_split('/ /', $c_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = jumpingOnClouds($c);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);

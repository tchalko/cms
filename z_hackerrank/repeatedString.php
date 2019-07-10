<?php



/*
 * Complete the 'playlist' function below.
 *
 * The function is expected to return a LONG_INTEGER.
 * The function accepts INTEGER_ARRAY songs as parameter.
 */

function playlist($songs) {
    // Write your code here
    $arrlen = count($songs);
    $found = 0;
    for($i=0; $i<$arrlen; $i++){
        for($j=$i+1; $j<$arrlen-$i; $j++){
            echo "comparing songs[$i]=$songs[$i] and songs[$j]=$songs[$j]\n";
            if(($songs[$i]+$songs[$j])%60==0){
                $found++;
                echo "songs[$i]=$songs[$i] and songs[$j]=$songs[$j] and found=$found\n";
            }
        }
    }
    return $found;
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$songs_count = intval(trim(fgets(STDIN)));

$songs = array();

for ($i = 0; $i < $songs_count; $i++) {
    $songs_item = intval(trim(fgets(STDIN)));
    $songs[] = $songs_item;
}

$result = playlist($songs);

fwrite($fptr, $result . "\n");

fclose($fptr);

<?php
$t = fgets(STDIN);

for($i=0; $i<$t; $i++)
{
    $lis = explode(" ", fgets(STDIN));
    print((int)$lis[0] + (int)$lis[1]) . "\n";
}
?>

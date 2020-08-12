<?php 

$s = "saya suka bermain sepeda dengan teman satu kelas saya";
// $zkey = preg_split( "(?<!\\G\\S+)\\s", $s);
preg_match_all("(?<!\\G\\S+)\\s", $s, $zkey);  
print_r($zkey);


// (?<!\\G\\S+)\\s

?>
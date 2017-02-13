<?php 

require_once("libs/block.php");

$b0 = new Block(0, 0, Block::INIT, "");

echo $b0->hash;
echo "<br>";

$b0->mine(4);
print_r($b0->result());

<?php 

require_once("libs/block.php");

$b0 = new Block(0, 0, Block::INIT, "lorem ipsum");

$b0->mine(4);
print_r($b0->result());

echo "<br>";
echo Block::verify($b0) ? "true" : "false";

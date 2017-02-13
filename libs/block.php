<?php

ini_set("max_execution_time", 300);

define("HASH0", str_repeat("0", 64));

class Block {
    
    const INIT = HASH0;
    
    function __construct($id, $nonce, $previous, $data) {
        $this->id = $id;
        $this->nonce = $nonce;
        $this->previous = $previous;
        $this->data = $data;
        
        $this->hash = Block::hash_block($this);
    }
    
    function result() {
        return array(
            "id" => $this->id,
            "nonce" => $this->nonce,
            "previous" => $this->previous,
            "data" => $this->data,
            "hash" => $this->hash
        );
    }
    
    public static function hash_block($block) {
        $to_hash = "";
        $to_hash .= $block->id;
        $to_hash .= $block->nonce;
        $to_hash .= $block->previous;
        $to_hash .= $block->data;
        
        return Block::sha256($to_hash);
    }
    
    function mine($n=1) {
        if ($n > 64) return false;
        
        $state = false;
        
        while (!$state) {
            $this->nonce = $this->nonce + 1;
            $this->hash = Block::hash_block($this);
            
            if (preg_match("/0{".$n."}.{".(64 - $n)."}/", $this->hash)) {
                $state = true;
            }
        }
        
        return $this->nonce;
    }
    
    public static function sha256($data) {
        return hash("sha256", $data);
    }
    
    public static function verify($block) {
        $hash = Block::hash_block($block);
        
        return $hash == $block->hash;
    }
    
}

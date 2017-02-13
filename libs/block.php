<?php

define("HASH0", str_repeat("0", 64));

class Block {
    
    const INIT = HASH0;
    
    function __construct($id, $nonce, $previous, $data) {
        $this->id = $id;
        $this->nonce = $nonce;
        $this->previous = $previous;
        $this->data = $data;
        
        $this->hash_block();
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
    
    function hash_block() {
        $to_hash = "";
        $to_hash .= $this->id;
        $to_hash .= $this->nonce;
        $to_hash .= $this->previous;
        $to_hash .= $this->data;
        
        $this->hash = Block::sha256($to_hash);
    }
    
    function mine($n=1) {
        if ($n > 64) return false;
        
        $state = false;
        
        while (!$state) {
            $this->nonce = $this->nonce + 1;
            $this->hash_block();
            
            if (preg_match("/0{".$n."}.{".(64 - $n)."}/", $this->hash)) {
                $state = true;
            }
        }
        
        return $this->nonce;
    }
    
    public static function sha256($data) {
        return hash("sha256", $data);
    }
    
}

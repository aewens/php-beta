<?php

define("HASH0", str_repeat("0", 64));

class Block {
    
    const INIT = HASH0;
    
    function __construct($id, $nonce, $previous, $data) {
        $this->id = $id;
        $this->nonce = $nonce;
        $this->previous = $previous;
        $this->data = $data;
        
        $to_hash = "";
        $to_hash .= $this->id;
        $to_hash .= $this->nonce;
        $to_hash .= $this->previous;
        $to_hash .= $this->data;
        
        $this->hash = Block::sha256($to_hash);
    }
    
    function result() {
        return $this->hash;
    }
    
    public static function sha256($data) {
        return hash("sha256", $data);
    }
    
}

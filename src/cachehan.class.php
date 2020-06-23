<?php

class Cachehan{
    public function __construct($dir,$uri,$time){
        $this->dir = $dir;
        $this->uri = md5($uri);
        $this->time = $time;
    }
    public function cacheStart(){
        if(file_exists($this->dir."/".$this->uri) && ( time() < filemtime($this->dir."/".$this->uri) + ( $this->time * 60 * 60))){
            include $this->dir."/".$this->uri;
            exit;
        }else{
            ob_start([$this,"process"]);
        }

    }
    public function  process($buff){

        file_put_contents($this->dir."/".$this->uri,$buff);

        return $buff;
    }

    public function cacheEnd(){
        ob_end_flush();
    }
}

?>

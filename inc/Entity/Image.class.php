<?php
 Class Image {
    private $id;
    private $file;
    private $alt;

    function getID() {
        return  $this->id;
    }

    function getFile() {
        return $this->file ;

    }
    function getAlt() {
        return $this->alt;
    }


    function setID(int $id) {
        $this->id =$id;
    }
    function setFile(string $file) {
        $this->file = $file;
    }
    function setAlt(string $alt) {
        $this->alt = $alt ;
    }

 } 
?>
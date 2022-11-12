<?php
 
 class Category {
private $name; 
private $description ;
private $navigation;
private $id;

function getID() {
    return $this->id;
}

function getCategoryID() {
    return $this->id;
}


function getName() {
    return $this->name;
}
function getTitle() {
    return $this->name;
}

function getDescription() {
    return $this->description;
}
function getNavigation() {
    return $this->navigation ;
}

function setName(string $name) {
    $this->name = $name ;
}

function setDescription(string $desc) {
    $this->description = $desc ;
}
function setNavigation(string $nav) {

    $this->navigation = $nav ;
}

function setID(int $id) {
    $this->id =$id;
}
 }

?>
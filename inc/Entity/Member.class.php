<?php

class Member
{
    // ? Declare user properties as private. use same name as SQL columns
    private $id;
    private $full_name;
    private $username;
    private $password;
    private $email;
    private $timeJoined;
    private $picture; 

    // ? Declare getters for all properties except password

    function getID(){
         return $this->id;
    }

    function getCategoryID() {
        return $this->id;
    }

    function getAuthor(){
        return $this->full_name;
    }

    function getTitle() {
        return $this->full_name;
    }

    function getUsername() {
        return $this->username;
    }
    function getPassword() {
        return $this->password;
    }

    function getEmail() {
        return $this->email ;
    }

    function getTimeJoined() {
        return $this->timeJoined;
    }
    function getPicture() {
        return $this->picture;
    }

    // ? function to verify password
    function verifyPassword($password){
        return password_verify($password, $this->password);
    }

    // setter 

    function setId(string $id){
        $this->id = $id;
    }

    function setUsername(string $username){
        $this->username = $username;
    }

    function setPassword(string $password){
        $this->password = $password;
    }
    function setFullName(string $fName) {
        $this->full_name = $fName;
    }
    function setEmail(string $email) {
        $this->email = $email; 
    }
    function setTimeJoined(string $timeJoined) {
        $this->timeJoined = $timeJoined;
    }
    function setPicture(string $picture) {
        $this->picture =$picture;
    }


}
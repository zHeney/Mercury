<?php

namespace kosh\GooglePublicAPI;


class Album{
    private $id;
    private $title;
    private $photos = array();
    
    function __construct($id, $title) {
        $this->id = $id;
        $this->title = $title;
    }
    
    function getId() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getPhotos() {
        return $this->photos;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setPhotos($photos) {
        $this->photos = $photos;
    }
    
    function addPhoto($photo) {
        $this->photos[] = $photo;
    }


}
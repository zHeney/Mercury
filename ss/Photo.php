<?php
namespace mercury\GooglePublicAPI;

class Photo{
    private $albumId;
    private $title;
    private $src;
    
    function __construct($albumId, $title, $src) {
        $this->albumId = $albumId;
        $this->title = $title;
        $this->src = $src;
    }
    
    function getAlbumId() {
        return $this->albumId;
    }

    function getTitle() {
        return $this->title;
    }

    function getSrc() {
        return $this->src;
    }

    function setAlbumId($albumId) {
        $this->albumId = $albumId;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setSrc($src) {
        $this->src = $src;
    }

}
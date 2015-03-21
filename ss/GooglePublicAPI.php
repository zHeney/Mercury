<?php
namespace kosh;

require_once('Photo.php');
require_once('Album.php');

use kosh\GooglePublicAPI\Photo;
use kosh\GooglePublicAPI\Album;

class GooglePublicAPI{
    const KEY_USERID = "{userid}";
    const KEY_ALBUMID = "{albumid}";
    const KEY_TOTAL = "{total}";

    const API_ENDPOINT_GET_LATEST = "https://picasaweb.google.com/data/feed/api/user/{userid}?kind=photo&max-results={total}&alt=json";
    const API_ENDPOINT_GET_ALBUMS = "https://picasaweb.google.com/data/feed/api/user/{userid}?alt=json";    
    const API_ENDPOINT_GET_ALBUM_PHOTOS = "https://picasaweb.google.com/data/feed/api/user/{userid}/albumid/{albumid}?alt=json";

    public static function getLatestPhotos($googleId,$total = 20)
    {
        $photos = array();
        $url = str_replace(self::KEY_USERID, $googleId, self::API_ENDPOINT_GET_LATEST);
        $url = str_replace(self::KEY_TOTAL, $total, $url);
        $r = self::getJson($url);

        if(isset($r['feed']['entry'])){
            foreach($r['feed']['entry'] as $entry){
                if(
                    isset($entry['content']['type']) && 
                    isset($entry['content']['src']) &&
                    isset($entry['gphoto$albumid']['$t']) &&
                    isset($entry['title']['$t']) &&
                    preg_match("(image*)", $entry['content']['type'])
                ){
                    $photos[] = new Photo($entry['gphoto$albumid']['$t'],$entry['title']['$t'],$entry['content']['src']);
                    
                }
            }
        }

        return $photos;
    }
    
    public static function getPhotosByAlbum($googleId,$albumId)
    {
        $photos = array();
        $url = str_replace(self::KEY_USERID, $googleId, self::API_ENDPOINT_GET_ALBUM_PHOTOS);
        $url = str_replace(self::KEY_ALBUMID, $albumId, $url);
        $r = self::getJson($url);

        if(isset($r['feed']['entry'])){
            foreach($r['feed']['entry'] as $entry){
                if(
                    isset($entry['content']['type']) && 
                    isset($entry['content']['src']) &&
                    isset($entry['gphoto$albumid']['$t']) &&
                    isset($entry['title']['$t']) &&
                    preg_match("(image*)", $entry['content']['type'])
                ){
                    $photos[] = new Photo($entry['gphoto$albumid']['$t'],$entry['title']['$t'],$entry['content']['src']);
                    
                }
            }
        }
        return $photos;
    }

    public static function getAlbums($googleId,$downloadPhotos = false)
    {        
        $r = self::getJson(str_replace(self::KEY_USERID, $googleId, self::API_ENDPOINT_GET_ALBUMS));
        $albums = array();
        if(isset($r['feed']['entry'])){
            foreach($r['feed']['entry'] as $entry){
                if(isset($entry['gphoto$id']['$t']) && isset($entry['title']['$t'])){
                    $album = new Album($entry['gphoto$id']['$t'],$entry['title']['$t']);
                    if($downloadPhotos){
                        $album->setPhotos(self::getPhotosByAlbum($googleId,$album->getId()));
                    }
                    $albums[$album->getId()] = $album;
                }
            }
        }
        return $albums;
    }
    
    public static function loadPhotosToAlbums($photos,&$albums){
        foreach($photos as $photo){
            if(isset($albums[$photo->getAlbumId()])){
                $albums[$photo->getAlbumId()]->addPhoto($photo);
            }
        }
        return $albums;
    }

    private static function getJson($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);
        $result=json_decode(curl_exec($ch),true);
        curl_close($ch);
        return $result;
    }
}
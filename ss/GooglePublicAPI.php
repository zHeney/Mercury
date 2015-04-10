<?php
namespace mercury;

require_once('Photo.php');
require_once('Album.php');

use mercury\GooglePublicAPI\Photo;
use mercury\GooglePublicAPI\Album;

class GooglePublicAPI{
    const KEY_USERID = "{userid}";
    const KEY_ALBUMID = "{albumid}";
    const KEY_TOTAL = "{total}";
    const KEY_IMGMAX = "{imgmax}";
    // read more https://developers.google.com/picasa-web/docs/2.0/reference#Parameters
    // possible values 94, 110, 128, 200, 220, 288, 320, 400, 512, 576, 640, 720, 800, 912, 1024, 1152, 1280, 1440, 1600
    const DEFAULT_IMGMAX = "512";

    const API_ENDPOINT_GET_ALBUMS = "https://picasaweb.google.com/data/feed/api/user/{userid}?alt=json";
    const API_ENDPOINT_GET_LATEST = "https://picasaweb.google.com/data/feed/api/user/{userid}?kind=photo&max-results={total}&alt=json&imgmax={imgmax}";
    const API_ENDPOINT_GET_ALBUM_PHOTOS = "https://picasaweb.google.com/data/feed/api/user/{userid}/albumid/{albumid}?alt=json&imgmax={imgmax}";

    public static function getLatestPhotos($googleId,$total = 20)
    {
        $photos = array();
        $url = str_replace(self::KEY_USERID, $googleId, self::API_ENDPOINT_GET_LATEST);
        $url = str_replace(self::KEY_TOTAL, $total, $url);
        $url = str_replace(self::KEY_IMGMAX,self::DEFAULT_IMGMAX, $url);
        
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
        $url = str_replace(self::KEY_IMGMAX,self::DEFAULT_IMGMAX, $url);
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
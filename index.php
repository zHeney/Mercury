<!DOCTYPE HTML>
<html>    
<?php
    require_once('ss/GooglePublicAPI.php');
    use kosh\GooglePublicAPI;
    $userId = "118008128849823559907";
    
    // here are my changes
    $albums = GooglePublicAPI::getAlbums($userId,true);

    /*
    $albums = GooglePublicAPI::getAlbums($userId);    
    $latestPhotos = GooglePublicAPI::getLatestPhotos($userId,300);
    GooglePublicAPI::loadPhotosToAlbums($latestPhotos, $albums);//*/

    //lets do magic
    $categories = array();
    foreach($albums as $album){
      $categoryName = "";
      if(preg_match("(^(.*):(.*)$)",$album->getTitle(),$r) ){
        $categoryName = trim($r[1]);
        $album->setTitle(trim($r[2]));
        if(!isset($categories[$categoryName])){
          $categories[$categoryName] = array();
        }
        $categories[$categoryName][] = $album;
      }
    }

?>    
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   
    <title>Mercury</title>

    <link rel="stylesheet" href="main.css" type="text/css" >
    <link async href="http://fonts.googleapis.com/css?family=Griffy" rel="stylesheet" type="text/css"/>
   
    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="js/main.js"></script>
 
  </head>

<body>

<!--..............................................TOP-MENU.....................................-->  
  <div id="topMenu">
    <?php foreach($categories as $key=>$sortedAlbums){ ?>
        <div class="menu"><a targetGrid="#grid-<?php echo $key;?>" animationFrom="left" href="#"><?php echo $key;?></a></div>
    <?php } ?>
  </div> 
<!--.............................................LEFT-MENU.....................................-->  
  <div id="leftMenu">
    
    <div animationFrom="right" id="logo-area"></div>
    <div id="info-area">

        <?php foreach($categories as $key=>$sortedAlbums){ ?>
            <div class="menu"><a targetGrid="#grid-<?php echo $key;?>" animationFrom="left" href="#"><?php echo $key;?></a></div>
        <?php } ?>
      
      <div class="menu2"><a href="#" class="Facebook"></a></div>
    </div>
    <div id="arch"></div>
  </div>
<!--..............................................CONTENT......................................--> 
  <div id="content">
<!--...............................................GRID........................................--> 
  
<?php 
$first = true;

foreach($categories as $key=>$sortedAlbums){?>

    <!-- Grid open -->
    <div id="grid-<?php echo $key;?>" class="grid <?php if($first){ echo "active";}?>"><?php

    foreach($sortedAlbums as $album){?>

      <!--Open album name -->
      <div><?php echo $album->getTitle();?></div>
      <!--Close album name -->
      
      <?php foreach($album->getPhotos() as $photo){ ?>
          
          <!-- Photo open-->
          <div class="item">
              <img src="<?php echo $photo->getSrc();?>">
              <div class="hoverGrid"></div>
              <div class="title"><a href="#" class="itemLink"><?php echo $photo->getTitle();?></a></div>
          </div>
          <!-- Photo close-->

      <?php } ?>
      <div class="clear"> </div>
      
      <!-- Gallery separetor open-->
      <!-- <hr/>-->
      <!-- Gallery separetor close-->

    <?php } ?>
    
  </div><!-- Grid close-->

  <?php
  $first = false;
}?>
 
 </body>
</html>
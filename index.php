<!DOCTYPE HTML>
<html>    
<?php
    require_once('ss/GooglePublicAPI.php');
    use mercury\GooglePublicAPI;
    $userId = "118008128849823559907";
    
    // here are my changes
    $albums = GooglePublicAPI::getAlbums($userId,true);

  
     //$albums = GooglePublicAPI::getAlbums($userId);    
     //$latestPhotos = GooglePublicAPI::getLatestPhotos($userId,300);
     //GooglePublicAPI::loadPhotosToAlbums($latestPhotos, $albums);

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
    <link rel="Stylesheet" type="text/css" href="smoothDivScroll.css" />
    <link rel="stylesheet" href="colorbox/colorbox.css" />

    <link async href="http://fonts.googleapis.com/css?family=Griffy" rel="stylesheet" type="text/css"/>
 
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
    <!-- Logo -->
    <div id="logo-area"></div>
    <!-- Menu -->
    <div id="info-area">

      <?php 
      $activeElement = true;
      foreach($categories as $key=>$sortedAlbums){ ?>
        <div class="menu"><a class="<?php echo $activeElement?"activeElement":""; ?>" targetGrid="#grid-<?php echo $key;?>" animationFrom="left" href="#"><?php echo $key;?></a></div>
      <?php $activeElement = false; } ?>

      <div class="menu"><a targetGrid="#gridBottles" href="#">Bottles</a></div>
      
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
    <div id="grid-<?php echo $key;?>" imagegroup="group<?php echo $key; ?>" class="gridWall grid <?php if($first){ echo "active";}?>"><?php

    foreach($sortedAlbums as $album){?>

      <!--Open album name -->
      <div class="albumNameComtainer">

        <div class="albumName"><?php echo $album->getTitle();?></div>
      </div>
      <!--Close album name -->
      
      <?php foreach($album->getPhotos() as $photo){ ?>
          
          <!-- Photo open-->

          <div class="item">         
                <img class="group<?php echo $key; ?>" src="<?php echo $photo->getSrc();?>">
                <!--<div class="hoverGrid"></div>-->
               <!-- <div class="title"><a href="#" class="itemLink"><?php echo $photo->getTitle();?></a></div>-->
          </div> 
          <!-- Photo close-->

      <?php } ?>
      <div class="clear"> </div>
      
    <?php } ?>
    
  </div> 
  <!-- Grid close-->

  <?php
  $first = false;
}?>


<div id="gridBottles" class="grid" style="display: none;">
      
      <div class="makeMeScrollable">
        <div><img class="bottles1" src="https://lh5.googleusercontent.com/-bERCfjhvv08/VR7fDss2wbI/AAAAAAAAABA/TJenfXg5P90/w563-h845-no/Bottle-dark_Mercury_1.png" /></div>        
        <div><img class="bottles1" src="https://lh3.googleusercontent.com/-SHlKtIcJjGY/VR7fKzL0U5I/AAAAAAAAABQ/cA-UmR2ecBc/w563-h845-no/Bottle-dark_Mercury_2.JPG"/></div>
        <div><img class="bottles1" src="https://lh5.googleusercontent.com/-f3ddTqHP3tM/VR7fKumnnyI/AAAAAAAAABM/H3dDT5WTwtc/w563-h845-no/Bottle-dark_Mercury_3.JPG"/></div>
        <div><img class="bottles1" src="https://lh3.googleusercontent.com/-BuM-fM4tdxk/VR7fVHMVPLI/AAAAAAAAABY/KK-bDCHS_DU/w563-h845-no/Bottle-dark_Mercury_4.JPG"/></div>
        <div><img class="bottles1" src="https://lh3.googleusercontent.com/-9Zrbh1HsIs0/VR7fbFC_QxI/AAAAAAAAABg/E2QSYiUXMts/w563-h845-no/Bottle-dark_Mercury_5.JPG"/></div>
        <div><img class="bottles1" src="https://lh5.googleusercontent.com/-bERCfjhvv08/VR7fDss2wbI/AAAAAAAAABA/TJenfXg5P90/w563-h845-no/Bottle-dark_Mercury_1.png"/></div>
        <div><img class="bottles1" src="https://lh5.googleusercontent.com/-bERCfjhvv08/VR7fDss2wbI/AAAAAAAAABA/TJenfXg5P90/w563-h845-no/Bottle-dark_Mercury_1.png"/></div>
  </div>

    <div class="makeMeScrollable">
        <div><img src="https://lh5.googleusercontent.com/-bERCfjhvv08/VR7fDss2wbI/AAAAAAAAABA/TJenfXg5P90/w563-h845-no/Bottle-dark_Mercury_1.png"/></div>
        <div><img src="https://lh3.googleusercontent.com/-SHlKtIcJjGY/VR7fKzL0U5I/AAAAAAAAABQ/cA-UmR2ecBc/w563-h845-no/Bottle-dark_Mercury_2.JPG"/></div>
        <div><img src="https://lh5.googleusercontent.com/-f3ddTqHP3tM/VR7fKumnnyI/AAAAAAAAABM/H3dDT5WTwtc/w563-h845-no/Bottle-dark_Mercury_3.JPG"/></div>
        <div><img src="https://lh3.googleusercontent.com/-BuM-fM4tdxk/VR7fVHMVPLI/AAAAAAAAABY/KK-bDCHS_DU/w563-h845-no/Bottle-dark_Mercury_4.JPG"/></div>
        <div><img src="https://lh3.googleusercontent.com/-9Zrbh1HsIs0/VR7fbFC_QxI/AAAAAAAAABg/E2QSYiUXMts/w563-h845-no/Bottle-dark_Mercury_5.JPG"/></div>
        <div><img src="https://lh5.googleusercontent.com/-bERCfjhvv08/VR7fDss2wbI/AAAAAAAAABA/TJenfXg5P90/w563-h845-no/Bottle-dark_Mercury_1.png"/></div>
        <div><img src="https://lh5.googleusercontent.com/-bERCfjhvv08/VR7fDss2wbI/AAAAAAAAABA/TJenfXg5P90/w563-h845-no/Bottle-dark_Mercury_1.png"/></div>
  </div>
  <div class="makeMeScrollable">
        <div><img src="https://lh5.googleusercontent.com/-bERCfjhvv08/VR7fDss2wbI/AAAAAAAAABA/TJenfXg5P90/w563-h845-no/Bottle-dark_Mercury_1.png"/></div>
        <div><img src="https://lh3.googleusercontent.com/-SHlKtIcJjGY/VR7fKzL0U5I/AAAAAAAAABQ/cA-UmR2ecBc/w563-h845-no/Bottle-dark_Mercury_2.JPG"/></div>
        <div><img src="https://lh5.googleusercontent.com/-f3ddTqHP3tM/VR7fKumnnyI/AAAAAAAAABM/H3dDT5WTwtc/w563-h845-no/Bottle-dark_Mercury_3.JPG"/></div>
        <div><img src="https://lh3.googleusercontent.com/-BuM-fM4tdxk/VR7fVHMVPLI/AAAAAAAAABY/KK-bDCHS_DU/w563-h845-no/Bottle-dark_Mercury_4.JPG"/></div>
        <div><img src="https://lh3.googleusercontent.com/-9Zrbh1HsIs0/VR7fbFC_QxI/AAAAAAAAABg/E2QSYiUXMts/w563-h845-no/Bottle-dark_Mercury_5.JPG"/></div>
        <div><img src="https://lh5.googleusercontent.com/-bERCfjhvv08/VR7fDss2wbI/AAAAAAAAABA/TJenfXg5P90/w563-h845-no/Bottle-dark_Mercury_1.png"/></div>
        <div><img src="https://lh5.googleusercontent.com/-bERCfjhvv08/VR7fDss2wbI/AAAAAAAAABA/TJenfXg5P90/w563-h845-no/Bottle-dark_Mercury_1.png"/></div>
  </div>
  <div class="makeMeScrollable">
        <div><img src="https://lh5.googleusercontent.com/-bERCfjhvv08/VR7fDss2wbI/AAAAAAAAABA/TJenfXg5P90/w563-h845-no/Bottle-dark_Mercury_1.png"/></div>
        <div><img src="https://lh3.googleusercontent.com/-SHlKtIcJjGY/VR7fKzL0U5I/AAAAAAAAABQ/cA-UmR2ecBc/w563-h845-no/Bottle-dark_Mercury_2.JPG"/></div>
        <div><img src="https://lh5.googleusercontent.com/-f3ddTqHP3tM/VR7fKumnnyI/AAAAAAAAABM/H3dDT5WTwtc/w563-h845-no/Bottle-dark_Mercury_3.JPG"/></div>
        <div><img src="https://lh3.googleusercontent.com/-BuM-fM4tdxk/VR7fVHMVPLI/AAAAAAAAABY/KK-bDCHS_DU/w563-h845-no/Bottle-dark_Mercury_4.JPG"/></div>
        <div><img src="https://lh3.googleusercontent.com/-9Zrbh1HsIs0/VR7fbFC_QxI/AAAAAAAAABg/E2QSYiUXMts/w563-h845-no/Bottle-dark_Mercury_5.JPG"/></div>
        <div><img src="https://lh5.googleusercontent.com/-bERCfjhvv08/VR7fDss2wbI/AAAAAAAAABA/TJenfXg5P90/w563-h845-no/Bottle-dark_Mercury_1.png"/></div>
        <div><img src="https://lh5.googleusercontent.com/-bERCfjhvv08/VR7fDss2wbI/AAAAAAAAABA/TJenfXg5P90/w563-h845-no/Bottle-dark_Mercury_1.png"/></div>
  </div>
  <div class="makeMeScrollable">
        <div><img src="https://lh5.googleusercontent.com/-bERCfjhvv08/VR7fDss2wbI/AAAAAAAAABA/TJenfXg5P90/w563-h845-no/Bottle-dark_Mercury_1.png"/></div>
        <div><img src="https://lh3.googleusercontent.com/-SHlKtIcJjGY/VR7fKzL0U5I/AAAAAAAAABQ/cA-UmR2ecBc/w563-h845-no/Bottle-dark_Mercury_2.JPG"/></div>
        <div><img src="https://lh5.googleusercontent.com/-f3ddTqHP3tM/VR7fKumnnyI/AAAAAAAAABM/H3dDT5WTwtc/w563-h845-no/Bottle-dark_Mercury_3.JPG"/></div>
        <div><img src="https://lh3.googleusercontent.com/-BuM-fM4tdxk/VR7fVHMVPLI/AAAAAAAAABY/KK-bDCHS_DU/w563-h845-no/Bottle-dark_Mercury_4.JPG"/></div>
        <div><img src="https://lh3.googleusercontent.com/-9Zrbh1HsIs0/VR7fbFC_QxI/AAAAAAAAABg/E2QSYiUXMts/w563-h845-no/Bottle-dark_Mercury_5.JPG"/></div>
        <div><img src="https://lh5.googleusercontent.com/-bERCfjhvv08/VR7fDss2wbI/AAAAAAAAABA/TJenfXg5P90/w563-h845-no/Bottle-dark_Mercury_1.png"/></div>
        <div><img src="https://lh5.googleusercontent.com/-bERCfjhvv08/VR7fDss2wbI/AAAAAAAAABA/TJenfXg5P90/w563-h845-no/Bottle-dark_Mercury_1.png"/></div>
  </div>
        
</div>

  

  


  <script src="js/jquery-2.1.3.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
  <script src="js/jquery.mousewheel.min.js" type="text/javascript"></script>
  <script src="js/jquery.kinetic.min.js" type="text/javascript"></script>
  <script src="js/jquery.smoothdivscroll-1.3-min.js" type="text/javascript"></script>
  <script src="js/jquery.colorbox-min.js" type="text/javascript"></script>
 </body>
</html>
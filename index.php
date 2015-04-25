<!DOCTYPE HTML>
<html>    
<?php
    require_once('ss/GooglePublicAPI.php');
    use mercury\GooglePublicAPI;
    $userId = "111770257557523342209";
    //Yarutun 118008128849823559907
    //Mercury 111770257557523342209
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
   
   <script src="js/jquery-2.1.3.min.js"></script>
   <script src="js/main.js"></script>

  </head>

<!--..............................................BODY.....................................-->  
<body class="noScroll">

<!--..............................................TOP-MENU.....................................-->  
  <div id="topMenu">
    <?php 
    $activeElement = true;
    foreach($categories as $key=>$sortedAlbums){ ?>
        <div class="menu"><a class="<?php echo $activeElement?"activeElement":""; ?>" targetGrid="#grid-<?php echo $key;?>" animationFrom="left" href=""><?php echo $key;?></a></div>
    <?php } ?>
    <div class="menu"><a targetGrid="#gridBottles" href="">Bottles</a></div> 
    <div class="menu"><a targetGrid="#gridFrames" href="">Frames</a></div>
    <div class="menu"><a targetGrid="#gridOther" href="">Other</a></div> 
        
  </div> 
<!--.............................................LEFT-MENU.....................................-->  
  <div id="leftMenu">
    <!-- Logo -->
    <div id="logo-area">Mercury</div>
    <!-- Menu -->
    <div id="info-area">
      <?php 
      $activeElement = true;
      foreach($categories as $key=>$sortedAlbums){ ?>
        <div class="menu"><a class="<?php echo $activeElement?"activeElement":""; ?>" targetGrid="#grid-<?php echo $key;?>" animationFrom="left" href=""><?php echo $key;?></a></div>
      <?php $activeElement = false; } ?>

    <div class="menu"><a targetGrid="#gridBottles" href="">Bottles</a></div>
    <div class="menu"><a targetGrid="#gridFrames" href="">Frames</a></div> 
    <div class="menu"><a targetGrid="#gridOther" href="">Other</a></div>    
      
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
    <div id="grid-<?php echo $key;?>" imagegroup="group<?php echo $key; ?>" class="gridWall grid <?php if($first){ echo "active";}?>">

      <div class="albumName">Wall</div>

      <div class="column-style"><!-- items are here -->

        <?php

        foreach($sortedAlbums as $album){?>

          <!--
            <div class="albumName"><?php echo $album->getTitle();?></div>
            </div> -->
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
         <!-- <div class="clear"> </div> -->
          
        <?php } ?>
      </div>
  </div> 
  <!-- Grid close-->

  <?php
  $first = false;
}?>

<!-- .......................................................BOTTLES....................................................... -->

<div id="gridBottles" class="grid" style="display: none;">
  <div class="topic"><p class="topicText"><---- Touch to scroll ----></p></div>

   <!-- Bottle-darkRed-->
  <div class="albumName">Magic vessel</div>
  <div class="makeMeScrollable">
    <div class="barefaced">
      <div><img class="bottles" src="https://lh6.googleusercontent.com/-87801oN7Hkw/VS0eo33sAjI/AAAAAAAAACc/2fCb5xgdfvc/w548-h845-no/Bottle-darkRed_Mercury_1.png" /></div>
      <div><img class="bottles" src="https://lh6.googleusercontent.com/-s2WyugNGBAw/VS0xBhl7JII/AAAAAAAAADU/ivpD90bRu5c/w508-h845-no/Bottle-darkRed_Mercury_4.png" /></div>
      <div><img class="bottles" src="https://lh6.googleusercontent.com/-Poexx1WctWw/VS0nPzdKFPI/AAAAAAAAADA/6pjTIBMxGTE/w1127-h845-no/Bottle-darkRed_Mercury_3.jpg" /></div>
      <div><img class="bottles" src="https://lh4.googleusercontent.com/-tXydK33IClU/VS0kdaYvwFI/AAAAAAAAACw/MQFvMZblvEE/w1127-h845-no/Bottle-darkRed_Mercury_2.jpg" /></div>
      <div class="clearfix"></div>
    </div>
  </div>

   <!-- Bottle-gyps-->
  <div class="albumName">Gypsum bottles</div>
  <div class="makeMeScrollable">
    <div class="barefaced">
      <div><img class="bottles" src="https://lh4.googleusercontent.com/-F1XgX37ibJc/VS1Yz_TU8tI/AAAAAAAAAE4/a-SV37qnrN0/w634-h845-no/Bottle-gyps_Mercury_6.jpg" /></div>  
      <div><img class="bottles" src="https://lh6.googleusercontent.com/-XP8dkxHReoY/VS1FjlfuSjI/AAAAAAAAAD0/U8Fo6hv9Ffg/w564-h845-no/Bottle-gyps_Mercury_1.png" /></div> 
      <div><img class="bottles" src="https://lh5.googleusercontent.com/-6Mr0W2fsFT4/VS1FqOwJlhI/AAAAAAAAAEA/kMfM_iMzauI/w563-h845-no/Bottle-gyps_Mercury_2.JPG" /></div> 
      <div><img class="bottles" src="https://lh4.googleusercontent.com/-J_gpgs1Z96M/VS1FfVuV7TI/AAAAAAAAADo/lGAZa-ySEeQ/w564-h845-no/Bottle-gyps_Mercury_3.jpg" /></div>        
      <div><img class="bottles" src="https://lh4.googleusercontent.com/-8TPbvUB-Zvo/VS1Fk8gUiRI/AAAAAAAAAD4/vNyPNQxYwnU/w564-h845-no/Bottle-gyps_Mercury_4.jpg" /></div>  
      <div><img class="bottles" src="https://lh3.googleusercontent.com/-i2H5sZLQgNM/VS1UvrXqHLI/AAAAAAAAAEU/-OWz5Y1ywAE/w1214-h845-no/Bottle-gyps_Mercury_5.jpg" /></div>  
      <div class="clearfix"></div>
    </div>
  </div>

     <!-- Bottle-twine-->
  <div class="albumName">Twine bottles</div>
  <div class="makeMeScrollable">
    <div class="barefaced">
      <div><img class="bottles" src="https://lh4.googleusercontent.com/-9MRkn8PGSpQ/VS1pSKTF9MI/AAAAAAAAAFU/gVMQV_WoVjQ/w634-h845-no/Bottle-twine_Mercury_1.jpg" /></div>        
      <div><img class="bottles" src="https://lh4.googleusercontent.com/-1Gu--515DAU/VS1pGB2_2vI/AAAAAAAAAFM/ZHuMKbkByaY/w564-h845-no/Bottle-twine_Mercury_3.jpg"/></div>
      <div><img class="bottles" src="https://lh4.googleusercontent.com/-h__SpGXhxig/VS1qhMLPMoI/AAAAAAAAAFw/x1DBjmj0eWw/w564-h845-no/Bottle-twine_Mercury_2.JPG"/></div>
      <div><img class="bottles" src="https://lh4.googleusercontent.com/-Kf_RG39yxjw/VS1wECK3T2I/AAAAAAAAAGI/ggfL87rojmw/w670-h845-no/Bottle-twine_Mercury_4.jpg"/></div>
      <div class="clearfix"></div>
    </div>
  </div>

   <!-- Bottle-dark-->
  <div class="albumName">Twine tracery</div>     
  <div class="makeMeScrollable">
    <div class="barefaced">
      <div><img class="bottles" src="https://lh5.googleusercontent.com/-bERCfjhvv08/VR7fDss2wbI/AAAAAAAAABA/TJenfXg5P90/w563-h845-no/Bottle-dark_Mercury_1.png" /></div>        
      <div><img class="bottles" src="https://lh3.googleusercontent.com/-SHlKtIcJjGY/VR7fKzL0U5I/AAAAAAAAABQ/cA-UmR2ecBc/w563-h845-no/Bottle-dark_Mercury_2.JPG"/></div>
      <div><img class="bottles" src="https://lh5.googleusercontent.com/-f3ddTqHP3tM/VR7fKumnnyI/AAAAAAAAABM/H3dDT5WTwtc/w563-h845-no/Bottle-dark_Mercury_3.JPG"/></div>
      <div><img class="bottles" src="https://lh3.googleusercontent.com/-BuM-fM4tdxk/VR7fVHMVPLI/AAAAAAAAABY/KK-bDCHS_DU/w563-h845-no/Bottle-dark_Mercury_4.JPG"/></div>
      <div><img class="bottles" src="https://lh3.googleusercontent.com/-9Zrbh1HsIs0/VR7fbFC_QxI/AAAAAAAAABg/E2QSYiUXMts/w563-h845-no/Bottle-dark_Mercury_5.JPG"/></div>
      <div class="clearfix"></div>
    </div>
  </div>

   <!-- Bottle-dark2-->
  <div class="albumName">Twine tracery 2</div>   
  <div class="makeMeScrollable">
    <div class="barefaced">
      <div><img class="bottles" src="https://lh5.googleusercontent.com/-aP9djcJRlLQ/VR7lwIcFGhI/AAAAAAAAAB8/rc4i5sRsjII/w563-h845-no/Bottle-dark2_Mercury_1.png" /></div>        
      <div><img class="bottles" src="https://lh5.googleusercontent.com/-mpS5h1AHaa4/VR7lx_SAmXI/AAAAAAAAACA/c1x4G4T-UeM/w563-h845-no/Bottle-dark2_Mercury_2.JPG"/></div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>

<!-- .......................................................FRAMES....................................................... -->

<div id="gridFrames" class="grid" style="display: none;">
  <div class="topic"><p class="topicText"><---- Touch to scroll ----></p></div>
  <div class="albumName">Photo frames</div>   
  <div class="makeMeScrollable">
    <div class="barefaced">
      <div><img class="frames" src="https://lh6.googleusercontent.com/-iTcjj5MyWgI/VTjYr3UQPNI/AAAAAAAAASc/-z8e0ckB8xQ/h845-no/Frame8_Mercury.jpg"/></div> 
      <div><img class="frames" src="https://lh5.googleusercontent.com/-FvFhBeCIKVg/VS693rrHi-I/AAAAAAAAARE/SZmej66-96g/h1024-no/Frame4_Mercury.jpg"/></div>      
      <div><img class="frames" src="https://lh3.googleusercontent.com/-tVLhq2ps76I/VS694NUCrSI/AAAAAAAAARE/9Muhf19ee-s/h1024-no/Frame5_Mercury.jpg"/></div>           
      <div><img class="frames" src="https://lh5.googleusercontent.com/-KJN7ihRV1lE/VS69vdZWL-I/AAAAAAAAARE/3t9eEUI2fqA/h1024-no/Frame1_Mercury.jpg"/></div>        
      <div><img class="frames" src="https://lh4.googleusercontent.com/-mdI3u_ftthg/VS69wH0ybGI/AAAAAAAAARE/nZzlh_LMnv8/h1024-no/Frame2_Mercury.jpg"/></div>
      <div><img class="frames" src="https://lh3.googleusercontent.com/-I1lKUdhnI2Y/VS69v6k_qaI/AAAAAAAAARE/ywAm0GwNcLI/h1024-no/Frame3_Mercury.jpg"/></div>
      <div><img class="frames" src="https://lh6.googleusercontent.com/-8xMSM-0cKps/VS694wiBZvI/AAAAAAAAARE/0cvQHdJbcjY/h1024-no/Frame6_Mercury.jpg"/></div>
     
      <div class="clearfix"></div>
    </div>
  </div>

  <div class="albumName">Coffee-Flower Frame</div>   
  <div class="makeMeScrollable">
    <div class="barefaced">
      <div><img class="frames" src="https://lh6.googleusercontent.com/-30rYRL5NZrs/VTjZ3FAU1LI/AAAAAAAAAS8/6JM5f2A-knA/w889-h845-no/CoffeeFlowerFrame1_Mercury.jpg"/></div>        
      <div><img class="frames" src="https://lh6.googleusercontent.com/-dZFI17YbQhg/VTjZ2ez9HzI/AAAAAAAAAS4/AUqZaj43gpc/w1127-h845-no/CoffeeFlowerFrame2_Mercury.jpg"/></div>
      <div><img class="frames" src="https://lh4.googleusercontent.com/-Ufj4D7ldsB4/VTjZ2DS6kBI/AAAAAAAAASw/yVSVHZvBA0Q/w1127-h845-no/CoffeeFlowerFrame3_Mercury.jpg"/></div>   
      <div class="clearfix"></div>
    </div>
  </div>

  <div class="footBorder"></div>
</div>



<!-- .......................................................DIFFERENT....................................................... -->
<div id="gridOther" class="grid" style="display: none;">
  <div class="topic"><p class="topicText"><---- Touch to scroll ----></p></div>
   <!-- Different -->
  <div class="albumName">Other</div>
  <div class="makeMeScrollable">
    <div class="barefaced other">
      <div><img src="https://lh6.googleusercontent.com/-30rYRL5NZrs/VTjZ3FAU1LI/AAAAAAAAAS8/6JM5f2A-knA/w889-h845-no/CoffeeFlowerFrame1_Mercury.jpg"/></div>        
      <div><img src="https://lh6.googleusercontent.com/-dZFI17YbQhg/VTjZ2ez9HzI/AAAAAAAAAS4/AUqZaj43gpc/w1127-h845-no/CoffeeFlowerFrame2_Mercury.jpg"/></div>
      <div><img src="https://lh4.googleusercontent.com/-Ufj4D7ldsB4/VTjZ2DS6kBI/AAAAAAAAASw/yVSVHZvBA0Q/w1127-h845-no/CoffeeFlowerFrame3_Mercury.jpg"/></div>   
      <div class="clearfix"></div>
    </div>
  </div>
</div>


<div id="loading">
  <div id="spinner"><img src="pict/spinner-eater.gif"> <img src="pict/spinner-ball.gif"></div>  
</div>

  <script src="js/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
  <script src="js/jquery.mousewheel.min.js" type="text/javascript"></script>
  <script src="js/jquery.kinetic.min.js" type="text/javascript"></script>
  <script src="js/jquery.smoothdivscroll-1.3-min.js" type="text/javascript"></script>
  <script src="js/jquery.colorbox-min.js" type="text/javascript"></script>
 </body>
</html>
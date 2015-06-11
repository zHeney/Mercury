<!DOCTYPE HTML>
<html>    
<?php
    define("HOST", "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

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

    // let's prepear some data for facebook LIKE    
    
    $shareUrlKey = "url";
    $shareUrl = HOST . "?{$shareUrlKey}=";

    $url = isset($_GET[$shareUrlKey]) && !empty($_GET[$shareUrlKey]) ? $_GET[$shareUrlKey] : null;

?>    
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <meta http-equiv="expires" content="0">
    <meta name="Description" content="handmade products of twine, interior, photo frames, painted bottles, products from organic materials, caskets and ornamental boxes">
    <meta name="author" content="Mercury, astrummercury@gmail.com"/>
    <meta name="designer" content="zHeney, zHeney@ya.ru">
    <meta name="revisit-after" content="7 days">
    <meta name="language" content="english">
    <meta name="robots" content="index,nofollow" />

    <meta property="og:title" content="Astrum Mercury" />
    <meta property="og:site_name" content="Astrum Mercury"/>
    <meta property="og:description" content="Astrum Mercury"/>
    <meta property="og:url" content="<?php echo HOST; ?>" />

    <title>Astrum Mercury</title>

    <link rel="stylesheet" href="main.css" type="text/css" >
    <link rel="Stylesheet" type="text/css" href="smoothDivScroll.css" />
    <link rel="stylesheet" href="colorbox/colorbox.css" />

    <link async href="http://fonts.googleapis.com/css?family=Griffy" rel="stylesheet" type="text/css"/>
   
   <script src="js/jquery-2.1.3.min.js"></script>
   <script src="js/main.js"></script>

  </head>

<!--..............................................BODY.....................................-->  
<body class="allowHover">

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

          <!-- getTitle -->
          <!--<div class="albumName"><?php echo $album->getTitle();?></div>-->
          <!--Close album name -->
          
          <?php foreach($album->getPhotos() as $photo){ ?>

          <!-- Photo open-->
          <div class="item">
            <img class="group<?php echo $key; ?> " src="<?php echo $photo->getSrc();?>">
            <!-- getTitle -->
            <!-- <div class="title"><a href="#" class="itemLink"><?php echo $photo->getTitle();?></a></div> -->
          </div> 
          <!-- Photo close-->

          <?php } ?>
          
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

</div>



<!-- .......................................................OTHER....................................................... -->

<div id="gridOther" class="grid" style="display: none;">
  <div class="column-style">
    <div class="item">
      <img class="other" src="https://lh3.googleusercontent.com/izQ0kQIjeeBU0SwAajCtnk4P7UacniWBA4xzqAoOqM0=w997-h935-no?Trees.jpg"/> 
      <img class="other" src="https://lh3.googleusercontent.com/nhFeho7UujrDc7DkFZ1JoV5CIeDwGlVambQwCgZQMoA=w647-h935-no?GreenSeedTree.jpg"/>         
      <img class="other" src="https://lh3.googleusercontent.com/waNlCfs85uu19MCP_v_qJRd5YNEGCVd41lW4bbWGZFY=w1103-h935-no?WoodBubbles.jpg"/> 
      <img class="other" src="https://lh3.googleusercontent.com/GyyF2_FTtqGzx6U8FQfNF5-AOMMOhlZk3K7nVZyd3N0=w567-h800-no?CofeeTree.jpg"/>
      <img class="other" src="https://lh3.googleusercontent.com/saLzFA6hvIHOPct01Szto3eAIkyjvbeN3k5xluDvMd8=w600-h800-no?CofeeTree_2.jpg"/>
      <img class="other" src="https://lh3.googleusercontent.com/E5tTqzCMTCZTZ0AZSjCMCuLNMjFkcKN44wZ6sJVERkE=w1356-h935-no?CoffeeSnake_2.jpg"/>  
      <img class="other" src="https://lh3.googleusercontent.com/tQ3TpkHGhhf8W8f8ak4qa2BVWMswzrBe53KZ5nzd44Q=w1412-h935-no?CoffeeSnake.jpg"/>
      <img class="other" src="https://lh3.googleusercontent.com/HzppU9d5Z1NJUZgz0gox69OOGpOMThoxeiqgFz5IgKw=w1303-h800-no?GenieLamp.jpg"/>
      <img class="other" src="https://lh3.googleusercontent.com/rLNO0wSzG9KlCHdq-_Flq_iV63UEVwjmEhd78bFA1R8=w1232-h935-no?MossTree.jpg"/>
      <img class="other" src="https://lh3.googleusercontent.com/bWBAoQC2TRDMpQ8D3x3LGXNCezKpzps7TfISZvAmzwg=w1009-h935-no?Quilling.jpg"/>
      <img class="other" src="https://lh3.googleusercontent.com/JrQCUZF5U3qArqzLR1_iUpAUyP7fNrLkEMYHQ77lyeE=w816-h935-no?Sheep.jpg"/>

    </div>  
  </div> 
</div>

</div>

<!-- .......................................................LOADING....................................................... -->

<div id="loading">  
  <div id="gradientLoading"></div>
  <div class="loadingText">Loading <span id="pageloading"></span></div>
  <div id="spinner">
    <img src="pict/spinner-eater.gif"> <img src="pict/spinner-ball.gif">
  </div>  
</div>

<script src="js/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="js/jquery.mousewheel.min.js" type="text/javascript"></script>
<script src="js/jquery.kinetic.min.js" type="text/javascript"></script>
<script src="js/jquery.smoothdivscroll-1.3-min.js" type="text/javascript"></script>
<script src="js/jquery.colorbox-min.js" type="text/javascript"></script>

<!-- ...................................................GoogleAnalytics................................................... -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-63459881-1', 'auto');
ga('send', 'pageview');
</script>


  <div class="waveVertical"></div>
  <div class="wave"></div>

</body>
</html>
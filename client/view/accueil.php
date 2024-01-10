<?php
require_once("commun.php");



class accueil {

    public function navBar()
    {
        $currentAction = isset($_GET['action']) ? $_GET['action'] : '';
    
        ?>
        <div style="display: flex; justify-content: center; align-items: center;">
    
            <div>
                <ul style="display: flex; flex-direction: row; justify-content: center; align-items: center; list-style: none; gap: 150px; font-size: 20px;">
                    <li><a href="./index.php?action=home" style="text-decoration: none; color: <?= $currentAction === 'home' ? 'red' : '#000'; ?>">Accueil</a></li>
                    <li><a href="./index.php?action=marques" style="text-decoration: none; color: <?= $currentAction === 'marques' ? 'red' : '#000'; ?>">Marques</a></li>
                    <li><a href="./index.php?action=avis" style="text-decoration: none; color: <?= $currentAction === 'avis' ? 'red' : '#000'; ?>">Avis</a></li>

                    <li><a href="./index.php?action=comparateur" style="text-decoration: none; color: <?= $currentAction === 'comparateur' ? 'red' : '#000'; ?>">Comparateur</a></li>
                    <li><a href="./index.php?action=news" style="text-decoration: none; color: <?= $currentAction === 'news' ? 'red' : '#000'; ?>">News</a></li>
                    <li><a href="./index.php?action=guide" style="text-decoration: none; color: <?= $currentAction === 'guide' ? 'red' : '#000'; ?>">Guides d'achats</a></li>
                    <li><a href="./index.php?action=contact" style="text-decoration: none; color: <?= $currentAction === 'contact' ? 'red' : '#000'; ?>">Contact</a></li>
                </ul>
            </div>
        </div>
        <?php
    }
   
public function header(){
    ?>
    <header>
        <div class="header" style="overflow:visible">
        <a href="./index.php?action=home"> <h1>Logo</h1></a>
        <div class="socialContainer">
           <a href="https://www.google.com/"> <img src="./img/assets/google.png"></img></a>
           <a href="https://www.facebook.com"><img src="./img/assets/facebook.png"></img></a>
           <a href="https://www.twitter.com"><img src="./img/assets/twitter.png"></img></a>
           <?php
             if(isset($_SESSION['user']
             )){
                $loggedInUser = $_SESSION['user'];
                ?>
                <div class="dropdown">
           <a class="btn btn-danger dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $loggedInUser["nom"];echo " "; echo $loggedInUser["prenom"];  ?>
             </a>

            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="./index.php?action=profile" >Votre profile</a></li>  
            <li><a class="dropdown-item" href="./index.php?action=logoutHandler">Se deconnecter</a></li>
           </ul>
            </div>
              
             <?php
             }else {
                ?>
                <a href="./index.php?action=auth">Se connecter</a>
                <?php
             } 
           ?>
        </div>
        </div>
        
    </header>
    <?php
}


public function head($title, $description)
 {
 ?>
  <!DOCTYPE html>
  <html>
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="pragma" content="no cache" />
            <title><?php echo $title ?></title>
            <meta name="description" content=<?php echo $description ?> />
            
            <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="stylesheet" href="styles.css">

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  </head>
    <?php
}

public function newsSection($news){

 ?>

    <div class="newsContainer" style="display:flex;flex-direction:column;align-items-center;width:100%;height: 400px;">
        <?php 
        if(empty($news)){
            ?>
        <p>Nothing to display</p>
        <?php
        } else {
            $delay=0;
            foreach ($news as $singleNews) {
                ?>
                <div class="newsItem" style="animation-delay: <?php echo $delay; ?>s;">
                    <div class="titleContainer"> 
                        <h2><?php echo $singleNews['title']; ?></h2>
                    </div>
                    <div class="imageContainer">
                        <?php 
                        if (!empty($singleNews['images'])) {
                            ?>
                            <img src="./img/news/<?php echo $singleNews['images'][0]; ?>" alt="News Image">
                            <?php
                        } else {
                            ?>
                            <p>No image available</p>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                $delay+=5;
            }
        }
        ?>
    </div>
      <?php  
}
 


public function marquesSection($marques)
{   $commun=new Commun();
    $numSlides = ceil(count($marques) / 3);
    ?>
    <div class="marquesContainer">
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                <?php for ($i = 0; $i < $numSlides; $i++) : ?>
                    <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                        <div style="display:flex; justify-content:space-around; align-items:center;">
                            <?php
                            for ($j = $i * 3; $j < min(($i + 1) * 3, count($marques)); $j++) :
                            ?>
                             <a href="./index.php?action=marques&id=<?php echo $marques[$j]['id'] ?>">   <img src="./img/marques/<?php echo $marques[$j]['images'][0] ?? ''; ?>" alt="..." style="width:200px; height:auto;"></a>
                            <?php endfor; ?>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'%23F41F11\' viewBox=\'0 0 8 8\'%3E%3Cpath d=\'M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z\'/%3E%3C/svg%3E') !important;"
 >                </span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'%23F41F11\' viewBox=\'0 0 8 8\'%3E%3Cpath d=\'M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z\'/%3E%3C/svg%3E') !important;"

 ></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    
    <?php
    $commun->separator();
}

   
    public function footer (){
        ?>
        </html>
        <?php
    }

    
    
    
  
 








 







}
?>

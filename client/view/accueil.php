<?php
class accueil {

public function navBar(){
 ?><div style=" display:flex; justify-content:center;align-items-center">

 
 <div class="navbar">
    <ul>
        <li><a href="">Accueil</a></li>
        <li><a href="">Marques</a></li>
        <li><a href="">Comparateur</a></li>
        <li><a href="">News</a></li>
        <li><a href="">Guides d'achats</a></li>
        <li><a href="">Contact</a></li>


    </ul>
 </div></div>
 <?php
}    
public function header(){
    ?>
    <header>
        <div class="header">
        <h1>Logo</h1>
        <div class="socialContainer">
           <a href="https://www.google.com/"> <img src="./img/assets/google.png"></img></a>
           <a href="https://www.facebook.com"><img src="./img/assets/facebook.png"></img></a>
           <a href="https://www.twitter.com"><img src="./img/assets/twitter.png"></img></a>

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

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Oswald:wght@300;400;600;700&family=Poppins:wght@500;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="styles.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>
    <?php
    }

    public function newsSection($news){

?>

    <div class="newsContainer">
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
{
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
                                <img src="./img/marques/<?php echo $marques[$j]['images'][0] ?? ''; ?>.png" alt="..." style="width:200px; height:auto;">
                            <?php endfor; ?>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'%23F41F11\' viewBox=\'0 0 8 8\'%3E%3Cpath d=\'M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z\'/%3E%3C/svg%3E') !important;"
></span>
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
}

    public function footer (){
        ?>
        </html>
        <?php
    }

    public function separator(){
        ?>
        <div style="display:flex;justify-content:center;">
        <div style="width:90%;height:5px;background-color:#F41F11;margin-top:50px;"></div></div>
        <?php
    }
}
?>

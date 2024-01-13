<?php
class News{

    public function news($news){
        ?>



<div class="card mb-3 w-50 ">
  <img src="./img/news/<?php echo $news["images"][0]?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php echo $news["title"]?></h5>
    <p class="card-text"><?php echo $news["description"]?></p>
    <a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=detailNews&id=<?php echo $news["id"]?>">Voir plus</a>
  </div>
</div>











        
        <?php
    }
    public function newsPage($news)
{
 ?>
    <div style="display:flex;flex-direction:column;align-items:center;width:100%;gap:50px;margin-top:50px;">
    <?php
     foreach ($news as $n) {
      $this->news($n);     
    }
    ?> 
    </div>
 <?php
}
public function newsDetails($news)
{       
        echo '<div style="width: 100%; margin: 10px auto; display: flex;flex-direction:column ; align-items: center;gap:10px;">';
        echo "<h1>Details news</h1>";
        echo '<div style="width: 80%; margin: 10px auto; display: flex; justify-content: space-evenly; align-items: center;">';
        echo '<img class="card-img-top w-25" src="../client/img/news/' . $news[0]['images'][0] . '" alt="' . $news[0]['title'] . '">';
        
        echo '</div>';
        echo '<div style="width: 80%; margin: 10px auto; display: flex;flex-direction:column;gap:20px">';
        ?>
          <div style="display:flex;justify-content:start;align-items:center;gap:50px;">
          <h3>Titre :  </h3>
          <input id="title" style="border-radius:7px;font-size:20px;font-weight:300;width:40%;outline:none;background:white;color:black;border:none" disabled value="<?php echo $news[0]['title'] ?>"  >
        </div>
        <div style="display:flex;justify-content:start;align-items:center;gap:50px;">
        <h3>Description :  </h3>
          <input id="description" style="border-radius:7px;font-size:20px;font-weight:300;width:40%;outline:none;background:white;color:black;border:none" disabled value="<?php echo $news[0]['description'] ?>"  >
        </div>
        <div style="display:flex;justify-content:start;align-items:center;gap:50px;">
        <h3>Details :  </h3>
        <textarea id="details" style="border-radius:7px;font-size:20px;font-weight:300;width:40%;outline:none;background:white;color:black;border:none" disabled><?php echo $news[0]['details'] ?></textarea>
        </div>
        
        <div id="imgContainer" style="display:none">

        

     </div>

       
        
        <?php
        echo '</div>';

        ?>

        
        <?php

}

}
?>
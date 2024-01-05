<?php
class News{

    public function news($news){
        ?>
        <div style="width:60%;height:280px;display:flex;flex-direction:column;align-items:center;gap:15px;border:solid 2px #F41F11; border-radius:10px;padding:10px; ">
           <h3><?php echo $news["title"]?></h3>
           <div style="width:90%;height:380px;display:flex;flex-direction:row;align-items:center;justify-content:space-between">
           <h4 style="font-weight:300"><?php echo $news["description"]?></h4>
           <img src="./img/news/<?php echo $news["images"][0]?>" style="width:200px;height:100px;">
        </div>
        <a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=detailNews&id=<?php echo $news["id"]?>">Voir plus</a>
    
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

}
?>
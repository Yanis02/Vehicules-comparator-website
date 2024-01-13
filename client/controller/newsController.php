<?php
require_once("./model/news.php");
require_once("./view/news.php");
class NewsController{
    private $newsView;
    public function __construct() {
        $this->newsView = new News();
    }
    public function showNewsPage(){
        $newsModel=new newsModel();
            $news=$newsModel->getAllNews();
            ##var_dump($news);
            $this->newsView->newsPage($news);
     }
     public function showNewsDetails(){
        if (isset($_GET["id"])) {
            $id=$_GET["id"];
            $newsModel=new newsModel();
            $news=$newsModel->getNewsById($id);
            $this->newsView->newsDetails($news);

        }
     }
}
?>
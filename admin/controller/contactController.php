<?php
require_once("./model/contact.php");
require_once("./view/contact.php");



class ContactController{
    private $gestionContactView;

    public function __construct() {
        $this->gestionContactView = new gestionContact();
    }
   
    public function showContactDetails(){
                $contactModel=new Contact();
                $contact=$contactModel->getContact();
                $this->gestionContactView->contactDetails($contact);
               
            
            }

           
                            
                                   
}
?>
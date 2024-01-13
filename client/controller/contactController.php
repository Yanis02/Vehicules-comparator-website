<?php
require_once("./model/contact.php");
require_once("./view/contact.php");



class ContactController{
   
    public function showContactDetails(){
                $contactModel=new Contact();
                $contact=$contactModel->getContact();
                $contactView=new ContactView();
                $contactView->contactDetails($contact);
               
            
            }

           
                            
                                   
}
?>
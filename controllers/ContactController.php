<?php

class ContactController {
    
    /**
    * Cette fonction gère la page "contact"
    *
    * @return void
    */
    public static function getContact() : void{
        
        //gestion du formulaire de contact
        if(isset($_POST['contact'])) {
            if(isset($_POST["email"]) && !empty($_POST['email'])
                && isset($_POST['message']) && !empty($_POST['message'])) {
                    $email = $_POST['email'];
                    $message = $_POST['message'];
                   //envoi du mail 
                    require "mail/contactMail.phtml";
                    
                    $subject = "contact we_love_food";
                    $address = "baileche.theo@gmail.com";
                    
                
                    Mailer::sendMail($subject, $address, $msg);
                    
                    // renvoi vers la page "Confirmation de demande de contact"
                    header("Location: index.php?page=contact-success");
                    die;
                    
                }
        }
        
        $title = "Contact";
        
        Renderer::render("views/contact.phtml", [
            "title" => $title,
        ]);
    }


}
    
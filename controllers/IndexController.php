<?php

class IndexController {
    
    /**
    * Cette fonction gère l'affichage de la page "accueil"
    * elle liste toutes les recettes
    *
    * @return void
    */
    public static function getIndex() : void{
        
        //récupération de toutes les recettes
        $recipe = new Recipe ();
        $recipes = $recipe->getRecipes();
        
        $title = "Accueil";
        
        Renderer::render("views/home.phtml", [
            "title" => $title, "recipes" => $recipes
        ]);
    }
    
     /**
    * Cette fonction gère l'affichage de la page 'connexion obligatoire' 
    * si l'utilisateur veut accéder à un service où il doit être connecté
    * Elle redirige l'utilisateur sur la page "connexion/inscription" au bout de 5 secondes
    *
    * @return void
    */
     public static function mustBeConnected() : void {
        header("Refresh: 5; url=index.php?page=log");
        
        $title = "Connexion requise";
        
        Renderer::render("views/mustBeConnected.phtml", [
            "title" => $title, 
            "message" => "Vous devez être connecté pour accéder à ce service",
        ]);
    }
    
      /**
    * Cette fonction gère l'affichage de la page de confirmation de demande de contact
    * Elle redirige l'utilisateur sur la page "accueil" au bout de 5 secondes
    *
    * @return void
    */
     public static function getContactSuccess() : void {
        header("Refresh: 5; url=index.php?page=home");
        
        $title = "Demande de contact envoyée";
        
        Renderer::render("views/contactSuccess.phtml", [
            "title" => $title, 
            "message" => "Votre demande a été envoyée avec succès, nous vous répondrons dans les meilleurs délais",
        ]);
    }
    
    /**
    * Cette fonction permet de se déconnecter
    *
    * @return void
    */
    public static function getDisconnect() : void {
        session_destroy();
        
        header("Location:index.php?page=home");
        die;
    }
}
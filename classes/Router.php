<?php

class Router {
    
    /**
    * Cette fonction permet de diriger l'utilisateur vers les différentes pages
    * en fonction de l'url. Elle appelle différentes fonctions statiques des différents controlleurs
    *
    * @return void
    */
    public static function route(): void {
        if (isset($_GET['page'])) {
            
            
            //FRONT OFFICE--------------------------------------------------
            
            //home
            if($_GET['page'] === "home") {
                IndexController::getIndex();
            }
            
            //log
            if($_GET["page"] === "log") {
                UserController::getLog();
            }
            
            //ajouter une recette
            if($_GET['page'] === "add-recipe") {
                if(isset($_SESSION['id'])) {
                    UserController::getAddRecipe();
                } else {
                    IndexController::mustBeConnected();
                }
            }
            
            //modifier une recette
            if(isset($_SESSION['id'])) {
                if($_GET['page'] === "update-recipe") {
                    RecipeController::getUpdateRecipe();
                }
            } 
            
            //supprimer une recette
            if(isset($_SESSION['id'])) {
                if($_GET['page'] === "remove-recipe") {
                    RecipeController::removeRecipe();
                }
            }
            
            //commenter une recette
            if($_GET['page'] === "add-review") {
                if(isset($_SESSION['id'])) {
                    UserController::getAddReview();
                } else {
                    IndexController::mustBeConnected();
                }
            }
            
            //commentaires de recette
            if($_GET['page'] === "reviews") {
                ReviewsController::getReviews();
            }
            
            //contact
            if($_GET["page"] === "contact") {
                ContactController::getContact();
            }
            
            //contact-success
            if($_GET['page'] === "contact-success") {
                IndexController::getContactSuccess();
            }
            
            //déconnexion
            if($_GET['page'] === "disconnect") {
                IndexController::getDisconnect();
            }
            
            
            // BACK OFFICE ------------------------------------------------------
            
             // connexion/inscription (si l'utilisateur n'est pas connecté) ou espace personnel / espace administrateur (si l'utilisateur est connecté)
           
            
            // -----------------------------------------------------------------------------------------------------------

        } else {
            // Défaut
            IndexController::getIndex();
        }
    }
}

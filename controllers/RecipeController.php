<?php

class RecipeController {
    
     /**
    * Cette fonction gère l'affichage de la page "modifier la recette"
    * elle comprend un formulaire de mise à jour de la recette
    *
    * @return void
    */
    public static function getUpdateRecipe() : void{
        //récupération de la recette à modifier
        $recipe = new Recipe ();
        
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $recipeTarget = $recipe->getRecipeFromId ($id);
        
            //modification de la recette
            if(isset($_POST['updateRecipe'])) {
                $title = $_POST['title'];
                $description = $_POST['recipeDescription'];
                $recipeTarget->updateRecipe($title, $description, $id);
                header("location:index.php?page=update-recipe&id=$id");
                die;
            }
        }
        
        $title = "Accueil";
        
        Renderer::render("views/updateRecipe.phtml", [
            "title" => $title, "recipe" => $recipeTarget
        ]);
    }   
    
    /**
     * Cette fonction supprime une recette
     * 
     * @return void
     */
     public static function removeRecipe() {
         
         //récupération de la recette à supprimer
        $recipe = new Recipe ();
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            
            //suppression de la recette
            $recipe->removeRecipe($id);
            
            header("location:index.php?page=home");
            die;
             
         }
     }
}
<?php

class ReviewsController {
    
    /**
     * Cette fonction gère les commentaire sur les recettes
     * 
     * @return void
     */
     public static function getReviews () : void {
        $recipe = new Recipe ();
        //récupération de la recette
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $targetRecipe = $recipe->getRecipeFromId($id);
        
            //récupération des commentaires et du pseudo de l'auteur
            $review = new Review ();
            $reviews = $review->getReviews($id);
        } 
        
        $title = "Commentaires";
        Renderer::render("views/reviews.phtml", [
            "title" => $title, "recipe" => $targetRecipe, "reviews" => $reviews
        ]);
     }
}
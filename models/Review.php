<?php

class Review {
    
    use Sanitize; /*trait qui permet d'assainir les données issues des formulaires*/
    
    //ATTRIBUTS----------------------------------------------------------------
    
    private $id_review;
    private $review;
    private $evaluation;
    private $created_at;
    private $id_user;
    private $id_recipe;
    
    //ACCESSEURS (setters/getters)----------------------------------------------
    
    /**
    * @return integer
    */
    public function getId(): int {
        return $this->id_review;
    }
    
    /**
    * @param integer $id
    * @return void
    */
    public function setId(int $id):void {
        $this->id_review = $id;
    }
    
    /**
    * @return string
    */
    public function getReview(): string {
        return $this->review;
    }
    
    /**
    * @param string $review
    * @return void
    */
    public function setReview(string $review):void {
        $this->title = $review;
    }
    
    /**
    * @return int
    */
    public function getEvaluation(): int {
        return $this->evaluation;
    }
    
    /**
    * @param int $evaluation
    * @return void
    */
    public function setEvaluation(int $evaluation):void {
        $this->evaluation = $evaluation;
    }
    
     /**
    * @return string
    */
    public function getCreationDate(): string {
        return $this->created_at;
    }
    
    /**
    * @param string $creationDate
    * @return void
    */
    public function setCreationDate(string $creationDate):void {
        $this->created_at = $creationDate;
    }
    
    /**
    * @return int
    */
    public function getUserId(): int {
        return $this->id_user;
    }
    
    /**
    * @param int $userId
    * @return void
    */
    public function setUserId(int $userId):void {
        $this->id_user = $userId;
    }
    
    /**
    * @return int
    */
    public function getRecipeId(): int {
        return $this->id_recipe;
    }
    
    /**
    * @param int $recipeId
    * @return void
    */
    public function setRecipeId(int $recipeId):void {
        $this->id_recipe = $recipeId;
    }
    
    //accesseurs pour jointures
    
    
    /**
    * @return string
    */
    public function getPseudo(): string {
        return $this->pseudo;
    }
    
    /**
    * @param string $pseudo
    * @return void
    */
    public function setPseudo(string $pseudo) : void {
        $this->pseudo = $pseudo;
    }
    
    //METHODES-----------------------------------------------------------------
    
    /**
     * Cette fonction permet d'ajouter un commentaire
     * @param string $review
     * @param int $evaluation
     * @param int $idUser
     * @param int $idRecipe
     * @return void
     */
    public function addReview (string $review, int $evaluation, int $idRecipe, int $idUser) : void {

        $query = "
        INSERT INTO review (review, evaluation, created_at, id_user, id_recipe)
        VALUES (:review, :evaluation, NOW(), :id_user, :id_recipe)";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":review" => $this->sanitize(strtolower($review)),
            ":evaluation" => $this->sanitize($evaluation),
            ":id_recipe" => $this->sanitize($idRecipe),
            ":id_user" => $idUser,
        ]);
    }
    
    /**
     * Cette fonction récupère les commentaires liées à une recette
     * et récupère l'auteur du commentaire via une jointure
     * @param int $id
     * @return null|array
     */
     public function getReviews(int $id) : ?array {
        $query = "
        SELECT * FROM review
        INNER JOIN user ON review.id_user = user.id_user
        WHERE id_recipe = :id_recipe
        ORDER BY created_at DESC";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":id_recipe" => $this->sanitize($id)
        ]);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Review'); 
        $reviews = $sth->fetchAll();
        if($reviews) {
            return $reviews;
        } else {
            return null;
        }
         
     }
     
     /**
    * Cette fonction formate la date depuis année/mois/jour vers jour/mois/année
    *
    * @param string $date
    * @return string
    */
    public function formatTheDate (string $date): string {
        $timestamp = strtotime($date);
        return date("d/m/Y"."  à  "."H:i", $timestamp);
    }
}
<?php

class Recipe {
    
    use Sanitize; /*trait qui permet d'assainir les données issues des formulaires*/
    
    //ATTRIBUTS----------------------------------------------------------------
    
    private $id_recipe;
    private $title;
    private $description;
    private $id_user;
    
    //ACCESSEURS (setters/getters)----------------------------------------------
    
    /**
    * @return integer
    */
    public function getId(): int {
        return $this->id_recipe;
    }
    
    /**
    * @param integer $id
    * @return void
    */
    public function setId(int $id):void {
        $this->id_recipe = $id;
    }
    
    /**
    * @return string
    */
    public function getTitle(): string {
        return $this->title;
    }
    
    /**
    * @param string $title
    * @return void
    */
    public function setTitle(string $title):void {
        $this->title = $title;
    }
    
    /**
    * @return string
    */
    public function getDescription(): string {
        return $this->description;
    }
    
    /**
    * @param string $description
    * @return void
    */
    public function setDescription(string $description):void {
        $this->description = $description;
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
    
    //Accesseurs pour jointures
    
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
     * Cette fonction enregistre une recette dans la base de données
     * @param string $title
     * @param string $description
     * @return: void
     */
    public function saveRecipe (string $title, string $description, int $id) : void {
        $query = "
        INSERT INTO recipe (title, description, id_user)
        VALUES (:title, :description, :id_user)";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":title" => $this->sanitize(strtolower($title)),
            ":description" => $this->sanitize(strtolower($description)),
            ":id_user" => $id,
        ]);
   }
   
   /**
     * Cette fonction récupère les recettes de la base de données 
     * et l'auteur de la recette avec une jointure
     * @return: null|array
     */
    public function getRecipes () : ?array {
        $query = "
        SELECT * FROM recipe
        INNER JOIN user ON recipe.id_user = user.id_user
        ";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute();
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Recipe'); 
        $recipes = $sth->fetchAll();
        if($recipes) {
            return $recipes;
        } else {
            return null;
        }
   }
   
    /**
    * Cette fonction récupère une recette à partir de son Id depuis une requette GET
    * cela permet de la mettre à jour
    * @return: null|self
    */
    public function getRecipeFromId (int $id) : ?self {
        $query = "
        SELECT title, description FROM recipe
        WHERE id_recipe = :id_recipe
        ";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":id_recipe" => $this->sanitize($id)
        ]);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Recipe'); 
        $recipe = $sth->fetch();
        if($recipe) {
            return $recipe;
        } else {
            return null;
        }
   }
   
   /**
    * Cette fonction met à jour une recette
    * 
    * @param string $title
    * @param string $description
    * @param int $id
    * @return void
    */
    public function updateRecipe (string $title, string $description, int $id) : void {
        $query = "
        UPDATE recipe
        SET title = :title, description = :description
        WHERE id_recipe = :id_recipe";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":title" => $this->sanitize($title),
            ":description" => $this->sanitize($description),
            ":id_recipe" => $this->sanitize($id),
        ]);
    }
    
     /**
    * Cette fonction supprime une recette
    * 
    * @param int $id
    * @return void
    */
    public function removeRecipe (int $id) : void {
        $query = "
        DELETE FROM recipe
        WHERE id_recipe = :id_recipe";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":id_recipe" => $this->sanitize($id),
        ]);
    }
   
  
   
   
   
   
}
<?php

class UserController {
    
    /**
    * Cette fonction gère l'affichage de la page "connexion / inscription"
    *
    * @return void
    */
    public static function getLog() : void{
        $user = new User();
        //gestion du formulaire d'inscription
        if(isset($_POST['signup'])) {
            $pseudo = $_POST['pseudo'];
            $email = $_POST['email'];
            $pwd1 = $_POST ['pwd1'];
            $pwd2 = $_POST ['pwd2'];
            
            /*on vérifie si aucun utilisateur a déjà le même email, 
            ou que l'utilisateur n'est pas déjà inscrit avec l'email*/
            $userExists = $user->UserExistsFromEmail($email);
            if(!$userExists) {
                
                if($pwd1 === $pwd2) {
                
                    $user->saveUser($pseudo, $email, $pwd1);
                }
            
            }
        }
        
        //gestion du formulaire de connexion
        $loginScore = 0;
        if(isset($_POST["login"])) {
            $email = $_POST['email'];
            $password = $_POST['pwd1'];
            
            if(isset($email) && !empty($email) 
                && isset($password) && !empty($password)) {
                /*on vérifie qu'il existe bien cet email dans la base de données*/
                $userExists = $user->UserExistsFromEmail($email);
                if($userExists) {
                    //on récupère l'utilisateur dans la base de données
                    $userByEmail = $user->getUserByEmail($email);
                    //on vérifie que le mot de passe correspond à l'email
                    if($userByEmail->checkPassword($password)) {
                        
                        //on défini ensuite les variables de session
                        $_SESSION['id'] = $userByEmail->getId();
                        $_SESSION['pseudo'] = $userByEmail->getPseudo();
                        $_SESSION['email'] = $userByEmail->getEmail();
                        $_SESSION['admin'] = $userByEmail->getAdmin();
                        
                        header("location:index.php?page=home");
                    } $loginScore = 1;
                } $loginScore = 1;
            }
        }
        
        $title = "Connexion - Inscription";
        
        Renderer::render("views/log.phtml", [
            "title" => $title, "loginScore" => $loginScore,
        ]);
    }
    
     /**
    * Cette fonction gère la page "commenter une recette"
    *
    * @return void
    */
    public static function getAddReview () : void {
        
        $review = new Review ();
        
        //récupération de la recette à commenter
        if(isset($_GET['id'])) {
            $idRecipe = $_GET['id'];
        
            //gestion du formulaire d'ajout de commentaire
            if(isset($_POST['addReview'])) {
                if(isset($_POST['review']) && !empty($_POST['review'])
                    && isset($_POST['evaluation'])) {
                        $postReview = $_POST['review'];
                        $evaluation = $_POST['evaluation'];
                        
                        //enregistrement du commentaire
                        $review->addReview($postReview, $evaluation, $idRecipe, $_SESSION['id']);
                        
                        header("location:index.php?page=home");
                        die;
                    }
           }
        }
        
        
        $title = "Commenter une recette";
        Renderer::render("views/addReview.phtml", [
            "title" => $title
        ]);
    }
}
<?php

class User {
    
    use Sanitize; /*trait qui permet d'assainir les données issues des formulaires*/
    
    //ATTRIBUTS----------------------------------------------------------------
    
    private $id_user;
    private $pseudo;
    private $email;
    private $password;
    private $new_password;
    private $admin;
    
    //ACCESSEURS (setters/getters)----------------------------------------------
    
    /**
    * @return integer
    */
    public function getId(): int {
        return $this->id_user;
    }
    
    /**
    * @param integer $id
    * @return void
    */
    public function setId(int $id):void {
        $this->id_user = $id;
    }
    
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
    
    /**
    * @return string
    */
    public function getEmail(): string {
        return $this->email;
    }
    
    /**
    * @param string $email
    * @return void
    */
    public function setEmail(string $email) : void {
        $this->email = $email;
    }
    
    
    /**
    * @return string
    */
    public function getPassword(): string {
        return $this->password;
    }
    
    /**
    * @param string $password
    * @return void
    */
    public function setPassword(string $password) : void {
        $this->password = $password;
    }
    
    /**
    * @return integer
    */
    public function getNewPassword(): int {
        return $this->new_password;
    }
    
    /**
    * @param integer $new_password
    * @return void
    */
    public function setNewPassword(int $new_password) : void{
        $this->new_password = $new_password;
    }
    
    /**
    * @return boolean
    */
    public function getAdmin(): bool {
        return $this->admin;
    }
    
    /**
    * @param boolean $admin
    * @return void
    */
    public function setAdmin(bool $admin) : void{
        $this->admin = $admin;
    }
    
    //METHODES------------------------------------------------------------------
    
    //signup---------------------------------------------------------------
    
    /**
    * Cette fonction vérifie si un utilisateur à déjà le même email dans la base de données
    *
    * @param string $email
    * @return self|null
    */
    public function UserExistsFromEmail (string $email) : bool {
        $query = "
        SELECT email
        FROM user 
        WHERE email=:email";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":email" => $this->sanitize(strtolower($email))
        ]);
        $user = $sth->fetch();
        if($user) {
            return true;
        } else {
            return false;
        }
    }

    /**
    * Cette fonction vérifie enregistre un utilisateur dans la base de données
    *
    * @param string $pseudo
    * @param string $email
    * @param string $password
    * @return void
    */
    public function saveUser (string $pseudo, string $email, string $password) : void {
        $query = "
        INSERT INTO user (pseudo, email, password)
        VALUES (:pseudo, :email, :password)";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":pseudo" => $this->sanitize(strtolower($pseudo)),
            ":email" => $this->sanitize(strtolower($email)),
            ":password" => $this->sanitize(password_hash($password, PASSWORD_DEFAULT)),
        ]);
    }
    
    //login-----------------------------------------------------------------------
    
    /**
    * Cette fonction vérifie si le mot de passe saisi dans le formulaire de connexion
    * correspond au mot de passe de l'utilisateur enregistré dans la base de données
    *
    * @param string $pwd
    * @return boolean
    */
    public function checkPassword(string $pwd): bool {
        return password_verify($pwd, $this->getPassword());
    }
    
     /**
    * Cette fonction récupère un utilisateur à partir de son email
    *
    * @param string $email
    * @return self|null
    */
    public function getUserByEmail(string $email) : ?self {
        $query = "
        SELECT * 
        FROM user 
        WHERE email=:email";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":email" => $this->sanitize(strtolower($email))
        ]);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'User'); 
        $user = $sth->fetch();
        if($user) {
            return $user;
        } else {
            return null;
        }
    }




}
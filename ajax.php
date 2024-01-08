<?php

$pseudo = $_POST['pseudo'];
$email = $_POST['email'];
$pwd1 = $_POST['pwd1'];
$pwd2 = $_POST['pwd2'];

//on affiche un message d'erreur si la zone de saisi est vide
if(empty($pseudo) || empty($email) || empty($pwd1) || empty($pwd2)) {
    echo "<h4>remplir tous les champs</h4>";
}
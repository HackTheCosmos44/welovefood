//GESTION DU FORMULAIRE DE CONNEXION--------------------------------------

//récupération du formulaire de connexion
const loginForm = document.getElementById("login__form")

//récupération de l'input email
const emailInput = document.querySelector("#login") 
//récupération de l'info bulle pour l'email
let emailInfo = document.querySelector(".email__info")

//récupération de l'input password
const passInput = document.querySelector("#login__pass")
//récupération de l'info bulle pour le mot de passe
let passInfo = document.querySelector(".pass__info")

//si le formulaire de connexion est soumis on vérifie la validité des champs
loginForm.addEventListener("submit", checkLoginForm)


//fonction qui gère la validation du formulaire de connexion
function checkLoginForm (e) {
    
    //GESTION DE L'EMAIL---------------------------------------
    
    //si la valeur de l'email n'est pas renseignée
    if (emailInput.validity.valueMissing) {
        //on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        emailInfo.innerText = "veuillez renseigner votre email"
        emailInfo.classList.add("invalid");
        return
      
    //si l'email n'est pas valide
    } else if (!(/^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@[A-Za-z0-9.-]+$/.test(emailInput.value))) {
        // on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        emailInfo.innerText = "votre email n'a pas le bon format"
        emailInfo.classList.add("invalid");
        return
    // si tout va bien on cache l'info bulle
    } else {
        emailInfo.classList.remove("invalid")
    }
    
    
    
    //GESTION DU MOT DE PASSE----------------------------------
    
    //si la valeur du mot de passe n'est pas renseignée
    if (passInput.validity.valueMissing) {
        //on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        passInfo.innerText = "veuillez renseigner votre mot de passe"
        passInfo.classList.add("invalid");
        return
    } else {
        passInfo.classList.remove("invalid")
    }
   
}

// GESTION DU CAS OU L'UTILISATEUR REVIENS DANS UN INPUT POUR SAISIR QUELQUECHOSE

//si on revient pour saisir son email, l'info bulle disparait
emailInput.addEventListener("focus", () => {
    emailInfo.classList.remove("invalid")
})

//si on revient pour saisir son mot de passe, l'info bulle disparait
passInput.addEventListener("focus", () => {
    passInfo.classList.remove("invalid")
})



//GESION DE L'INFO BULLE SI LE MOT DE PASSE OU L'EMAIL NE CORRESPONDENT A ACUCUN COMPTE (générée via php)
// si l'info bulle existe
if(document.querySelector("#info__bulle__header__login__form")) {
    //on la récupère dans une variable
    const infoBulleHeaderLoginForm = document.querySelector("#info__bulle__header__login__form")

    //on la cache après un certain laps de temps
    setTimeout(() => {
        infoBulleHeaderLoginForm.classList.add("hide__info__bulle")
    },5000)
}

//FORMULAIRE D'INSCRIPTION AJAX----------------------------------------------------------------
$(document).ready(function() {
   
    $("#signupButton").click(function(event) {
        event.preventDefault()
        $.ajax({
            url:"ajax.php",
            method:"POST",
            data: $("#signupForm").serialize(),
            success: function(data) {
                $("#msg").html(data)
            }
        })
    })
})
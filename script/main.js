//HEADER-------------------------------------------------------------------

// Menu burger (version mobile et tablet)---------------------

    const nav = document.querySelector(".burgerNav__wrapper");
    const navClass = nav.classList;
    const burgerIcon = document.querySelector(".fa-bars");
    let burgerIconClass = burgerIcon.classList;
    
    // affiche/cache navigation, et anime l'icone du menu burger
    burgerIcon.addEventListener("click", () => {
        navClass.toggle("displayNav");
        burgerIconClass.toggle("fa-bars");
        burgerIconClass.toggle("fa-xmark")
    });
    
// //FORMULAIRES---------------------------------------------------------------------------

// Inputs de type password
// Affichage / masquage des mots de passe

    const eyeIcons = document.querySelectorAll(".eye__icon");
    const passwordInputs = document.querySelectorAll(".password__input");
    
      // change le type de l'input soit en "password", soit en "text"
    function changeType (input) {
        if (input.type === "password"){
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
    
     // change l'icone
    function changeIcon (icon) {
        let eyeIconClass = icon.classList;
        eyeIconClass.toggle("fa-eye");
        eyeIconClass.toggle("fa-eye-slash");
    }
    
    // script qui gère la visibilité des mots de passe    
    eyeIcons.forEach ((eyeIcon) => {
        eyeIcon.addEventListener("click", () => {
            changeIcon(eyeIcon);
            changeType(eyeIcon.previousSibling.previousSibling);
            
        })
    })
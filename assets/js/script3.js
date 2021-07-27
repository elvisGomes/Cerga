//@author Clément Broucke
$(document).ready(function(){
    //on crée 3 variables, 2 qui sont des inputs et 1 span vide au chargement de la page
    var newPassword = document.getElementById('newPassword');
        verifNewPassword = document.getElementById('verifNewPassword');
        verifPassword = document.getElementById('verifPassword');
        //on ajoute un evenenement keyup, cad au moment de la saisie, qui va vérifier si le newPassword et la verifNewPassword sont egales
    verifNewPassword.addEventListener('keyup', function(){
        //si elles sont egales on affiche dans verifPassword qu'elles sont egales
        if (newPassword.value == verifNewPassword.value){
            verifPassword.textContent = "Les 2 mots de passes sont égaux"
            verifPassword.style.color = "green"
        }
        //sinon on affiche qu'ils sont different
        else{
            verifPassword.textContent = "Les 2 mots de passes sont différents"
            verifPassword.style.color = "red"
        }
    });
});
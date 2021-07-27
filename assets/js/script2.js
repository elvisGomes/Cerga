//@author Clément Broucke / Mehdi Nasri
//on recupere le bouton , on y ajoute une eventListener, click qui déclenchera la fonction
var validation = document.getElementById('action');
validation.addEventListener('click', f_valid);
//on crée 4 variables qui prenne chacune un champ du form
var dateOn = document.getElementById('dateOn');
var entreeManquante = document.getElementById('entreeManquante');
var dateOff = document.getElementById('dateOff');
var sortieManquante = document.getElementById('sortieManquante');

//création de la fonction qui vérifie si une date d'ouverture a été rentré si c'est le cas, une date de fin est obligatoire, et vice versa
function f_valid(e){
//transformation de la valeur de la date de debut en format Date
var dateDebut = new Date(dateOn.value);
//ajout de 1 an a la date envoyer
dateDebut.setDate(dateDebut.getDate() + 395);
//transformation de la valeur de la date de fin  en format date
var dateFin = new Date(dateOff.value);
//on vérifie la condition
if(dateOn.value == "" && dateOff.value != "" ){
	//on empeche le comportement habituel du bouton(validation du form et envoie des données dans la bdd)
	e.preventDefault();
	//on écrit un message d'erreur dans la page si une des 2 dates est présente et l'autre manquante
	entreeManquante.textContent = "Date d'entrée manquante";
	entreeManquante.style.color ='red';
}
else if(dateOn.value != "" && dateOff.value == ""){
	e.preventDefault();
	sortieManquante.textContent = "Date de sortie manquante";
	sortieManquante.style.color ='red';
}
//condition pour savoir si la date de fin est supérieur a 1 an par rapport a la date de Debut
else if(dateFin > dateDebut){
	e.preventDefault();
	sortieManquante.textContent = "Date de fin supérieur a 1 an par rapport la date de debut";
	sortieManquante.style.color ='red';
}
else if(dateOn.value > dateOff.value){
	e.preventDefault();
	sortieManquante.textContent = "Date de sortie inférieur a la date d'entrée";
	sortieManquante.style.color ='red';
}
}
//fonction qui affiche les inputs des commentaires sociaux on prend la class item sur le click
$('.item').on('click',function(){
	//creation de 3 variables par rapport a l'ID
	var data = $(this).data('target');
	var input = document.getElementById(data);
	var inputComm = document.getElementById(data+'Comm');
	//On verifie si les input sont checked si oui on affiche l'input, sinon on affiche pas
	if(input.checked == true){
		inputComm.style.display = "block";
	}
	else{
		inputComm.style.display = "none";
	}
});
//fonction qui affiche les inputs au moment du chargement de la page
$(document).ready(function(){
	var item = document.getElementsByClassName('item');
	var input = document.getElementsByClassName('comm');
	var divTravail = document.getElementById("divTravail");
	var travail = document.getElementById('oui-allocataireTravail');
	var divAncienTravail = document.getElementById("divAncienTravail");
	var ancienTravail = document.getElementById('oui-dejaTravaile');

	
	if(travail.checked == true){
		divTravail.style.display="block";
	}

	if(ancienTravail.checked == true){
		divAncienTravail.style.display="block";
	}
	for(var i =0; i < item.length;i++){
		if(item[i].checked == true ){
			input[i].style.display = "block";
		}
	}

	
});

// fonction qui affiche les inputs quand on clique sur oui
var divTravail = document.getElementById("divTravail");

$('input:radio[name="allocataireTravail"]').change(
    function(){
		
        if ($(this).is(':checked') && $(this).val() == 'oui') {
        	divTravail.style.display = "block";
	}
	else{
		divTravail.style.display = "none";
	}
	});
	
	// fonction qui affiche les inputs quand on clique sur oui
	var divAncienTravail = document.getElementById("divAncienTravail");
	$('input:radio[name="dejaTravaile"]').change(
    function(){
		
        if ($(this).is(':checked') && $(this).val() == 'oui') {
        	divAncienTravail.style.display = "block";
	}
	else{
		divAncienTravail.style.display = "none";
	}
	});
//fonction de recherche du numero d'allocataire dans le bdd
$(document).ready(function(){
	var cafNumberInput = document.getElementById('cafNumber');
	var cafNumberVerif = document.getElementById('cafNumberVerif');
	
	
	cafNumberInput.addEventListener('blur', function(){
		console.log(cafNumberInput.value);
		$.get(
			'../controller/cafNumber.action.php?cafNumber='+cafNumberInput.value,
			function(data){
				if(data == "error"){
					cafNumberVerif.innerHTML = "Numéro d'allocataire déja existant";
					cafNumberVerif.style.color = "red";
				}
				if(data == "success"){
					cafNumberVerif.textContent = "Numéro d'allocataire disponible";
					cafNumberVerif.style.color = "green";
				}
				if(data == "errorLettre"){
					cafNumberVerif.textContent = "Format non valide";
					cafNumberVerif.style.color = "red";
				}
			}
		)
	});
});
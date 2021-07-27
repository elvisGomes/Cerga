function test() {
    var search = location.search;
    if(search=="?success=ajouterRapport"){
        $.ajax('../controller/suivis.action.php?chemin=suivis', {

            success: function(data) {
                alert('Le rapport a bien été ajouté');
                $('#content').load('../views/suivis.php', { infos: data });
                window.history.pushState({}, "Hide", "home.php");
            },
            error: function() {
                alert("L'appel na pas abouti!");
            }
        }); 
    }
    else if(search=="?success=editerRapport"){
        $.ajax('../controller/suivis.action.php?chemin=suivis', {

            success: function(data) {
                alert('Le rapport a bien été modifié');
                $('#content').load('../views/suivis.php', { infos: data });
                window.history.pushState({}, "Hide", "home.php");
            },
            error: function() {
                alert("L'appel na pas abouti!");
            }
        });
    }
    else if(search=="?success=ajouterPeriode"){
        $.ajax('../controller/suivis.action.php?chemin=periodeAccompagnement', {

            success: function(data) {
                alert("La période d'accompagnement a été ajoutée");
                $('#content').load('../views/periodeAccompagnement.php', { infos: data });
                window.history.pushState({}, "Hide", "home.php");
            },
            error: function() {
                alert("L'appel na pas abouti!");
            }
        });
    }
    else if(search=="?success=modifierPeriode"){
        $.ajax('../controller/suivis.action.php?chemin=periodeAccompagnement', {

            success: function(data) {
                alert("La période d'accompagnement a été modifiée");
                $('#content').load('../views/periodeAccompagnement.php', { infos: data });
                window.history.pushState({}, "Hide", "home.php");
            },
            error: function() {
                alert("L'appel na pas abouti!");
            }
        });
    }
    else if(search=="?success=ajoutAtelier"){
        $.ajax('../controller/suivis.action.php?chemin=listeAtelier', {

            success: function(data) {
                alert("L'atelier a bien été ajouté")
                $('#content').load('../views/listeAtelier.php', { infos: data });
                window.history.pushState({}, "Hide", "home.php");
            },
            error: function() {
                alert("L'appel na pas abouti!");
            }
        });
    }
    else if(search=="?success=editerAtelier"){
        $.ajax('../controller/suivis.action.php?chemin=listeAtelier', {

            success: function(data) {
                alert("L'atelier a bien été modifié")
                $('#content').load('../views/listeAtelier.php', { infos: data });
                window.history.pushState({}, "Hide", "home.php");
            },
            error: function() {
                alert("L'appel na pas abouti!");
            }
        });
    }
    else if(search=="?success=ajouterSituation"){
        $.ajax('../controller/suivis.action.php?chemin=listSituation', {

            success: function(data) {
                alert('La situation a bien été ajoutée')
                $('#content').load('../views/bilan.php', { infos: data });
                window.history.pushState({}, "Hide", "home.php");
            },
            error: function() {
                alert("L'appel na pas abouti!");
            }
        });
    }
    else if(search=="?success=modifierSituation"){
        $.ajax('../controller/suivis.action.php?chemin=listSituation', {

            success: function(data) {
                alert('La situation a bien été modifiée')
                $('#content').load('../views/bilan.php', { infos: data });
                window.history.pushState({}, "Hide", "home.php");
            },
            error: function() {
                alert("L'appel na pas abouti!");
            }
        });
    }
    else if(search=="?success=suppDoc"){
                alert('Le CV a bien été supprimé')
                $('#content').load('../views/document.php');
                window.history.pushState({}, "Hide", "home.php");
    }
    else if(search=="?fichier=success"){
        alert('Le CV a été ajouté avec succés')
        $('#content').load('../views/document.php');
        window.history.pushState({}, "Hide", "home.php");
    }
    else if(search=="?fichier=error"){
        alert("Erreur lors de l'envoi du CV");
        $('#content').load('../views/document.php');
        window.history.pushState({}, "Hide", "home.php");
    }
    else{
    $.ajax('../controller/detailPersonne.action.php', {
        
        success: function(data) {
            
            $('#content').load('../views/detailPersonne.php', { infos: data });
            window.history.pushState({}, "Hide", "home.php");
        },
        error: function() {
            alert("L'appel na pas abouti!");
        }
    });
}
}
//*****************************************************************************/
function init() {

    // Défini les variables de déclenchement et de conteneur
    var trigger = $(' a'), // le a est dans un li qui est dans un ul qui est dans un "nav", trigger prend le <a> contenue dans tout ça, il yen a deux
        container = $('#content'); // container est le nom de variable qui prend content, qui lui contient la page home.php
    console.log(trigger);

    // au click
    trigger.on('click', function() {
        console.log($(this));
        // Définie $this pour la réutilisation. Défini la cible à partir de l'attribut de données
        var $this = $(this),
            target = $this.data('target'); //recupere un atribut data (target c'est dans le <a>, ce qui porte le nom de la page)
        console.log(target);
        if (target == "DetailPersonne") {
            $.ajax('../controller/detailPersonne.action.php', {

                success: function(data) {
                    $('#content').load('../views/detailPersonne.php', { infos: data });
                    window.history.pushState({}, "Hide", "home.php");
                },
                error: function() {
                    alert("L'appel na pas abouti!");
                }
            });
        } else if (target == "suivis") {
            $.ajax('../controller/suivis.action.php?chemin=suivis', {

                success: function(data) {
                    $('#content').load('../views/suivis.php', { infos: data });
                },
                error: function() {
                    alert("L'appel na pas abouti!");
                }
            });
        }
        // Charge la page cible dans le conteneur
        else if (target == "listeAtelier") {
            $.ajax('../controller/suivis.action.php?chemin=listeAtelier', {

                success: function(data) {
                    $('#content').load('../views/listeAtelier.php', { infos: data });
                },
                error: function() {
                    alert("L'appel na pas abouti!");
                }
            });
        } 
        else if(target == "periodeAccompagnement")
        {
            $.ajax('../controller/suivis.action.php?chemin=periodeAccompagnement', {

                success: function(data) {
                    $('#content').load('../views/periodeAccompagnement.php', { infos: data });
                },
                error: function() {
                    alert("L'appel na pas abouti!");
                }
            });
        }
        else if(target == "bilan")
        {
            $.ajax('../controller/suivis.action.php?chemin=listSituation', {

                success: function(data) {
                    $('#content').load('../views/bilan.php', { infos: data });
                },
                error: function() {
                    alert("L'appel na pas abouti!");
                }
            });
        }
        else {
            container.load(target + '.php'); // load = chargement  
        }
    });
}
//*****************************************************************************/
$(".voir").click(function() { // ajax pour aller sur la page voir le rapport
    var cpt = $(this).data('cpt');
    var target = $(this).data('target');
    var fichier = $(this).data('fichier');
    $.ajax('../controller/suivis.action.php?chemin=' + target + '&cpt=' + cpt, {

        success: function(data) {
            $('#content').load('../views/resume' + fichier + '.php', { info: data });
        },
        error: function() {
            alert("L'appel na pas abouti!");
        }
    }); 
});
//*****************************************************************************/
$(".editer").click(function() { // ajax pour aller sur la page editer le rapport
    var cpt = $(this).data('cpt');
    var target = $(this).data('target');
    $.ajax('../controller/suivis.action.php?chemin=' + target + '&cpt=' + cpt, {
        success: function(data){
    $('#content').load('../views/modifier' + target + '.php?cpt=' + cpt,{ info: data });
        },
    });
});
//*****************************************************************************/
$("#ajoutRapport").click(function() { // ajax pour  aller sur la page ajouter un rapport

    $('#content').load('../views/entretien.php');
});

//*****************************************************************************
$("#formAccompagnement").click(function() { // ajax pour  aller sur la page ajouter une periode d'accompagnement

    $('#content').load('../views/formAccompagnement.php');
});
//*****************************************************************************/
$("#ajoutAtelier").click(function() { // ajax pour aller sur la page ajouter un atelier
    $('#content').load('../views/ajoutAtelier.php');
});
//*****************************************************************************/

//*****************************************************************************/
$(".modifierDetailPersonne").click(function() { // ajax pour aller sur la page ajouter un atelier
    $.ajax('../controller/detailPersonne.action.php', {

        success: function(data) {
            $('#content').load('../views/modifierDetailPersonne.php', { infos: data });
        },
        error: function() {
            alert("L'appel na pas abouti!");
        }
    });
});
//*****************************************************************************/

$(".modifierAccompagnement").click(function()
{// ajax pour aller sur la page periodeAccompagnement
    var cpt = $(this).data('cpt');
    var target = $(this).data('target');
    $('#content').load('../views/modifierPeriode' + target + '.php?cpt=' +cpt)
});
//********************************************************************* */

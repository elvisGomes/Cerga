

filedrag = document.getElementById('divTarget');
//Ajout des listeners
filedrag.addEventListener("dragover", fFileDragHover, false);
filedrag.addEventListener("dragleave", fFileDragHover, false);
filedrag.addEventListener("drop", fFileSelectHandler, false);


e.stopPropagation();
e.preventDefault();

//Récupération du ou des fichiers
var aFiles = e.target.files || e.dataTransfer.files;

// File drag hover : Changement du css de la zone cible

function fFileDragHover(e)
{
    e.stopPropagation();
    e.preventDefault();
    e.target.className = (e.type == "dragover" ? "filedrag filedragHover" : "filedrag");
    console.log('kdkdk');
}

function fFileSelectHandler(e) {

//Récupère l'id de la cible
idTarget = e.currentTarget.id;

// cancel event and hover styling
fFileDragHover(e);

// fetch FileList object
var files = e.target.files || e.dataTransfer.files;

// process all File objects
for (var i = 0, f; f = files[i]; i++) {
    UploadFile(f,idTarget);
}
}

function UploadFile(file,idTarget) {
    var xhr = new XMLHttpRequest();
    if (xhr.upload){
        //Fonctions supplémentaires

        // start upload
        xhr.open("POST", document.getElementById("upload_"+idTarget).action, true);
        xhr.setRequestHeader("X_FILENAME", file.name);
        xhr.send(file);
    }
}

if (xhr.upload){
//Si la taille du fichier dépasse la limte on affiche un message
if(file.size >= 2000000) {
    alert('La taille du fichier dépasse la limite de 2 Mo');
    return false;
}

//Contrôle sur l'extension du fichier
var _invalidFileExtensions = [".cfm", ".cfc", ".exe"];
var sFileName = file.name;
if (sFileName.length > 0) {
    var blnValid = false;
    for (var j = 0; j < _invalidFileExtensions.length; j++) {
        var sCurExtension = _invalidFileExtensions[j];
        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                blnValid = true;
                break;
        }
    }

    if (blnValid) {
            alert("Désolé, l'extension du fichier " + sFileName + " n'est pas valide");
            return false;
    }
    }
}

$( document ).ready(function() {
     $.ajax('../controller/notif.action.php?chemin=afficher',{
        success:function(data){
             $("#notifications").load('../views/rappel.php',{info:data});
             $("#cloche").load('../views/cloche.php',{info:data});
         }
     }); 
    
   
$('#notif').on('click',function(){
    $('#notifications').show();
});



});
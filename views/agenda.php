<html>
<head>
<meta charset='utf-8' />
<script src="../assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
<link rel="icon" type="image/png" href="../assets/images/afpaOnglet.png" />
<link href='../packages/core/main.css' rel='stylesheet' />
<link href='../packages/daygrid/main.css' rel='stylesheet' />
<link href='../packages/timegrid/main.css' rel='stylesheet' />
<link href="../assets/css/notif.css" rel="stylesheet">
<link href='../packages/list/main.css' rel='stylesheet' />
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<script src='../packages/core/main.js'></script>
<script src='../packages/core/locales-all.js'></script>
<script src='../packages/interaction/main.js'></script>
<script src='../packages/daygrid/main.js'></script>
<script src='../packages/timegrid/main.js'></script>
<script src='../packages/list/main.js'></script>
<script src='../packages/moment/main.js'></script>
<title>AFPA</title>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var ladate = new Date();
    var initialLocaleCode = 'fr';
    var localeSelectorEl = document.getElementById('locale-selector');
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'list' , 'dayGrid', 'timeGrid', 'moment'  ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listDay,listWeek'
      },
      views: {
        listDay: { buttonText: 'Liste de la journée' },
        listWeek: { buttonText: 'Liste de la semaine' }
      },
      
      defaultDate: Date.now(),
      locale: initialLocaleCode,
      navLinks: true, // can click day/week names to navigate views
      selectable: true,
      selectMirror: true,
      select: function(arg) {
        $('#myModal #start ').val(arg.start.toLocaleString());
        $('#myModal').modal('show');
        
        calendar.unselect()
      },
      editable: true,
      eventDrop:function(info)
    {
     var start = info.event.start.toISOString().slice(0,19);
     
     var title = info.event.title;
     var id = info.event.id;
     $.ajax({
      url:"../controller/agenda.action.php?agenda=update",
      type:"POST",
      data: 'title=' + title + '&start=' + start + '&id=' + id,
      success:function(){
        calendar.refetchEvents();
       alert('Evenement mis a jour');
      }
     })
    },
    eventClick:function(info)
    {
     if(confirm("Etes vous sur de vouloir supprimer l'évenement ?"))
     {
      var id = info.event.id;
      $.ajax({
       url:"../controller/agenda.action.php?agenda=supp",
       type:"POST",
       data:'id='+id,
       success:function()
       {
        calendar.refetchEvents();
        alert("Evenement supprimé");
       }
      })
     }
    },
      eventLimit: true, // allow "more" link when too many events
      events: "../controller/agenda.action.php?agenda=lecture",
     
    });

    calendar.render();
    
  
  });

</script>
<style>

  body {
    margin: 40px 10px;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar {
   
    max-width: 80%;
    margin: 0 auto;
  }

</style>
</head>
<body>
  <?php include 'nav.php'; ?>
  <div id ="notifications">
  
</div>
  <div style = "margin-top:20px;" id='calendar'></div>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background:;">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel" style="color:#43b29d;">Saisir l'évenement</h4>
      </div>
      <div class="modal-body">
      <form id="calendrier" method="POST" action="../controller/agenda.action.php?agenda=ajouter">
      <div class="form-group row">
      <label for="title" class="col-sm-2 col-form-label">Titre</label>
      <div class="col-sm-10">
        <input type="text" name="title" class="form-control" id="title" required placeholder="Titre de l'évenement">
    </div>
</div>
    <div class="form-group row">
      <label for="title" class="col-sm-2 col-form-label">Date</label>
      <div class="col-sm-10">
        <input type="text" name="start" class="form-control" id="start">
    </div>
</div>
    <button type="submit" class="btn btn-success" id="envoyer" style="">Enregistrer</button>
    <button type="button" class="btn" data-dismiss="modal" style="background:#e2793d;color:#FFF;">Fermer</button>
      </form>
      </div>
      <div class="modal-footer">
      
        
        
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
  
  <script src ="../assets/js/notif.js"></script>  
</body>
</html>
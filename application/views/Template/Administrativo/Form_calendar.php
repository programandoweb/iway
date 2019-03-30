<?php
 $m  = 'Administrativo';
 $decode= json_decode($this->$m->result);
 $row= $decode[0];
 //pre($this->uri->segment(4));
 $fechanow = new DateTime('now');
 //pre($fechanow);

?>
 
  <?php if($this->uri->segment(3)=='modificar'){ ?>
           
    <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Modificar</a>
           </li>
        <!-- <li class="nav-item">
             <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Ver</a>
          </li>-->
        <li class="nav-item">
              <a class="nav-link" style="cursor:pointer"  id="delected"  onclick="delected('<?php echo $this->uri->segment(4) ?>')" role="tab" aria-controls="contact" aria-selected="false">eliminar</a>
          </li>
      </ul>
    <?php } ?>
    
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
       
     </div>

<div class="container mt-4 tab-pane fade show active"  id="home" role="tabpanel" aria-labelledby="home-tab">
       <?php $hidden  = array('id' =>(isset($row->id))?$row->id:'',);
        echo form_open(current_url(),array('ajaxing' => 'true'),$hidden); ?>
      <div id="step-1" class="">
                <script>
                    $( function() {
                      $.datepicker.setDefaults($.datepicker.regional['es']);
                        $( ".datepicker" ).datepicker({changeMonth: true,changeYear: true,
                        dateFormat: "yy-mm-dd",
                        timeFormat:  "hh:mm:ss",
                        minDate: 0,defaultDate: "+1w",
		                    numberOfMonths: 1,});
                   
                      $( ".end" ).datepicker({changeMonth: true,changeYear: true,
                        dateFormat: "yy-mm-dd",
                        timeFormat:  "hh:mm:ss",
                        minDate: 0,defaultDate: "+1w",
		                   numberOfMonths: 1,
                    });
                  
                    $('#datetimepicker5').datetimepicker({
	            	         datepicker:false,
	                       format:'H:i:s',
	                         step:5
                    });
                    $('#datetimepicker6').datetimepicker({
	            	        datepicker:false,
	                       format:'H:i:s',
	                        step:5
                   });
                  });
                </script>
                <div class="container" style="margin-bottom:100px;">
                    <div class="row justify-content-md-center">
                          <div class="col-md-8"> 
                              <div class="row form-group">
                                    <div class="col-md-12">
                                          <label for="ciudad_expedicion">Titulo *</label>
                                          <?php echo set_input("title", @$row->title, $placeholder="Agregar titulo",$require=true,'',array("id"=>"title"));?>

                                     </div>
                               </div>
                               <div class="row form-group">
                                    <div class="col-md-4">
                                          <label for="ciudad_expedicion">Fecha *</label>
                                          <?php  
                                         if($this->uri->segment(3)=="fecha"){
                                           set_input("start",$this->uri->segment(4),$placeholder='AAAA-MM-DD',$require=true,"datepicker",array("id"=>"start"));
                                          } else{
                                         set_input("start",(isset($row->start))?$row->start:$fechanow->format('Y-m-d'),$placeholder='AAAA-MM-DD',$require=true,"datepicker",array("id"=>"start"));
                                          }
                                          ?>
                                      </div>
                                      <div class="col-md-2">
                                      <label for="regimen_empresa">Hora</label>  
                                      <input type="text" class="form-control col-md-12" name="hora" id="datetimepicker5" value="11:45:00" >
                                      </div>
                                     <div class="col-md-4">
                                          <label for="regimen_empresa">Fecha final*</label>  
                                              <?php  
                                        if($this->uri->segment(3)=="fecha"){
                                                set_input("end",$this->uri->segment(4),$placeholder='AAAA-MM-DD',$require=true,"end",array("id"=>"end"));
                                          } else{
                                                set_input("end",(isset($row->end))?$row->end:$fechanow->format('Y-m-d'),$placeholder='AAAA-MM-DD',$require=true,"end",array("id"=>"end"));
                                            }
                                            ?>
                                    </div>
                                    <div class="col-md-2">
                                          <label for="regimen_empresa">Hora</label>  
                                          <input type="text" class="form-control col-md-12" name="hora" id="datetimepicker6" value="11:45:00" >
                                    </div>
                               </div>
                               <!--<div class="row form-group">
                                    <div class="col-md-6">
                                      <label for="naturaleza">Color text *</label>  
                                      <input type="color"  id="colorText" value="#ffffff" >
                                      <input type="text"  id="color-text-input" style="margin-top:-10px;" class="form-control "  readonly >


                                     </div>
                                     <div class="col-md-6">
                                        <label for="naturaleza">color *</label>  
                                        <input type="color"  id="color" value="#414141" >
                                        <input type="text"  id="color-input" style="margin-top:-10px;" class="form-control "  readonly >
                                    </div>
                               </div>-->
                             <div class="row form-group">
                                  <div class="col-md-12">
                                    <label for="naturaleza">descripcion *</label>  
                                   <input type="text" id="descripcion" name="descripcion" value="<?php echo @$row->descripcion  ?>" class="form-control col-md-12" >
                                  </div>
                            </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                            <?php if($this->uri->segment(3)=='modificar'){ ?>
                              <button  id="modificar" disabled="disabled" onclick="update('<?php echo $this->uri->segment(4) ?>')" class="btn btn-primary">Modificar</button>
                              
                              <?php }  else {?>
                                <button  onclick="enviarcalendario()" class="btn btn-primary">Guardar</button>
                             <?php } ?>
                          
                            </div>
                        </div>
                      </div>
                    
                    </div>
                </div>

        </div><!--fin set-->
  
  
   </div>
<?php echo form_close();?>
<script>
$(document).ready(function() {
//console.log($('#color').val())
   $('#color-input').val($('#color').val())
   $('#color-text-input').val($('#colorText').val())
   $('#color').change(function() {
       $('#color-input').val($('#color').val())
  });
  $('#colorText').change(function() {
       $('#color-text-input').val($('#colorText').val())
  });
});
</script>



<?php if($this->uri->segment(3)=='modificar'){ ?>
  <script>
  var CLIENT_ID = '1072629157673-mpsvkmmim0ndf0c0fvi5k1pk0f4n5ge1.apps.googleusercontent.com';
  var API_KEY = 'AIzaSyDvJ0JIsbaDdofoTdn_OOW4uCM-gh3r_sg';

  var DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest"];

 
  var SCOPES = "https://www.googleapis.com/auth/calendar.events";

  function handleClientLoad() {
    gapi.load('client:auth2', initClient);
  }
  
  function initClient() {
      gapi.client.init({
      apiKey: API_KEY,
      clientId: CLIENT_ID,
      discoveryDocs: DISCOVERY_DOCS,
      scope: SCOPES
    }).then(function () {
       gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);
       updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
    
    }, function(error) {
      appendPre(JSON.stringify(error, null, 2));
    });
  }
function updateSigninStatus(isSignedIn) {
    if (isSignedIn) {
     listUpcomingEvents();
    } 
  }

function listUpcomingEvents() {
    gapi.client.calendar.events.list({
      'calendarId': 'primary',
      'showDeleted': false,
      'singleEvents': true,
      'orderBy': 'startTime'
    }).then(function(response) {
      var events = response.result.items;
    
      var datos=events;
      get ('<?php echo $this->uri->segment(4) ?>')
    });
   }
 
    function update(id){
      var start= $('#start').val()+'T'+$('#datetimepicker5').val()+'-'+'05:00';
      var end =  $('#end').val()+'T'+$('#datetimepicker6').val()+'-'+'05:00';  
      var title=  $('#title').val();
      var descripcion= $('#descripcion').val();
      var event = {
              'summary': title,
              'location': '800 Howard St., San Francisco, CA 94103',
               'description':descripcion,
               'start': {
              'dateTime': start,
               'timeZone': 'America/Bogota'
              },
             'end': {
               'dateTime': end,
                'timeZone': 'America/Bogota'
              },
            'recurrence': [
                'RRULE:FREQ=DAILY;COUNT=1'
                 ],
             'attendees': [
               {'email': 'arnaldolameda@hotmail.com', 'comment':'arnaldo lameda palencia'},
              ],

             'reminders': {
                 'useDefault': false,
                  'overrides': [
                  {'method': 'email', 'minutes': 24 * 60},
                  {'method': 'popup', 'minutes': 10}
                ]
              }
            };
         var request = gapi.client.calendar.events.update({
                 'calendarId': 'primary',
                    "eventId": id,
                   'resource': event
                  });

         request.execute(function(event) {
               //appendPre('Event created: ' + event.htmlLink);
           });
    }

    function delected(id){
        var request = gapi.client.calendar.events.delete({
             'calendarId': 'primary',
              "eventId":id,
            });
        request.execute(function(event) {
                parent.location.reload();
            });
    }

    function get(id){
        var request = gapi.client.calendar.events.get({
                      'calendarId': 'primary',
                       "eventId":id,
                     });
         request.execute(function(event) {
            console.log(event);
            if (event.start.dateTime!=undefined){
            var division = event.start.dateTime.split("T", 3);
            var division2 = event.end.dateTime.split("T", 3);
            var dision_hora= division[1].split("-");
            var dision_hora2= division2[1].split("-");
            $('#start').val(division[0]);
            $('#end').val(division2[0]);
            $('#descripcion').val(event.description);
            $('#datetimepicker6').val(dision_hora[0]);
            }else{
              $('#start').val(event.start.date); 
              $('#end').val(event.end.date); 
            }
            $('#title').val(event.summary);
            $('#descripcion').val(event.description);
            $("#modificar").removeAttr('disabled');
          });
        }
</script>
  
<script src="https://apis.google.com/js/api.js"
     onload="this.onload=function(){};handleClientLoad()"
     onreadystatechange="if (this.readyState === 'complete') this.onload()"> 
</script>

  <?php } ?>
  <style>
  .btn.btn-primary, .btn-primary.custom-file-control::before {
    color: white;
    background-color: #414141;
    border-color: #ccc;
    text-transform: none;
  }
  
  </style> 



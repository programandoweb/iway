 
 $(document).ready(function() {
   

 
//var datos={};
 var CLIENT_ID = '1072629157673-mpsvkmmim0ndf0c0fvi5k1pk0f4n5ge1.apps.googleusercontent.com';
 var API_KEY = 'AIzaSyDvJ0JIsbaDdofoTdn_OOW4uCM-gh3r_sg';

 // Array of API discovery doc URLs for APIs used by the quickstart
 var DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest"];

 // Authorization scopes required by the API; multiple scopes can be
 // included, separated by spaces.
 var SCOPES = "https://www.googleapis.com/auth/calendar.readonly";

 var authorizeButton = document.getElementById('authorize_button');
 var signoutButton = document.getElementById('signout_button');

 /**
  *  On load, called to load the auth2 library and API client library.
  */
 function handleClientLoad() {
   gapi.load('client:auth2', initClient);
 }

 /**
  *  Initializes the API client library and sets up sign-in state
  *  listeners.
  */
 function initClient() {
   gapi.client.init({
     apiKey: API_KEY,
     clientId: CLIENT_ID,
     discoveryDocs: DISCOVERY_DOCS,
     scope: SCOPES
   }).then(function () {
     // Listen for sign-in state changes.
     gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

     // Handle the initial sign-in state.
     updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
     authorizeButton.onclick = handleAuthClick;
     signoutButton.onclick = handleSignoutClick;
   }, function(error) {
     appendPre(JSON.stringify(error, null, 2));
   });
 }

 /**
  *  Called when the signed in status changes, to update the UI
  *  appropriately. After a sign-in, the API is called.
  */
 function updateSigninStatus(isSignedIn) {
   if (isSignedIn) {
     authorizeButton.style.display = 'none';
     signoutButton.style.display = 'block';
     listUpcomingEvents();
   } else {
     authorizeButton.style.display = 'block';
     signoutButton.style.display = 'none';
   }
 }

 /**
  *  Sign in the user upon button click.
  */
 function handleAuthClick(event) {
   gapi.auth2.getAuthInstance().signIn();
 }

 /**
  *  Sign out the user upon button click.
  */
 function handleSignoutClick(event) {
   gapi.auth2.getAuthInstance().signOut();
 }

 /**
  * Append a pre element to the body containing the given message
  * as its text node. Used to display the results of the API call.
  *
  * @param {string} message Text to be placed in pre element.
  */
 function appendPre(message) {
   var pre = document.getElementById('content');
   var textContent = document.createTextNode(message + '\n');
   pre.appendChild(textContent);
 }

 /**
  * Print the summary and start datetime/date of the next ten events in
  * the authorized user's calendar. If no events are found an
  * appropriate message is printed.
  */
 function listUpcomingEvents() {
   gapi.client.calendar.events.list({
     'calendarId': 'primary',
     //'timeMin': (new Date()).toISOString(),
     'showDeleted': false,
     'singleEvents': true,
     //'maxResults': 200,
     'orderBy': 'startTime'
   }).then(function(response) {
     var events = response.result.items;
     //appendPre('Upcoming events:');
     var datos=events;
    // console.log(datos);
     calendario(events);
       //console.log('event:',datos)

     if (events.length > 0) {
       for (i = 0; i < events.length; i++) {
         var event = events[i];
         var when = event.start.dateTime;
         if (!when) {
           when = event.start.date;
         }
        // appendPre(event.summary + ' (' + when + ')')
       }
     } else {
      // appendPre('No upcoming events found.');
     }
   });
 }


function calendario(calen){
 var json= new Array();
   //json[0].start='hola'
   console.log(calen);
 for (i = 0; i < calen.length; i++) {
   json[i] = {start: calen[i].start.dateTime, end: calen[i].end.dateTime, 
   id:calen[i].recurringEventId, title:calen[i].summary } ;
   //console.log(calen[i]['created']);
 }  
console.log("json",json);
var base = '<?php echo base_url("Administrativo/Add")?>';
$('#calendar').fullCalendar({

header:{
  left:'today,prev,next,  myCustomButton',
  center:'title',
  right:'month, basicWeek, basicDay,'
},
editable: true,
events:json,

customButtons: {
   myCustomButton: {
     text: 'crear',
     click: function() {
      // $('#exampleModal').modal();
      //$('#fecha').html(date.format());
      $('#editar').attr("href",base+'/Crear/').click()
     }
   }
 },

eventClick: function(calEvent, jsEvent, view) {
  console.log(calEvent);
 // $('#editar').attr("href",base+'/modificar/'+calEvent.id).click()
  //$('#id').html(calEvent.id);
  //$(this).css('border-color', 'red');

},

dayClick: function(date, jsEvent, view) {
 $('#editar').attr("href",base+'/fecha/'+'/'+date.format() ).click()
//$('#exampleModal').modal();
},
 /* googleCalendarApiKey: 'AIzaSyDvJ0JIsbaDdofoTdn_OOW4uCM-gh3r_sg',
   events: {
     googleCalendarId: '',
     //className: 'gcal-event' // an option!
   },*/
   locale: 'es',
});
}
 });
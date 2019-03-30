<script type="text/javascript">

  var CLIENT_ID = '1072629157673-mpsvkmmim0ndf0c0fvi5k1pk0f4n5ge1.apps.googleusercontent.com';
  var API_KEY = 'AIzaSyDvJ0JIsbaDdofoTdn_OOW4uCM-gh3r_sg';

   
  var DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest"];

  // Authorization scopes required by the API; multiple scopes can be
  // included, separated by spaces.
  var SCOPES = "https://www.googleapis.com/auth/calendar.events";

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
     // authorizeButton.onclick = handleAuthClick;
     // signoutButton.onclick = handleSignoutClick;
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
    
      listUpcomingEvents();
    } else {
      //authorizeButton.style.display = 'block';
     // signoutButton.style.display = 'none';
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
    //pre.appendChild(textContent);
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
      console.log('eventos:',datos);
   
    });
  }
 
 

 
 function enviarcalendario(){
   /*gapi.auth.authorize({
   client_id: '1072629157673-mpsvkmmim0ndf0c0fvi5k1pk0f4n5ge1.apps.googleusercontent.com',
    scope: 'https://www.googleapis.com/auth/calendar.readonly'
   });*/
    var start= $('#start').val()+'T'+$('#datetimepicker5').val()+'-'+'05:00';
    var end =  $('#end').val()+'T'+$('#datetimepicker6').val()+'-'+'05:00';
    var title=  $('#title').val();
    var descripcion= $('#descripcion').val();
   //console.log($('#start').val()+'T'+$('#datetimepicker5').val()+'-'+'05:00')
    var event = {
     'summary': title,
     'location': '800 Howard St., San Francisco, CA 94103',
     'description': descripcion,
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
      {'email': 'arnaldolameda@hotmail.com', 'comment':'pedro'},
    
    ],

  'reminders': {
      'useDefault': false,
      'overrides': [
        {'method': 'email', 'minutes': 24 * 60},
        {'method': 'popup', 'minutes': 10}
     ]
    }
  };

var request = gapi.client.calendar.events.insert({
'calendarId': 'primary',
'resource': event
});

request.execute(function(event) {

console.log('listo');
});

}


</script>

<script src="https://apis.google.com/js/api.js"

onload="this.onload=function(){};handleClientLoad()"
  onreadystatechange="if (this.readyState === 'complete') this.onload()"

  >
</script>

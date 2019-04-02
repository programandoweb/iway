$(document).ready(function(){  
  
  
  
  // Smart Wizard
  // Asistente inteligente
 
 
  var btnFinish = $('<button></button>').text('Guardar')
                                     .addClass('btn btn-info Guardar').click(function (r) {
                                     alert('dio click');
                           });
                                    
    /*var btnCancel = $('<button></button>').text('Cancel')
                                     .addClass('btn btn-danger cancelar')
                                     .on('click', function(){ $('#smartwizard').smartWizard("reset"); });*/
  	$('#smartwizard').smartWizard({
        //selected: 0,  // Initial selected step, 0 = first step 
        keyNavigation:false, // Habilitar / Deshabilitar la navegación con el teclado (las teclas izquierda y derecha se usan si están habilitadas)
        autoAdjustHeight: false, // Ajustar automáticamente la altura del contenido
        cycleSteps: false, // Permite alternar la navegación de los pasos
        backButtonSupport: true, // Habilitar la compatibilidad con el botón de retroceso
        useURLhash: true, // Habilitar la selección del paso basado en url hash
        lang: {// Variables de lenguaje
            next: 'Siguiente', 
            previous: 'Atras'
        },
        toolbarSettings: {
            toolbarPosition: 'bottom', // none, top, bottom, both
            toolbarButtonPosition: 'right', // left, right 
            showNextButton: true, // show/hide a Next button
            showPreviousButton: true, // show/hide a Previous button
            toolbarExtraButtons: [
	
	
                  ]
        }, 
        anchorSettings: {
            anchorClickable: true, // Enable/Disable anchor navigation
            enableAllAnchors: false, // Activates all anchors clickable all times
            markDoneStep: true, // add done css
            enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
        },            
        contentURL: null, // content url, Enables Ajax content loading. can set as data data-content-url on anchor
        disabledSteps: [],    // Array Steps disabled
        errorSteps: [],    // Highlight step with errors
        theme: 'circles',
        transitionEffect: 'fade', // Effect on navigation, none/slide/fade
        transitionSpeed: '400'
  	});
    
    
      $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection,stepPosition) {
        //alert("You are on step "+ stepDirection+" now");
        var valido= false
        var paramIndex = []
        var paramSelect = []
        var value = ""
        if(stepDirection === 'forward' ){
        if(stepNumber === 0){
        var inputs = $('#step-1').find('input')   
        var select = $('#step-1').find('select')
      inputs.each(function (index, val) {
        value= val
        paramIndex[index] = val.value
      })

      select.each(function (index, val) {
        paramSelect[index] = val.value
      })
      console.log(paramIndex);
      var found = paramIndex.find(function (element) {
        return element === ''
      })
      var foundSelect = paramSelect.find(function (element) {
        return element === ''
      })
      if(found===undefined  && foundSelect === undefined){
         return true
      }else{
        $("#text-alert").text("Debe completar todos los campos")
        $('#myModal').modal('show');
        return false
      }
      console.log(found)
      //console.log(paramIndex);
     //alert("You are on step "+stepNumber+" now");
       
       // btnCancel.remove() 
       }else if(stepNumber==1){
        var inputs = $('#step-2').find('input')
        var select = $('#step-2').find('select')   
     
      inputs.each(function (index, val) {
        value= val
        paramIndex[index] = val.value
      })
      select.each(function (index, val) {
        paramSelect[index] = val.value
      })
      console.log(paramIndex);
      var found = paramIndex.find(function (element) {
        return element === ''
      })
      var foundSelect = paramSelect.find(function (element) {
        return element === ''
      })
      if(found===undefined  && foundSelect === undefined){
         return true
      }else{
        $("#text-alert").text("Debe completar todos los campos")
        $('#myModal').modal('show'); // abrir
         return false
      }
       }
       }else if(stepDirection === 'backward'){
        return true;
       }  
    });
   
   
      // Step show event
    $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
      // alert("You are on step "+stepPosition+" now");
       $("guardar").css("display", "none");
       if(stepPosition === 'first'){
           $("#prev-btn").addClass('disabled');
           btnFinish.remove();
          // btnCancel.remove() 
       }else if(stepPosition==="middle"){
        btnFinish.remove();
        //btnCancel.remove(); 
       }else if(stepPosition === 'final'){
         $("#next-btn").addClass('disabled');
         console.log(  $('#step-3').find('input').length);
         if($('#step-3').find('input').length>0){
          $('.btn-toolbar').append(btnFinish)
          $(".Guardar").click(function(){
            var paramIndex = []
            var paramSelect = []
            var inputs = $('#step-3').find('input')
            var select = $('#step-3').find('select')   
            inputs.each(function (index, val) {
              value= val
              paramIndex[index] = val.value
            })
            select.each(function (index, val) {
              paramSelect[index] = val.value
            })
            var foundSelect = paramSelect.find(function (element) {
              return element === ''
            })
            console.log(paramIndex);
            var found = paramIndex.find(function (element) {
              return element === ''
            })
            if(found===undefined && foundSelect === undefined){
               return true
            }else{
              $("#text-alert").text("Debe completar todos los campos")
              $('#myModal').modal('show');
              return false
            }
           
          });
         }
          

        // $('.btn-toolbar').append(btnCancel)
           //$("guardar").addClass('disabled');
       }else{
           $("#prev-btn").removeClass('disabled');
           $("#next-btn").removeClass('disabled');
       }
    });

    // Toolbar extra buttons



    // Smart Wizard
    $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'default',
            transitionEffect:'fade',
            showStepURLhash: true,
            toolbarSettings: {toolbarPosition: 'both',
                              toolbarButtonPosition: 'end',
                              toolbarExtraButtons: [btnFinish]
                            }
    });


    // External Button Events
    $("#reset-btn").on("click", function() {
        // Reset wizard
        $('#smartwizard').smartWizard("reset");
        return true;
    });

    $("#prev-btn").on("click", function() {
        // Navigate previous
        $('#smartwizard').smartWizard("prev");
        return true;
    });

    $("#next-btn").on("click", function() {
        // Navigate next
        $('#smartwizard').smartWizard("next");
        return true;
    });

  var ident=  $('#tipo_identificacion').val();
  if(ident==6){
    $(".digito-verificacion").css("visibility", "visible");
  }else{
    $(".digito-verificacion").css("visibility", "hidden");
  }
  $( ".target" ).change(function() {
     var identificacion= $(this).val();
      // alert(identificacion);
     if (identificacion==6){
        $(".digito-verificacion").css("visibility", "visible");
      }else{
        $(".digito-verificacion").css("visibility", "hidden");
      }
    });

/*$( "#naturaleza" ).change(function(){
    var naturaleza= $(this).val();
     if(naturaleza=="PERSONA JURÍDICA"){
      $('#tipo_identificacion').val(6);
      $(".digito-verificacion").css("display", "block");
    }else{
      $('#tipo_identificacion').val('');
      $(".digito-verificacion").css("display", "none");
    }
 });*/
 jQuery.fn.SoloNumeros =
  function() {
    return this.each(function() {
      $(this).keydown(function(e) {
        var key = e.charCode || e.keyCode || 0;
        // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
        return (
          key == 8 ||
          key == 9 ||
          key == 46 ||
          (key >= 37 && key <= 40) ||
          (key >= 48 && key <= 57) ||
          (key >= 96 && key <= 105));
      });
    });
  };
  $('#identificacion').keyup(function(event) {
        //  console.log( $('#identificacion').val())
          var searchForNumbers = /^[0-9\-]+$/
          var search = (searchForNumbers.test($('#identificacion').val()))
          if (search) {
            $('#identificacion').val()
            CalcularDv();
          }else{
            $("#text-alert").text("Debe ser solo numeros")
            $("#myModal").modal("show");  
            $('#identificacion').val('') 
            $('#identificacion_ext').val('x');
          }
        }); 
    $('#email').change(function(event) {
     // console.log('funciono')
      var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i)
      var encontrar = pattern.test( $('#email').val())
      if (encontrar) {
        $('#email').val()
      }else{
        $("#text-alert").text("Introdusca un correo valido")
        $('#myModal').modal('show');
         $('#email').val('') 
      } 
    }); 
    $('#username').change(function(event) {
      //console.log($('#username').val())
      var url= $('#url').val()
      $.ajax({
        type: 'POST',
        url:url+'Usuarios/SearchUser',
        data:  $('#username').serialize(),
        success: function(resultado) {
          var obj = JSON.parse(resultado);
          if(obj['code']!='203'){
            $("#text-alert").text(obj['message'])
            $('#myModal').modal('show');
            $('#username').val('')
          }
       },error:function(resultado){
        
      }
        
      });//fin ajax
     
    }); 
    function CalcularDv(){ 
      var arreglo, x, y, z, i, nit1, dv1;
        nit1= $('#identificacion').val();
        arreglo = new Array(16); 
        x=0 ; y=0 ; z=nit1.length ;
        arreglo[1]=3;   arreglo[2]=7;   arreglo[3]=13; 
        arreglo[4]=17;  arreglo[5]=19;  arreglo[6]=23;
        arreglo[7]=29;  arreglo[8]=37;  arreglo[9]=41;
        arreglo[10]=43; arreglo[11]=47; arreglo[12]=53;  
        arreglo[13]=59; arreglo[14]=67; arreglo[15]=71;
      for(i=0 ; i<z ; i++)
        { 
         y=(nit1.substr(i,1));
         x+=(y*arreglo[z-i]);
        } 
      y=x%11
      if (y > 1){ dv1=11-y; } else { dv1=y; }
        $('#identificacion_ext').val(dv1);
        console.log(dv1);
    }

    $('#PrefijoDocumentos').keyup(function(event) {

      var mayuscula=$(this).val().toUpperCase() 
      $(this).val(mayuscula)
     // console.log($(this).val().toUpperCase() );
      
      });

      $( "#regimen_empresa" ).change(function() {
        var regimen= $(this).val();
        
        console.log(regimen);
         if(regimen=="Responsable de IVA (RC)"){
         $(".digito-verificacion").css("visibility", "visible");
      
        }else{
         $(".digito-verificacion").css("visibility", "hidden");
        }
     });
  }); 


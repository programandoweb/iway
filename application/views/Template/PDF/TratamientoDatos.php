<?php

$this->load->helper('numeros');
setlocale(LC_ALL,"es_ES.UTF-8");
@$fecha_creacion = new DateTime($user->fecha_creacion);
@$fecha= $fecha_creacion->format('d-m-Y H:i:s' );
//pre($this->user	);
if (@$user->fecha_creacion='0000-00-00 00:00:00'){
   @$creacion_fecha= strftime("%A %d de ").ucwords(strftime("%B")).'&nbsp;'.'del'.'&nbsp;'.date("Y");
} else {
    @$creacion_fecha= fechaCastellano ($fecha);
}
$host= $_SERVER["HTTP_HOST"];// Devuelve o
$url= $_SERVER["REQUEST_URI"];
$porciones = explode("/", $url);
?>
  <table class="ancho cabecera" border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
          <td width="30%" colspan="2">
              <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px; height:90px;" />
          </td>
          <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top" colspan="15">
              <?php echo $empresa->nombre_legal?><br/>
              Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
              <?php echo $empresa->direccion;?><br />               
              PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
              <?php echo $empresa->website;?><br/>
              <?php #pre($empresa); ?>
          </td>
      </tr>
  </table>
  <div class="footer pie_de_pagina" style="border-top: 1px solid black;">
      <table>
          <tr>
              <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
              <td style="text-align: center;font-size: 9px;"></td>
              <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
          </tr>
      </table>
  </div> 
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:12px; font-size:10px; text-align:center;font-family:font-family: 'Montserrat', sans-serif;margin-top: -10px; ">
    <div style="font-size:10px;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td style="text-align:center; ">
                    Autorización para el uso, recolección y tratamiento de datos personales<br> <b><?php echo $empresa->nombre_legal?></b>
                </td>        
            </tr>
        </table>
        
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:8px;">
            <tr>
                <td style="text-align:justify; font-size:12px;">
                    Hoy, <b><?php echo  $creacion_fecha;?>, </b><b><?php print_r( nombre($user));?></b> en adelante
                    el (la) titular de la información, autoriza para qué, de conformidad con lo dispuesto en la Ley Estatutaria 1581 de 2012, 
                    los datos personales que se obtengan  a través de los vínculos 
                    contractuales celebrados entre <b><?php echo $empresa->nombre_legal?></b>; 
                    (de ahora en adelante <b><?php echo $empresa->nombre_comercial?></b>) y el (la) titular de la información, sean compilados, almacenados, consultados, 
                    usados, compartidos, intercambiados, transmitidos, transferidos y objeto de tratamiento en bases de datos, 
                    los cuales estarán destinados a las siguientes finalidades: a) mantener una eficiente comunicación de la 
                    información que sea de utilidad en los vínculos contractuales en los que sea parte el (la) titular de la información, b) dar cumplimiento de las obligaciones contraídas por 
                    <b><?php echo $empresa->nombre_comercial?></b> con el (la) titular de la información, 
                    con relación a pagos por cualquier tipo de concepto, establecido en cualquier 
                    tipo de contrato de índole comercial, civil o laboral, c) informar las modificaciones que se presenten en 
                    desarrollo de cualquier tipo de contrato comercial, civil o laboral a el (la) titular de la información, d) evaluar la calidad de los servicios ofrecidos 
                    por el (la) titular de la información, 
                    e) realizar estudios internos sobre los hábitos de el (la) titular de la información para programas de bienestar corporativo, f) 
                    realizar los descuentos de dinero autorizados por   titular de la información,
                    g) autorizar de manera irrevocable y por un periodo de hasta diez (10) años desde la fecha del presente documento, 
                    publicar en la base de datos del aplicativo Webcamplus&reg; en su página www.webcamplus.com.co, su estado actual, desempeño, 
                    nombre y número de contacto del administrador de la sede principal y/o 
                    sucursal de <b><?php echo $empresa->nombre_comercial?></b>, para que otras 
                    empresas del campo del entretenimiento para adultos y/o socios del aplicativo puedan saber el estado real, 
                    desempeño y demás aspectos considerados dentro del marco de referencia comercial.
                </td>        
            </tr>
        </table>
        
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:8px;">
            <tr>
                <td style="text-align:justify; ">
                    <b>Datos sensibles</b>: El (la) titular de la información manifiesta que conoce, acepta y autoriza de manera libre y espontánea el tratamiento de la 
                    información relativa a: organizaciones sociales, salud, vida sexual y datos biométricos, así como cuanta informacíon 
                    sea necesaria para el cumplimiento de la finalidad anteriormente descritas basado en lo establecido en la presente 
                    autorización. <br><br>
                    </b> De conformidad con lo dispuesto en la Ley Estatutaria 1581 de 2012, 
                    los datos personales que obtenga <b><?php echo $empresa->nombre_comercial?></b> por parte de el (la) titular de la información, serán recogidos y almacenados y objeto de tratamiento 
                    en bases de datos hasta la terminación del vínculo contractual entre el (la) titular de la información y <b><?php echo $empresa->nombre_comercial?></b> y cinco (5) años más.<br><br>
                    Esta base de datos cuenta con las medidas de seguridad necesarias para la conservación adecuada de los datos personales, 
                    con la aceptación de la presente autorización, se permite el tratamiento de sus datos personales 
                    para las finalidades mencionadas y reconoce que los datos suministrados a <b><?php echo $empresa->nombre_comercial?></b> son ciertos, 
                    dejando por sentado que no se ha omitido o adulterado ninguna información. 
                    se deja constancia que usted tiene el derecho de acceder en cualquier momento a los datos suministrados, 
                    a solicitar su corrección, actualización o supresión en los términos establecidos en la ley estatutaria 1581 de 2012, 
                    mediante escrito dirigido a <b><?php echo $empresa->nombre_comercial?></b> indicando las razones por las cuales solicita alguno de los 
                    tramites anteriormente mencionados, con el fin que <b><?php echo $empresa->nombre_comercial?></b> pueda revisarlas y pronunciarse sobre las mismas.
                </td>        
            </tr>
        </table>
        <div style="height:8px;"></div>
        <div style="text-align:left; text-align:justify; ">
            En señal de conocimiento, aceptación y autorización y como certificación que igualmente he leído 
            la política de servicio (política de protección de datos personales y privacidad), publicada en <span><?php  echo 'https://'.$host.'/'.$porciones[1].'/Politicas/MostrarPoliticas';?></span> 
             procedo a firmar el presente documento, el cual ha sido elaborado por <strong><?php echo nombre(centrodecostos($user->id_responsable));?>.</strong>
        </div>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr  style="height:200px;">
                <td style="text-align:left;"></td>        
            </tr>
            <tr>
              <td width="150">
                <div style="height:83px"></div>
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr  >  
                        <td style="text-align:left;">
                            <!--div style="border-bottom:solid 3px #000; width:500px;"></div-->
                          
                            <div style="width:500px; text-align:left; " class="border-top">
                               
                                Firma Titular de la información o Representante Legal.<br />C.C. <?php echo $user->identificacion; ?><br />Dirección de notificación: 
                            </div>
                        </td>        
                    </tr>
                </table>
              </td>
              <td>
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <div style="height:90px; width:80px;border:solid 1px #333; text-align:center; position:relative;">
                                <div style="padding-top:100px;">
                                    Huella
                                </div>
                            </div>            
                        </td>        
                    </tr>
                </table>
              </td>
            </tr>
          </table>
    </div>
</div>
<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$this->load->helper('numeros');
setlocale(LC_ALL,"es_ES.UTF-8");
?>
<?php #pre($user);?>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; text-align:center;font-family:font-family: 'Montserrat', sans-serif; ">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="30%">
                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
            </td>
            <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top">
                <?php echo $empresa->nombre_legal?><br />
                <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
                <?php  echo $centrodecostos->direccion; ?><br />
                PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
                <?php echo $empresa->website;?><br />

            </td>
        </tr>
    </table>
    <div style="font-size:12px;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:20px;">
        <tr>
            <td style="text-align:center; ">
                Autorización para el uso, recolección y tratamiento de datos personales<br> <b><?php echo $empresa->nombre_legal?></b>
            </td>        
        </tr>
    </table>
    
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:20px;">
        <tr>
            <td style="text-align:justify; font-size:12px;">
                Hoy, <b><?php echo strftime("%A %d de %B del %Y",strtotime($user->fecha_contratacion));?></b>, <b><?php print_r( nombre($user));?></b>,
                autoriza para qué, de conformidad con lo dispuesto en la Ley Estatutaria 1581 de 2012, 
                los datos personales que se obtengan por parte del titular de la Información a través de los vínculos 
                contractuales celebrados entre <b><?php echo $empresa->nombre_legal?></b>; 
                (de ahora en adelante <b><?php echo $empresa->nombre_comercial?></b>) y el titular de la información, sean compilados, almacenados, consultados, 
                usados, compartidos, intercambiados, transmitidos, transferidos y objeto de tratamiento en bases de datos, 
                las cuales estarán destinadas a las siguientes finalidades: a) mantener una eficiente comunicación de la 
                información que sea de utilidad en los vínculos contractuales en los que sea parte el entrevistado, contratista, proveedor 
                y/o empleado titular de la información, b) dar cumplimiento de las obligaciones contraídas por 
                <b><?php echo $empresa->nombre_comercial?></b> con el entrevistado, contratista, proveedor y/o empleado titular de la información, 
                con relación a pago de honorarios, salarios, pactos comerciales, prestaciones sociales y demás consagradas en cualquier 
                tipo de contrato de índole comercial, civil o laboral, c) informar las modificaciones que se presenten en 
                desarrollo del cualquier tipo de contrato de comercial, civil o laboral al entrevistado, contratista, 
                proveedor y/o empleado titular de la información, d) evaluar la calidad de los servicios ofrecidos 
                por el entrevistado, contratista, proveedor y/o empleado titular de la información, 
                e) realizar estudios internos sobre los hábitos del entrevistado, contratista, proveedor y/o 
                empleado titular de la información para programas de bienestar corporativo, f) 
                realizar los descuentos de dinero autorizados por el entrevistado, contratista, proveedor y/o empleado  titular de la información,
                g) autorizar de manera irrevocable y por un periodo de diez (10) años desde la fecha del presente documento, 
                publicar en la base de datos del aplicativo Webcamplus&reg; en su página www.webcamplus.com.co, mi estado actual, desempeño, 
                nombre y número de contacto del administrador de la sede principal y/o 
                sucursal de <b><?php echo $empresa->nombre_comercial?></b>, para que otras 
                empresas del campo del entretenimiento para adultos y/o socios del aplicativo puedan saber mi estado real, 
                desempeño y demás aspectos considerados dentro del marco de referencia comercial.
            </td>        
        </tr>
    </table>
    
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:20px;">
        <tr>
            <td style="text-align:justify; ">
                <b>Datos sensibles</b>: El entrevistado, contratista, proveedor y/o empleado titular de la información o representante 
                legal manifiesta que conoce, acepta y autoriza de manera libre y espontánea que el tratamiento de la 
                información relativa a: pertenencia a sindicatos, organizaciones sociales, salud, vida sexual y datos biométricos, 
                que sea necesaria para el cumplimiento de la finalidad anteriormente descritas basado en lo establecido en la presente 
                autorización. <br><br>
                </b> De conformidad con lo dispuesto en la Ley Estatutaria 1581 de 2012, 
                los datos personales que obtenga <b><?php echo $empresa->nombre_comercial?></b> por parte del entrevistado, contratista, proveedor y/o 
                empleado titular de la información o representante legal, serán recogidos y almacenados y objeto de tratamiento 
                en bases de datos hasta la terminación del vínculo contractual entre el entrevistado, contratista, proveedor y/o 
                empleado titular de la información y <b><?php echo $empresa->nombre_comercial?></b> y durante cinco (5) años más.<br><br>
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
    
    
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:20px;">
        <tr>
            <td style="text-align:left;" width="60%" valign="top">
                En señal de conocimiento, aceptación y autorización, 
            </td>
            <td>
                <div style="height:70px; width:80px;border:solid 1px #333; text-align:center; position:relative;">
                    <div style="padding-top:80px;">
                        Huella
                    </div>
                </div>            
            </td>        
        </tr>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="text-align:left;">
                <!--div style="border-bottom:solid 3px #000; width:500px;"></div-->
                <div style="width:500px; text-align:left;">
                    Firma Titular de la información o Representante Legal.<br />C.C.<br />Dirección de notificación: 
                </div>
            </td>        
        </tr>
    </table>
</div>
</div>
<div class="footer" style="position: absolute; bottom:10px; width: 100%">
    <table>
        <tr>
            <td style="width:33%; text-align: left;">Fecha generacion documento <?php echo date("Y-m-d");?></td>
            <td style="text-align: center;">Página <?php echo "1/1"; ?></td>
            <td style="width:33%; text-align: right;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
    </table>
</div> 
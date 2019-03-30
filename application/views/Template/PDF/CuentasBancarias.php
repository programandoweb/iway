 <?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.net
*/
$modulo           = $this->ModuloActivo;
$OpcionesFactura    =   getOpcionesFactura($empresa->user_id);
$prefijo = centrodecostos($this->user->centro_de_costos)->abreviacion;
$cuenta =  $this->$modulo->result;
?>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:10px; font-family:font-family: 'Montserrat', sans-serif;text-align: justify;margin-top: -20px;">
	<h3><b><?php echo $empresa->ciudad.' '.substr($cuenta[0]->fecha_creacion,0,11).'<br>Actualizacion '.ceros($cuenta[0]->consecutivo_id);  ?></b></h3>
	
	<div style="height: 40px;"></div>
	
	<p>Señores:<br>
	<b><?php echo $empresa->nombre_legal; ?></b><br>
	<b><?php echo $empresa->nombre_representante_legal; ?></b><br>
	<b>Representante Legal</b>,<br>
	<b><?php echo $empresa->ciudad; ?> <?php echo $empresa->pais; ?></b></p>

	<div style="height: 40px;"></div>

	<p>Referencia: <b>AUTORIZACIÓN DE CONSIGNACIÓN DE DINEROS ADEUDADOS POR CONCEPTO DE HONORARIOS, UTILIDADES SOBRE CUENTAS EN PARTICIPACIÓN, PRESTACIÓN DE SERVICIOS, OTROS INGRESOS Y/O NÓMINAS.</b></p> 
	<p style="height: 20px;"></p>
	<p>Por la presente, yo <b><?php print(@$cuenta[0]->primer_nombre.' '.@$cuenta[0]->segundo_nombre.' '.@$cuenta[0]->primer_apellido.' '.@$cuenta[0]->segundo_apellido);?></b>, identificado(a) con <b><?php echo $cuenta[0]->tipo_identificacion; ?></b> número <b><?php echo format($cuenta[0]->identificacion,false); ?></b>, expedida en la ciudad de <b><?php echo $cuenta[0]->lugar_expedicion_documento_identidad; ?></b>, me permito autorizar de manera irrevocable la consignación de los diversos dineros adeudados por <b>concepto de honorarios, utilidades sobre cuentas en participación, prestación de servicios, otros ingresos y/o nóminas</b>, a la(el) <b><?php echo $cuenta[0]->tipo_cuenta;  ?></b> número <b><?php echo $cuenta[0]->nro_cuenta; ?></b> del banco <b><?php echo $cuenta[0]->entidad_bancaria; ?></b></p>
	<p style="height: 10px;"></p>

	<p>Certifico que ante cualquier novedad informaré por escrito con plena anticipación a <b><?php echo $empresa->nombre_legal; ?></b></p>
	<p style="height: 10px;"></p>
	<p>Igualmente entiendo y acepto que desde el momento de consignación de los valores adeudados se dará por entendido que estos han sido cancelados en su totalidad, por lo que libro desde ahora y en adelante de cualquier responsabilidad a <b><?php echo $empresa->nombre_legal; ?></b>, ante la presentación de algún inconveniente como embargo, cancelación de la cuenta, cruce de pagos de otros productos de parte de la entidad bancaria o demás que sean ajenos o imputables a <b><?php echo $empresa->nombre_legal; ?></b>.</p>
	<p style="height: 10px;"></p>

	<p>Para constancia de aceptación, firmo en la ciudad de <b><?php echo $empresa->ciudad; ?></b> el día <b><?php echo Date('d'); ?></b> del mes de <?php echo mes(intval(Date('m'))); ?> del año <b><?php echo Date('Y'); ?></b></p>
	<div style="height: 40px;"></div>

	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td>Cordialmente,</td>
			<td></td>
			<td></td>
		</tr>
	    <tr>
	        <td style="height:60px;"></td>
	        <td></td>
	        <td class="borderleft2 borderight2 bordetop2"></td>
	    </tr>
	    <tr>
	        <td width="60%" class="bordetop2"><b><?php print(@$cuenta[0]->primer_nombre.' '.@$cuenta[0]->segundo_nombre.' '.@$cuenta[0]->primer_apellido.' '.@$cuenta[0]->segundo_apellido);?></b></td>
	        <td width="10%"></td>
	        <td width="30%" class="borderleft2 borderight2"></td>
	    </tr>
	    <tr>
	        <td><?php echo ucwords(mb_strtolower ($cuenta[0]->tipo_identificacion)).' No '?><b><?php echo format($cuenta[0]->identificacion,false); ?></b></td>
	        <td></td>
	        <td class="borderleft2 borderight2"></td>
	    </tr>
	    <tr>
	        <td>Expedida en <b><?php echo $cuenta[0]->lugar_expedicion_documento_identidad; ?></b></td>
	        <td></td>
	        <td class="borderleft2 borderight2"></td>
	    </tr>
	    <tr>
	        <td>Dirección <b><?php echo $cuenta[0]->direccion; ?></b></td>
	        <td></td>
	        <td class="borderleft2 borderight2 bordeBottom2"></td>
	    </tr>
	</table>
</div>

 <?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.net
*/
$modulo             = $this->ModuloActivo;
$OpcionesFactura    =   getOpcionesFactura($empresa->user_id);
$prefijo = centrodecostos($this->user->centro_de_costos)->abreviacion;
$cuenta  =  $this->$modulo->result;
$json    =  json_decode($this->$modulo->result[0]->cambio_cuentas_bancarias);
$n = count($json);
$nueva_Cuenta    = (json_decode($json[($n-1)]));
if($n >= 2){
	$Anterior = $n-2; 
}
$cuenta_Anterior = (json_decode($json[$Anterior]));
?>

<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:10px; font-family:font-family: 'Montserrat', sans-serif;text-align: justify;">
	<h3><b><?php echo $empresa->ciudad.' '.$cuenta[0]->fecha_creacion.' Consecutivo-'.ceros($nueva_Cuenta->consecutivo);  ?></b></h3>
	
	<div style="height: 40px;"></div>
	
	<p>Señores:<br>
	<b><?php echo $empresa->nombre_legal; ?></b><br>
	<b><?php echo $empresa->nombre_representante_legal; ?></b><br>
	REPRESENTANTE LEGAL,<br>
	<b><?php echo $empresa->ciudad; ?></b></p>

	<div style="height: 40px;"></div>

	<p>Referencia: 
		<b> 
			PRESENTACIÓN  DE  NOVEDAD  DE  ACTUALIZACIÓN  A  LA  AUTORIZACIÓN  DE  CONSIGNACIÓN  DE  DINEROS  
			ADEUDADOS  POR  CONCEPTO  DE  HONORARIOS,  UTILIDADES  SOBRE  CUENTAS  EN  PARTICIPACIÓN,  PRESTACIÓN  DE  
			SERVICIOS, OTROS INGRESOS Y/O NÓMINAS NÚMERO <?php echo ceros($nueva_Cuenta->consecutivo); ?>.
		</b>
	</p> 

	<p>Por la presente, yo <b><?php print(@$cuenta[0]->primer_nombre.' '.@$cuenta[0]->segundo_nombre.' '.@$cuenta[0]->primer_apellido.' '.@$cuenta[0]->segundo_apellido);?></b>, identificado(a) con <b><?php echo @$cuenta[0]->tipo_identificacion; ?></b> número <b><?php echo $cuenta[0]->identificacion; ?></b>, expedida en la ciudad de <b><?php echo $cuenta[0]->lugar_expedicion_documento_identidad; ?></b>, me permito autorizar de manera irrevocable la consignación de los diversos dineros adeudos <b>por concepto de honorarios, utilidades sobre cuentas en participación, prestación de servicios, otros ingresos y/o nóminas</b>, a la cuenta de (<b><?php echo $cuenta[0]->tipo_cuenta; ?></b>) número <b><?php echo $cuenta[0]->nro_cuenta; ?></b> del banco <b><?php echo $cuenta[0]->entidad_bancaria; ?></b> y no a la anterior cuenta de (<b><?php echo $cuenta_Anterior->tipo_cuenta; ?></b>) número <b><?php echo $cuenta_Anterior->nro_cuenta; ?></b> del banco <b><?php echo entidadbancaria($cuenta_Anterior->entidad_bancaria); ?></b> la cuál había autorizado mediante consecutivo número <b><?php echo ceros(@$cuenta_Anterior->consecutivo); ?></b></p>

	<p>Certifico que ante cualquier novedad informaré por escrito con plena anticipación a <b><?php echo $empresa->nombre_legal; ?></b></p>
	<p>Igualmente entiendo y acepto que desde el momento de consignación de los valores adeudados se dará por entendido que los valores adeudados han sido cancelados en su totalidad, por lo que libro de cualquier responsabilidad a <b><?php echo $empresa->nombre_legal; ?></b>, ante la presentación de algún inconveniente como embargo, cancelación de la cuenta, cruce de pagos de otros productos de la entidad bancaria o demás que sean ajemos a <b><?php echo $empresa->nombre_legal; ?></b>. </p>

	<p>Para constancia de aceptación, firma en la ciudad de <b><?php echo $empresa->ciudad; ?></b> el día <b><?php echo Date('d'); ?> del mes <?php echo Date('m'); ?> del año <?php echo Date('Y'); ?></b></p>
	<div style="height: 40px;"></div>

	<table border="0" cellpadding="0" cellspacing="0" width="50%">
	    <tr>
	        <td width="60%"><b><?php print(@$cuenta[0]->primer_nombre.' '.@$cuenta[0]->segundo_nombre.' '.@$cuenta[0]->primer_apellido.' '.@$cuenta[0]->segundo_apellido);?></b></td>
	        <td width="10%"></td>
	        <td width="30%"></td>
	    </tr>
	    <tr>
	        <td style="height:60px;"></td>
	        <td></td>
	        <td class="borderleft borderight bordetop"></td>
	    </tr>
	    <tr>
	        <td class="bordetop"><?php echo ucwords(mb_strtolower ($cuenta[0]->tipo_identificacion)).' No '?><b><?php echo $cuenta[0]->identificacion; ?></b></td>
	        <td></td>
	        <td class="borderleft borderight"></td>
	    </tr>
	    <tr>
	        <td><b>Expedida <?php echo $cuenta[0]->fecha_expedicion_documento_identidad; ?></b></td>
	        <td></td>
	        <td class="borderleft borderight"></td>
	    </tr>
	    <tr>
	        <td><b><?php echo $cuenta[0]->direccion; ?></b></td>
	        <td></td>
	        <td class="borderleft borderight bordeBottom"></td>
	    </tr>
	</table>
</div>

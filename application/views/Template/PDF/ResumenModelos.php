<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
    $modulo		=	$this->ModuloActivo;
    $items  = $this->$modulo->result['activos'];
    $items2 = $this->$modulo->result['inactivos']; 
?>
<table class="ancho cabecera" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td width="30%" colspan="2">
            <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:90px;" />
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
<div class="footer bordetop pie_de_pagina">
    <table>
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;"></td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
    </table>
</div>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;">
    <div>
    	<div>
            <div style="height: 20px;"></div>
        	<div style="text-align:center;">
                  <b>Resumen Modelos Activos</b>
            </div>
            <div style="height: 20px;"></div>
       	</div>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table">
            <thead>
                <tr class="colorFondo">
                    <td width="50"><b>Sucursal</b></td>
                    <td class="text-left"><b>Nombre</b></td>
                    <td class="text-left"><b>Datos de Contacto</b></td>
                    <td class="text-center"><b>Estado</b></td>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($items > 0){
                        foreach($items as $v){
                            
                ?>
                            <tr>
                                <td class="bordeAll">
                                    <?php print_r($v->abreviacion);?>
                                </td>
                                <td class="bordeAll">
                                    <?php print_r(nombre($v));?>
                                </td>
                                <td class="bordeAll">
                                    <?php print_r($v->contactos);?>
                                </td>
                                <td class="bordeAll">
                                    <?php print_r($v->estado);?>
                                </td>
                            </tr>
                <?php		
                        }
                    }else{
                ?>
                    <tr>
                        <td colspan="4" class="bordeAll">
                            No hay registros disponibles
                        </td>
                    </tr>
                <?php		
                    }
                ?>
            </tbody>
        </table>
    </div>
    <?php 
        if(isset($items2)){
           $resul = count($items2);
        }else{
           $resul = 0; 
        }
        if($resul>0){ 
    ?>
    <div>
        <div style="height: 20px;"></div>
        <div style="text-align:center;">
              <b>Resumen Modelos Inactivos</b>
        </div>
        <div style="height: 20px;"></div>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table" style="margin-bottom: 40px;">
            <thead class="colorFondo">
                <tr>
                    <td width="50"><b>Sucursal</b></td>
                    <td><b>Nombre</b></td>
                    <td><b>Datos de Contacto</b></td>
                    <td><b>Estado</b></td>
                </tr>
            </thead>
            <tbody>
                <?php
                        foreach($items2 as $v){       
                ?>
                            <tr>
                                <td class="bordeAll">
                                    <?php print_r($v->abreviacion);?>
                                </td>
                                <td class="bordeAll">
                                    <?php print_r(nombre($v));?>
                                </td>
                                <td class="bordeAll">
                                    <?php print_r($v->contactos);?>
                                </td>
                                <td class="bordeAll" style="text-align:right;">
                                    <?php print_r($v->estado);?>
                                </td>
                            </tr>
                <?php		
                        }
                ?>
            </tbody>
        </table>
        <?php } ?>
    </div>
</div>
<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo		=	$this->ModuloActivo;
        $contraceñas = get_form_control("SolicitudPlataformas");
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
<div class="container">
    <div style="height:20px;"></div>
	<div style="text-align: center;">
         Resumen Usuarios Activos
    </div>
    <div style="height:20px;"></div>
        <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
            <thead class="colorFondo">
                <tr>
                    <td width="50"><b>Sucursal</b></td>
                    <td class="text-left"><b>Nombre</b></td>
                    <td class="text-left"><b>Plataforma</b></td>
                    <td class="text-center"><b>Usuarios</b></td>
                    <th class="text-center"><b>Contraceña</b></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(count($this->$modulo->result['activos'])>0){
                        foreach($this->$modulo->result['activos'] as $v){
                            
                ?>
                            <tr>
                                <td class="bordeAll" style="vertical-align:middle">
                                    <?php print_r($v->abreviacion);?>
                                </td>
                                <td class="bordeAll" style="vertical-align:middle">
                                    <?php print_r(nombre($v));?>
                                </td>
                                <td class="bordeAll">
                                	<?php print_r(str_replace(",","<BR>",$v->list_plataformas));?>
                                </td>
                                <td class="bordeAll">
									<?php print_r(str_replace(",","<BR>",$v->list_nicknames));?>                                                            
                                </td>
                                <td class="bordeAll">
                                    <?php print_r(str_replace(",","<BR>",$v->pass));?>
                                </td>
                            </tr>
                <?php		
                        }
                    }else{
                ?>
                    <tr>
                        <td colspan="4" class="text-center">
                            No hay registros disponibles
                        </td>
                    </tr>
                <?php		
                    }
                ?>
            </tbody>
        </table>
        <div style="height:20px;"></div>
        <div style="text-align: center;">
             Resumen Usuarios Inactivos
        </div>
    	<table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
            <thead class="colorFondo">
                <tr>
                    <td width="50"><b>Sucursal</b></td>
                    <td class="text-left"><b>Nombre</b></td>
                    <td class="text-left"><b>Plataforma</b></td>
                    <td class="text-center"><b>Usuarios</b></td>
                    <td class="text-center"><b>Contraceña</b></td>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(count($this->$modulo->result['inactivos'])>0){
                        foreach($this->$modulo->result['inactivos'] as $v){       
                ?>
                            <tr>
                                <td class="bordeAll" style="vertical-align:middle">
                                    <?php print_r($v->abreviacion);?>
                                </td>
                                <td class="bordeAll" style="vertical-align:middle">
                                    <?php print_r(nombre($v));?>
                                </td>
                                <td class="bordeAll">
                                    <?php print_r(str_replace(",","<BR>",$v->list_plataformas));?>
                                </td>
                                <td class="bordeAll">
                                    <?php print_r(str_replace(",","<BR>",$v->list_nicknames));?>                                                            
                                </td>
                                <td class="bordeAll">
                                    <?php print_r(str_replace(",","<BR>",$v->pass));?>
                                </td>
                            </tr>
                <?php		
                        }
                    }else{
                ?>
                    <tr>
                        <td colspan="4" class="text-center">
                            No hay registros disponibles
                        </td>
                    </tr>
                <?php		
                    }
                ?>
            </tbody>
        </table>
</div>
                                
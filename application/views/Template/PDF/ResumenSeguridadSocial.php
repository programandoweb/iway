<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo		=	$this->ModuloActivo;
    //pre($this->$modulo->result);
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
    <div style="height: 20px;"></div> 
    <div style="text-align:center;">
        <h4> RESUMEN SEGURIDAD SOCIAL.</h4>
        <p><b>Modelos.</b></p>
    </div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
        <thead class="colorFondo">
            <tr>
                <td width="50"><b>Sucursal</b></td>
                <td class="text-left"><b>Nombre</b></td>
                <td class="text-left" width="200" ><b>Seguridad Social</b></td>
            </tr>
        </thead>
        <tbody>
            <?php
                if(count($this->$modulo->result['Modelos'])>0){
                    foreach($this->$modulo->result['Modelos'] as $v){
                        
            ?>
                    <tr>
                        <td class="bordeAll" style="vertical-align:middle">
                            <?php print_r($v->abreviacion);?>
                        </td>
                        <td class="bordeAll" style="vertical-align:middle">
                            <?php print_r(nombre($v));?>
                        </td>
                        <td class="bordeAll">
                            <?php if(!empty($v->eps)){?>
                                <div> Eps: <b><?php echo $v->eps;?></b></div>
                            <?php }?>
                            <?php if(!empty($v->caja_de_compensacion)){?>
                            <div>
                                Caja Comp:<b><?php echo $v->caja_de_compensacion;?></b>
                            </div>
                            <?php }?>
                            <?php if(!empty($v->pension)){?>
                            <div>
                                Pensión: <b><?php echo $v->pension;?></b>
                            </div>
                            <?php }?>
                            <?php if(!empty($v->arl)){?>
                            <div>
                                Arl: <b><?php echo $v->arl;?></b>
                            </div>
                            <?php }?>
                                                                                        
                        </td>
                    </tr>
            <?php       
                    }
                }else{
            ?>
                <tr>
                    <td colspan="3" class="bordeAll" style="text-align: center;">
                        No hay registros disponibles
                    </td>
                </tr>
            <?php       
                }
            ?>
        </tbody>
    </table>
    <div style="height: 20px;"></div> 
    <div style="text-align:center;">
        <h4> Administrativos.</h4>
    </div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
        <thead class="colorFondo">
            <tr>
                <td width="50"><b>Sucursal</b></td>
                <td class="text-left"><b>Nombre</b></td>
                <td class="text-left" width="200" ><b>Seguridad Social</b></td>
            </tr>
        </thead>
        <tbody>
            <?php
                if(count($this->$modulo->result['Administrativos'])>0){
                    foreach($this->$modulo->result['Administrativos'] as $v){
                        
            ?>
                        <tr>
                            <td class="bordeAll" style="vertical-align:middle">
                                <?php print_r($v->abreviacion);?>
                            </td>
                            <td class="bordeAll" style="vertical-align:middle">
                                <?php print_r(nombre($v));?>
                            </td>
                            <td class="bordeAll">
                                <?php if(!empty($v->eps)){?>
                                    <div> Eps: <b><?php echo $v->eps;?></b></div>
                                <?php }?>
                                <?php if(!empty($v->caja_de_compensacion)){?>
                                <div>
                                    Caja Comp:<b><?php echo $v->caja_de_compensacion;?></b>
                                </div>
                                <?php }?>
                                <?php if(!empty($v->pension)){?>
                                <div>
                                    Pensión: <b><?php echo $v->pension;?></b>
                                </div>
                                <?php }?>
                                <?php if(!empty($v->arl)){?>
                                <div>
                                    Arl: <b><?php echo $v->arl;?></b>
                                </div>
                                <?php }?>
                                                                                            
                            </td>
                        </tr>
            <?php       
                    }
                }else{
            ?>
                <tr>
                    <td colspan="3" class="bordeAll" style="text-align: center;">
                        No hay registros disponibles
                    </td>
                </tr>
            <?php       
                }
            ?>
        </tbody>
    </table>
    <div style="height: 20px;"></div> 
    <div style="text-align:center;">
        <h4> Monitores.</h4>
    </div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
        <thead class="colorFondo">
            <tr>
                <td width="50"><b>Sucursal</b></td>
                <td class="text-left"><b>Nombre</b></td>
                <td class="text-left" width="200" ><b>Seguridad Social</b></td>
            </tr>
        </thead>
        <tbody>
            <?php
                if(isset($this->$modulo->result['Monitores'])){
                    foreach($this->$modulo->result['Monitores'] as $v){
                        
            ?>
                        <tr>
                            <td class="bordeAll" style="vertical-align:middle">
                                <?php print_r($v->abreviacion);?>
                            </td>
                            <td class="bordeAll" style="vertical-align:middle">
                                <?php print_r(nombre($v));?>
                            </td>
                            <td class="bordeAll">
                                <?php if(!empty($v->eps)){?>
                                    <div> Eps: <b><?php echo $v->eps;?></b></div>
                                <?php }?>
                                <?php if(!empty($v->caja_de_compensacion)){?>
                                <div>
                                    Caja Comp:<b><?php echo $v->caja_de_compensacion;?></b>
                                </div>
                                <?php }?>
                                <?php if(!empty($v->pension)){?>
                                <div>
                                    Pensión: <b><?php echo $v->pension;?></b>
                                </div>
                                <?php }?>
                                <?php if(!empty($v->arl)){?>
                                <div>
                                    Arl: <b><?php echo $v->arl;?></b>
                                </div>
                                <?php }?>
                                                                                            
                            </td>
                        </tr>
            <?php       
                    }
                }else{
            ?>
                <tr>
                    <td colspan="3" class="bordeAll" style="text-align: center;">
                        No hay registros disponibles
                    </td>
                </tr>
            <?php       
                }
            ?>
        </tbody>
    </table>
</div>
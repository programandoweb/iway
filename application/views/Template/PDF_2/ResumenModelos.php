<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo		=	$this->ModuloActivo;
        $items = $this->$modulo->result['activos'];
        $reg=count($items);
        $num=$reg/38;
        $Pag=ceil($num)-1;
        $numPag=0; 
        $n=array_chunk($items,26);
        $items2 = 
        $n2= array_chunk($this->$modulo->result['inactivos'],11); 
        //pre($n2); return;           
        for($i=0;$i<=$Pag;$i++){
        $numPag++; 
?>
<div class="container">
    <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="30%" colspan="2">
                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
            </td>
            <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top" colspan="2">
                <?php echo $empresa->nombre_legal?><br/>
                Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
                <?php echo $empresa->direccion;?><br />               
                PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
                <?php echo $empresa->website;?><br/>
                <?php #pre($empresa); ?>
            </td>
        </tr>
    </table> 
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
                if($n[$i]>0){
                    foreach($n[$i] as $v){
                        
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
    <div class="container">
        <?php 
            echo $this->pagination->create_links();
        ?>
    </div>
</div>
    <?php 
    if(isset($n2[$i])){
       $resul = count($n2[$i]);
    }else{
       $resul = 0; 
    }
    if($resul>0){ ?>
    <div>
        <div style="height: 20px;"></div>
        <div style="text-align:center;">
              <b>Resumen Modelos Inactivos</b>
        </div>
        <div style="height: 20px;"></div>
    </div>
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
                    foreach($n2[$i] as $v){       
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
<div class="footer bordetop" style="position: absolute; bottom:5px; width: 100%">
    <table>
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;">Página <?php echo $numPag.' / '.($Pag+1); ?></td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;font-size: 9px;"><?php if(!empty($OpcionesFactura->resolucionFac)){echo $OpcionesFactura->resolucionFac;}else{echo 'La presente resolución aplica únicamente a los documentos de venta que se registren después de grabados estos cambios.';} ?></td>
        </tr>
    </table>
</div><?php }?>
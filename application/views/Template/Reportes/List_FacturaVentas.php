<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo		=	$this->ModuloActivo;
	$pendiente	=	$this->$modulo->result['pendiente'];
	$pagadas	=	$this->$modulo->result['pagadas'];
	$anuladas	=	$this->$modulo->result['anuladas'];	
	$totas_completas	=	@$this->$modulo->result['totas_completas'];	
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<?php 
				//$opciones_factura	=	getOpcionesFacturacion();
				if(!empty($opciones_factura)){
                    $submenu = array( "name"        =>  array(  "title" =>  "Facturas de Ventas",
                                                            "url"   =>  current_url()),
                                    "import"    =>  array(  "title" =>  "Importar Datos",
                                                            "url"   =>  base_url("Reportes/InformePlano")),
                                    "check"     =>  array(  "title" =>  "Verificar Datos",
                                                            "url"   =>  base_url("Reportes/ResultadoImport/Debug/2")),                                                                                                                          
                                    "add"       =>  array(  "title" =>  "Factura manual",
                                                            "url"   =>  base_url("Reportes/Add_Factura"),
                                                            "lightbox"=>true),
                                    "config"    =>  array(  "title" =>  "Personalización de Factura",
                                                            "icono" =>  '<i class="fas fa-cogs"></i>',
                                                            "url"   =>  base_url("Configuracion/OpcionesFactura"),
                                                            "lightbox"=>true)
                            );
				}else{
                    $submenu = array( "name"        =>  array(  "title" =>  "Facturas de Ventas",
                                                                "url"   =>  current_url()),
                                        "config"    =>  array(  "title" =>  "Personalización de Factura",
                                                                "icono" =>  '<i class="fas fa-cogs"></i>',
                                                                "url"   =>  base_url(""),
                                                                "lightbox"=>true)
                            );
				}
                /*if($this->user->type != "Asociados" && $this->user->type != "root" ){
                    unset($submenu['config']);
                }*/
                echo TaskBar($submenu); 
				
			?>
			
<?php
/* 
  DESARROLLO Y PROGRAMACIÓN
  PROGRAMANDOWEB.NET
  LCDO. JORGE MENDEZ
  info@programandoweb.net
*/?>
<?php
  $modulo   = $this->ModuloActivo;
  if($this->user->type=='Modelos'){
    return; 
  }
  setlocale(LC_ALL,"es_ES.UTF-8");
  //pre($this->user);
  $json = @json_decode($this->$modulo->result[0]->json);
  $OpcionesFactura    =   getOpcionesFactura($empresa->user_id); 
  $row = $this->$modulo->result;
  $saldo = operaciones_bancos_prueba(NULL,$row[0]->codigo_contable,$this->uri->segment(3));
?>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
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
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-bottom: 100px;">
    <div style="height: 40px;"></div>
  <div class="container">
      <div style="text-align: center;">
          <b>Resumen <?php echo $row[0]->nombre_caja; ?></b>
      </div>
      <div style="text-align: center;">
          <b>Fecha generacion Informe: <?php echo date("Y-m-d"); ?></b>
      </div>
      <div style="text-align: center;">
          <b>Saldo: <?php echo format($saldo,true); ?></b>
      </div>
    <div style="height: 40px;"></div>
    <div class="row justify-content-md-center">
          <div class="col-md-12">
              <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
                  <thead class="colorFondo bordeAll">
                      <tr>
                          <th class="text-left">Fecha</th>
                          <th class="text-left">Tipo Documento</th>
                          <th class="text-center">Documento</th>
                          <th width="100" class="text-right">Debito</th>
                          <th width="100" class="text-right">Crédito</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php 
                
                        $debito=0;
                        $credito=0;
                        foreach($this->$modulo->result as $v){
                      ?>
                      <tr>
                          <td class="bordeAll" style="text-align: center;"><?php echo $v->fecha;// pre($v); ?></td>
                          <td class="bordeAll"><?php echo tipo_documento($v->tipo_documento); ?></td>
                          <td class="bordeAll" style="text-align: center;"><?php echo $v->consecutivo ?></td>
                          <td class="bordeAll" style="text-align: right;">
                            <?php echo format($v->debito_COP,true);$debito+= $v->debito_COP; ?>
                          </td>
                          <td class="bordeAll" style="text-align: right;">
                            <?php echo format($v->credito_COP,true); $credito+= $v->credito_COP;?>
                          </td>
                      </tr>
                      <?php
                        }
                      ?>
                  </tbody>
                  <tfoot>
                    <tr>
                        <th></th>
                          <th></th>
                          <th class="bordeAll colorFondo">Total:</th>
                          <th class="bordeAll colorFondo" style="text-align:right;">
                            <?php echo format(@$debito,true); ?>  
                          </th>
                          <th class="bordeAll colorFondo" style="text-align:right;">
                            <?php echo format(@$credito,true); ?>
                          </th>
                      </tr>
                  </tfoot>
              </table>
          </div>
      </div>
  </div>
</div>
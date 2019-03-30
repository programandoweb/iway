<?php
/* 
  DESARROLLO Y PROGRAMACIÓN
  PROGRAMANDOWEB.NET
  LCDO. JORGE MENDEZ
  info@programandoweb.net
*/
?>
<?php
    $num=0;
    foreach($this->$modulo->HonorariosModelos($this->$modulo->result->user_id) as $v){ $num++;}
    $reg=$num/7;
    $Pag=ceil($reg);              
    for($i=1;$i<=$Pag;$i++){
?> 
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td width="30%">
            <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
        </td>
        <td style="text-align:right;font-size:12px;font-weight:bold;" valign="top">
           <?php echo $empresa->nombre_legal?><br />
            <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
            <?php  echo $centrodecostos->direccion; ?><br />
            PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
            <?php echo $empresa->website;?><br />
        </td>
    </tr>
</table>    
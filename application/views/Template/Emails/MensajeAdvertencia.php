<?php
    $json = json_decode($data['opciones_adicionales']);
    $responsable = centrodecostos($json->responsable);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Advertencia</title>
</head>
<body style="width:100%; margin:0; padding:0;">
<div style="width:100%; margin:0; padding:0;">
<div style=" width:820px; margin:0 auto; border: solid 1px #f2f2f2; background:white">
<div style="width:820px; height:150px;    position:absolute; background:blue">
     <center><img src="<?php echo DOMINIO;?>images/banner-webcamplus.jpg" style="width:820px;" /> <center>
     </div>
     <div style=" width:730px; margin:0 auto;  z-index:100; position:relative; padding:20px; border: solid 1px #f2f2f2;  background:white; margin-top:180px;">
      <center><img src="<?php echo DOMINIO;?>images/webcamplus-png.png" style="width:300px;" /></center>
        <p><b style="color: red;">Importante</b>: Hola <b><?php print($data['nombre']);?></b>, webcamplus te informa que la cuenta de la plataforma <b><?php echo $data['plataforma']; ?></b>; que actualmente trabajas bajo el usuario <b><?php echo $data['nickname']; ?></b>, en este momento no se encuentra bloqueada para tu país.</p> 
        <p>Ten presente que si no has solicitado que seas bloqueada(o) para tu país deberás informar a la(el) funcionaria(o) <b><?php print($responsable->primer_nombre.' '.$responsable->segundo_nombre.' '.$responsable->primer_apellido.' '.$responsable->segundo_apellido);?></b>, que esté perfil creado el día <?php echo $json->fecha_creacion; ?>, no quedo correctamente configurado, de lo contrario has caso omiso al presente mensaje.</p>
        <p>Cordialmente,</p>
        <div style="height: 40px;"></div>
        <p><b>Equipo WebcamPlus.</b></p> 
        <p>Para saber mas detalles puedes acceder a tu cuenta dando<a href="https://webcamplus.com.co/desarrollo/Autenticacion" target="_blank"> click a este vinculo</a>.</p>
        <center>
        <div style=" background:black; padding:30px; ">
            <table style="margin-left:50px;" width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><img style="width:40px;" src="<?php echo DOMINIO;?>images/redes/facebook.svg"/></td>
                    <td><img style="width:40px;" src="<?php echo DOMINIO;?>images/redes/gorjeo.svg"/></td>
                    <td><img style="width:40px;" src="<?php echo DOMINIO;?>images/redes/youtube.svg"/></td>
                    <td><img style="width:40px;"  src="<?php echo DOMINIO;?>images/redes/instagram.svg"/></td>
                </tr>
            </table>
            </div>     
        </center>
	</div>
    </div> 
</div>
</body>
</html>
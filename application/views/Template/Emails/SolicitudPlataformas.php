<?php
    $json = json_decode($data[0]->data);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Confirmacion Solicitud Plataforma</title>
</head>
<body style="width:100%; margin:0; padding:0;">
<div style="width:100%; margin:0; padding:0;">
<div style=" width:820px; margin:0 auto; border: solid 1px #f2f2f2; background:white">
<div style="width:820px; height:150px;    position:absolute; background:blue">
     <center><img src="<?php echo DOMINIO;?>images/banner-webcamplus.jpg" style="width:820px;" /> <center>
     </div>
       <div style=" width:730px; margin:0 auto;  z-index:100; position:relative; padding:20px; border: solid 1px #f2f2f2;  background:white; margin-top:180px;">
       <center><img src="<?php echo DOMINIO;?>images/webcamplus-png.png" style="width:300px;" /></center>
        <p><b style="color: black;">Importante</b>: Hola <b><?php echo $json->nombre_modelo;?></b>, WebcamPlus® te informa que la cuenta de la plataforma <b><?php echo $json->plataforma; ?></b>; solicitada el <b><?php echo $json->fecha; ?></b> por <b><?php echo $json->responsable; ?></b> ya fué creada para tu usuario <b><?php echo $json->usuario; ?></b></p>

        <p>Cordialmente,</p>
        <div style="height: 40px;"></div>
        <p><b>Equipo WebcamPlus®.</b></p> 
        <p>Para saber mas detalles puedes acceder a tu cuenta dando<a href="https://webcamplus.com.co/belle" target="_blank"> click a este vinculo</a>.</p>
        <center>
        <div style=" background:black; padding:30px; ">
            <table style="margin-left:50px;" width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><img style="width:40px;" src="<?php echo DOMINIO;?>images/redes/facebook.svg"/></td>
                    <td><img style="width:40px;" src="<?php echo DOMINIO;?>images/redes/gorjeo.svg"/></td>
                    <td><img style="width:40px;" src="<?php echo DOMINIO;?>images/redes/youtube.svg"/></td>
                    <td><img style="width:40px;" src="<?php echo DOMINIO;?>images/redes/instagram.svg"/></td>
                </tr>
            </table>
            </div>      
        </center>

        </div>
	</div> 
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="ES">
    <head>
    	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    	<link href="<?php echo DOMINIO?>design/css/pdf.css" rel="stylesheet">
        <meta charset="utf-8">
        <?php
        	$this->load->helper('numeros');
    		setlocale(LC_ALL,"es_ES.UTF-8");
            $color  =   getColor($this->user->id_empresa);
        ?>
        <style>
            .colorFondo{
                background-color:<?php if(empty($color)){ echo'#666'; }else{ echo $color;}?>;
                color:#fff;
            }
            .colorFondo{
               padding: 2px;
            }
            .table> td{
                border-right: 1px solid <?php if(empty($color)){ echo'#D8D8D8'; }else{ echo $color;}?>;
                border-left : 1px solid <?php if(empty($color)){ echo'#D8D8D8'; }else{ echo $color;}?>;
            }
            .bordetop{
                border-top:1px solid <?php if(empty($color)){ echo'#D8D8D8'; }else{ echo $color;}?>;
            }
            .bordeBottom{
                border-bottom:1px solid <?php if(empty($color)){ echo'#D8D8D8'; }else{ echo $color;}?>;
            }
            .borderight: {
                border-right: 1px solid <?php if(empty($color)){ echo'#D8D8D8'; }else{ echo $color;}?>;
            }
            .borderleft: {
                border-left: 1px solid <?php if(empty($color)){ echo'#D8D8D8'; }else{ echo $color;}?>;
            }
            .bordeAll{
                border: 1px solid <?php if(empty($color)){ echo'#D8D8D8'; }else{ echo $color;}?>; 
            }
        </style>
    </head>
    <body> 
    
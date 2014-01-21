<?php
/*
 * Nombre:  header.php
 * Autor:   FIGG - FAT
 * Fecha:   10-Diciembre-2013
 * Descripcion: Header del sitio
 *
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> ::.Alto Diseño Áldico Mecánico.:: </title>
        <!-- Estilos @Alejandro Terron -->
        <link rel="stylesheet" tyep="text/css" href="Vista/css/Desarrollo/reset.css"/>
        <link rel="stylesheet" type="text/css" href="Vista/css/Desarrollo/970_6_10.css"/>
        <link rel="stylesheet" type="text/css" href="Vista/css/Desarrollo/styles.css"/>
        <!-- Icono -->
        <link rel="shortcut icon" type="image/xicon" href="Vista/Imagenes/favicon.ico"/>
        
        <!-- Scripts @Froebel I. Gutierrez, @Tomas Martinez -->
        <script type="text/javascript" language="javascript" src="Controlador/js/funciones.js" ></script> 
        <script type="text/javascript" language="javascript" src="Controlador/js/jquery-1.5.1.js"></script>
        <!-- Script para el menu -->
        <script type="text/javascript">
            $(document).ready(function() {

                $("ul.subnav").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled (Adds empty span tag after ul.subnav*)

                $("ul.topnav li span").click(function() { //When trigger is clicked...

                    //Following events are applied to the subnav itself (moving subnav up and down)
                    $(this).parent().find("ul.subnav").slideDown('fast').show(); //Drop down the subnav on click

                    $(this).parent().hover(function() {
                    }, function() {
                        $(this).parent().find("ul.subnav").slideUp('slow'); //When the mouse hovers out of the subnav, move it back up
                    });

                    //Following events are applied to the trigger (Hover events for the trigger)
                }).hover(function() {
                    $(this).addClass("subhover"); //On hover over, add class "subhover"
                }, function() {	//On Hover Out
                    $(this).removeClass("subhover"); //On hover out, remove class "subhover"
                });

            });

        </script>   
    </head>
    <?php
    include 'menuNav.php';
    ?>
    <body>
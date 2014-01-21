<?php
/*
 * Nombre:  menuNav.php
 * Autor:   FIGG - FAT
 * Fecha:   10-Diciembre-2013
 * Descripcion: Menu de navegacion del sitio.
 *
 */
?>
<style>
ul.topnav {
	list-style: none;
	padding: 0 20px;
	margin: 0;
	float: left;
	width: 920px;
	font-size:14px;

}
ul.topnav li {
	float: left;
	margin: 0;
	padding: 0 15px 0 0;
	position: relative; /*--Declare X and Y axis base for sub navigation--*/
	width:138px;
}
ul.topnav li a{
	padding: 10px 5px;
	color: #fff;
	display: block;
	text-decoration: none;
	float: left;
}
ul.topnav li a:hover{

}
ul.topnav li span { /*--Drop down trigger styles--*/
	height: 35px;
	float: left;

}
ul.topnav li span.subhover {background-position: center bottom; cursor: pointer;} /*--Hover effect for trigger--*/
ul.topnav li ul.subnav {
	list-style: none;
	position: absolute; /*--Important - Keeps subnav from affecting main navigation flow--*/
	left: 0; top: 35px;
	background: #1D276A;
	margin: 0; padding: 0;
	display: none;
	float: left;
	width: 170px;
	border: 1px solid #FF992A;
	border-radius:5px;
}
ul.topnav li ul.subnav li{
	margin: 0; padding: 0;
	border-top: 1px solid #FF992A; /*--Create bevel effect--*/
	border-bottom: 1px solid #c3c3c3; /*--Create bevel effect--*/
	clear: both;
	width: 170px;

}
html ul.topnav li ul.subnav li a {
	float: left;
	width: 145px;
	background: #1D276A;
	padding-left: 20px;

}
html ul.topnav li ul.subnav li a:hover { /*--Hover effect for subnav links--*/
	background: #0099CC;
}
.salir{
	padding:0 !important;}

</style>
<ul class="topnav">
    <li>
        <span><a href="index.php"><img src="Vista/Imagenes/logo_pagina.png" width="281" height="318"/></a></span>
    </li>
    <li>
        <!-- <span>&#191 Quienes S&oacute;mos &#63</span> -->
        <span><a href="#"><img src="Vista/Imagenes/botonQienes.png" class="botonesNav"></a></span>
        <ul class="subnav">
            <li><a href="mision.php">Misi&oacute;n</a></li>
            <li><a href="vision.php">Visi&oacute;n</a></li>
            <li><a href="antecedentes.php">Valores</a></li>
        </ul><span></span>
    </li>
    <li>
        <span><a href="#"><img src="Vista/Imagenes/botonServicios.png" class="botonesNav"></a></span>
    </li>
    <li>
        <span><a href="#"><img src="Vista/Imagenes/botonGaleria.png" class="botonesNav"></a></span>
    </li>
    <li>
        <span><a href="#"><img src="Vista/Imagenes/botonContacto.png" class="botonesNav"></a></span>
    </li>
</ul>




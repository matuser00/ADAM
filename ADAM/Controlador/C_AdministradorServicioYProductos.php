<?php
include('../Configuracion/config.php');   
include('../Modelo/servicioproducto.php');
include('../Modelo/AdministradorServiciosYProductos.php');                   
include('../Modelo/FuncionesComunes.php');

$opcion=  $_POST['opcion'];
//$opcion= AdministradorServiciosYProductos::ELIMINAR_PRODUCTOOSERVICIO;//Solo pruebas
$respuestaControlador="";


//Llamada a consultar servicios o productos:
if($opcion==AdministradorServiciosYProductos::CONSULTAR_SERVICIOSYPRODUCTOS){    
    $respuestaControlador=AdministradorServiciosYProductos::obtenerServiciosYProductos();
}        

//Llamada a consultar un servicio o producto en especifico:
if($opcion==AdministradorServiciosYProductos::CONSULTAR_SERVICIOOPRODUCTO_PORID){    
    $respuestaControlador=AdministradorServiciosYProductos::obtenerServicioOProducto_PorId($_POST['id']);
}

//Llamada a agregar servicio o producto
if($opcion==AdministradorServiciosYProductos::AGREGAR_SERVICIO){    
    $nuevoelemento=new servicioproducto();
    $nuevoelemento->nombre=$_POST['nombre'];
    $nuevoelemento->precio=$_POST['precio'];
    $respuestaControlador=AdministradorServiciosYProductos::agregarServicioOProducto($nuevoelemento);
}

//Llamada a modificar servicio o producto
if($opcion==AdministradorServiciosYProductos::MODIFICAR_SERVICIOOPRODUCTO){    
    $nuevoelemento=new servicioproducto();
    $nuevoelemento->id=$_POST['id'];
    $nuevoelemento->nombre=$_POST['nombre'];
    $nuevoelemento->precio=$_POST['precio'];
    
   
    $respuestaControlador=AdministradorServiciosYProductos::modificarServicioOProducto($nuevoelemento);
}

//Llamada a eliminar servicio o producto
if($opcion==AdministradorServiciosYProductos::ELIMINAR_PRODUCTOOSERVICIO){
    $idsEliminar=explode(",",$_POST['ids']);
    //$ids=",22";
    //$idsEliminar=explode(",",$idsEliminar);
    $respuestaControlador=AdministradorServiciosYProductos::eliminarServicioOProducto($idsEliminar);
}


header('Content-type: text/xml');
echo $respuestaControlador;

?>
    
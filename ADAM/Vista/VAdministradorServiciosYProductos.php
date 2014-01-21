<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/Debug/DialogosMensaje.css"" media="all"/>
        <script type="text/javascript" src="../Controlador/js/jquery-1.5.1.js"></script>
        <script type="text/javascript" src="../Modelo/POJOServicioOProducto.js"></script> 
        <script type="text/javascript" src="../Controlador/js/funciones.js"></script>                
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <!-- Dialogo para agregar servicios o productos -->
        <form id="Dialogo_AgregarProductoOServicio">
            <p>Nombre: </p><input type="text" name="nombre" value="">
            <p>Precio: $</p><input type="text" name="precio" value="">
            <input name="dispararaccion" type="button" id="guardarProductoOServicio" value="Guardar" onclick="guardarServicioOProducto()">
        </form>
        
        <form id="Operaciones">            
            <input type="button" id="guardarProductoOServicio" value="Eliminar" onclick="eliminarServicioOProducto()">
            <input type="button" id="crearNuevoProductoOServicio" value="Nuevo" onclick="crearNuevo_ProductoOServicio()">
        </form>
        
        <!-- Lista de productos y servicios -->
        <ul id="tagLista">
            <script>$(document).ready(serviciosyproductos_ini_administrador);</script>
        </ul>
    </body>
</html>

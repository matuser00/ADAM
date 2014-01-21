<!--
Tomás Martínez Arenas
Banco de dialogos de mensaje
Descripción:
Este archivo contiene todos los dialogos de mensajes que serán mostrados en el sitio
-->
<?php
    $idmsj=$_POST['idmsj'];
    //$idmsj='msj0';
    $texto=$_POST['texto'];
    //$texto='prueba texto prueba textoprueba texto';
    if($idmsj=='msj0'){
?>
        <!-- Mensaje normal -->
        <div id="msj0" class="mensajeOK">
            <p><?php echo $texto; ?></p>
            <a href="#" onclick="ocultarMensaje();">OK</a>
        </div>
<?php 
    }if($idmsj=='msj1'){
?>
        <!-- Mensaje alerta -->
        <div id="msj1" class="mensajeOK">
            <p><?php echo $texto; ?></p>
            <a href="#" onclick="ocultarMensaje();">OK</a>
        </div>
<?php 
    }if($idmsj=='msj-1'){
?>
        <!-- Mensaje error -->
        <div id="msj-1" class="mensajeOK">
            <p><?php echo $texto; ?></p>
            <a href="#" onclick='ocultarMensaje();'>OK</a>
        </div>
<?php 
    }
?>

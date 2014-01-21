<?php
/*
 * contacto.php
 * Autor: FIGG - FAT
 * Fecha: 10-Diciembre-2013
 * Descripción: Vista para el contacto.
 */
include 'header.php';
?>
<div id="Contenido">
    <div id="ContactoYFormulario">
        <div id="Contacto" class="Contenido_ContactoYFormulario">
            <p>Like en Facebook: <a href="http://www.facebook.com/pages/FIGG/146305185385282?fref=ts" target="_blank"><img src="imagenes/icono-facebook.png" height="50" width="50" /></a></p>
            <p>Siguenos en Twitter: <a href="https://twitter.com/Froebel_IG2"><img src="imagenes/twitter1.jpg" height="50" width="50" target="_blank" /></a></p>
            <p>Suscribete en nuestro canal: <a href="https://twitter.com/Froebel_IG2"><img src="imagenes/icono-youtube.png" height="50" width="50" target="_blank" /></a></p>
        </div>
        <div id="Formulario" class="Contenido_ContactoYFormulario">
            <form>
                <div id="validarNombreContacto"></div>
                Nombre:<input type="text" name="nombreContacto" id="nombrecontacto" value="" />
                <div id="validarCorreoContacto"></div>
                Correo:<input type="text" name="correoContacto" id="correoContacto" value="" />
                <div id="validarComentarioContacto"></div>
                Comentario:<textarea id="comentarioContacto" name="comentarioContacto" cols="10" rows="5"></textarea>
                <div id="respuestaContacto"></div>
                <input type="button" onclick="contactoADAM();" name="contacto" value="Enviar Comentario" />
            </form>
        </div>
    </div>
</div>
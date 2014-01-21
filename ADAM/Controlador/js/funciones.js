/*
 * Nombre:  funciones.js
 * Autor:
 *          Froebel Ivan Gutierrez Galarza
 * Fecha:   10-Diciembre-2013
 * Descripcion: Funciones ADAM.
 *
 */


/*
 * Autor    : FIGG - FAT
 * Fecha    : 10-Diciembre-2013
 * Descripcion: Objeto AJAX.
 */
function objetoAjax() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }

    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function contactoADAM()
{
    //Limpiamos divs
    $("#respuestaContacto").html("<img src='imagenes/ajax-loader' />");

    //Parametros
    var nombreContacto = jQuery.trim($("#nombrecontacto").val());
    var correoContacto = jQuery.trim($("#correoContacto").val());
    var comentarioContacto = jQuery.trim($("#comentarioContacto").val());

    var validaContacto = 0;
    validaContacto = validarContacto(nombreContacto, correoContacto, comentarioContacto);

    if (!validaContacto)
    {
        var parametros = "nombre=" + nombreContacto + "&correo=" + correoContacto + "&comentario=" + comentarioContacto;
        alert(parametros);
        var docPHP = "../Controlador/enviarComentario.php";

        ajax = objetoAjax();
        ajax.open("POST", docPHP, true);
        ajax.onreadystatechange = function()
        {
            if (ajax.readyState == 4)
            {
                alert("listo");
                $("#respuestaContacto").html(ajax.responseText);
            }
        }
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        //enviando los valores
        ajax.send(parametros);
    }
}

/*
 * Autor    : FIGG - GOWEB
 * Fecha    : 02 - Agosto - 2013
 * Descripcion: Validaciones en Login
 */
function validarContacto(nombreContacto, correoContacto, comentarioContacto)
{
    //Se limpian divs
    $("#validarNombreContacto").html("");
    $("#validarCorreoContacto").html("");
    $("#validarComentarioContacto").html("");
    $("#respuestaContactoTS").html("");

    var error = 0;
    var valCorreo = 0;

    if (nombreContacto == "")
    {
        $("#validarNombreContacto").html("Dato Obligatorio");
        error = 1;
    }
    else
    {
        $("#validarNombreContacto").html("");
    }
    if (correoContacto == "" || correoContacto != "")
    {
        valCorreo = validarCorreo(correoContacto);

        if (!valCorreo)
        {
            $("#validarCorreoContacto").html("");
        }
        else
        {
            $("#validarCorreoContacto").html("Formato invalido");
            error = 1;
        }
    }
    if (comentarioContacto == "")
    {
        $("#validarComentarioContacto").html("Dato Obligatorio");
        error = 1;
    }
    else
    {
        $("#validarComentarioContacto").html("");
    }
    return error;
}
function validarCorreo(valor)
{
    var error = 0;

    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    $("#validarCorreo").html("");
    if (valor == "")
    {
        //$("#validarCorreoRegistro").html("Dato Obligatorio");
        error = 1;
    }
    else
    {
        if (!re.test(valor))
        {
            //$("#validarCorreoRegistro").html("Formato Invalido");
            error = 1;
        }
        else
        {
            //$("#validarCorreoRegistro").html("");
        }
    }
    return error;
}


/*
 * Autor: Tomás Martínez Arenas
 * Descripción: Funciones para consulta y operaciones sobre la base de datos
 */

//CODIGOS DE OPERACIONES:
var COP_1 = '1';//Consultar todos los servicios y productos
var COP_0 = '0';//Agregar servicio o productos
var COP_2 = '2';//Obtener propiedades de determinado servicio o producto
var COP_3 = '3';//Modificar propiedades de determinado servicio o producto
var COP_4 = '4';//Eliminar determinado servicio o producto

//Funcion para cargar la lista de productos y servicios que ofrecen
function serviciosyproductos_ini() {

    var respuesta = consultarTodosLosServiciosYProductos();
    if (respuesta != null) {
        var mensaje = respuesta[0].getElementsByTagName("mensaje")[0];
        var tagLista = document.getElementById('tagLista');
        if (mensaje.getAttribute("estado") == "0") {//OK
            var elementos = respuesta[0].getElementsByTagName("serviciooproducto");
            var itemsLista = new Array();
            for (var r = 0; r < elementos.length; r++) {
                itemsLista[r] = document.createElement('il');
                itemsLista[r].innerHTML = elementos[r].getAttribute("nombre");
                itemsLista[r].addEventListener("click", obtenerPropiedadesServicioOProductoJS, false);
                itemsLista[r].idElemento = elementos[r].getAttribute("id");
                tagLista.appendChild(itemsLista[r]);
            }
        } else {//NOK
            mostrarMensaje(mensaje.getAttribute("estado"),mensaje.getAttribute("descripcion"));
        }
    } else {
         mostrarMensaje("-1","Error desconocido");
    }
}

var elementosEnExploracion=new Array();

//Funcion para cargar la lista de productos y servicios cuando esta en el modulo de administrador
function serviciosyproductos_ini_administrador() {

    var respuesta = consultarTodosLosServiciosYProductos();
    if (respuesta != null) {
        var mensaje = respuesta[0].getElementsByTagName("mensaje")[0];
        var tagLista = document.getElementById('tagLista');
        document.getElementById('tagLista').innerHTML = '';
        if (mensaje.getAttribute("estado") == "0") {//OK                        
            var elementos = respuesta[0].getElementsByTagName("serviciooproducto");
            var parrafos = new Array();
            var checkboxes = new Array();
            var itemsLista = new Array();            
            for (var r = 0; r < elementos.length; r++) {
                elementosEnExploracion= new POJOServicioOProducto();//Hey falta seguirle aqui!!!! crear el array de elementos y seguirle a la funcion de eliminar
                itemsLista[r] = document.createElement('il');
                parrafos[r] = document.createElement('p');
                checkboxes[r] = document.createElement('input');
                checkboxes[r].type = "checkbox";
                checkboxes[r].setAttribute("id",elementos[r].getAttribute("id"));
                itemsLista[r].appendChild(parrafos[r]);
                itemsLista[r].appendChild(checkboxes[r]);
                parrafos[r].innerHTML = elementos[r].getAttribute("nombre");
                parrafos[r].addEventListener("click", obtenerPropiedadesServicioOProductoJS, false);
                parrafos[r].idElemento = elementos[r].getAttribute("id");
                tagLista.appendChild(itemsLista[r]);
            }
        } else {//NOK
            mostrarMensaje(mensaje.getAttribute("estado"),mensaje.getAttribute("descripcion"));
        }
    } else {
        mostrarMensaje("-1","Error desconocido");
    }
}


function crearNuevo_ProductoOServicio() {
    var dialogo = document.forms['Dialogo_AgregarProductoOServicio'];
    dialogo.nombre.value = "";
    dialogo.precio.value = "";
    dialogo.nombre.focus();
    document.forms['Dialogo_AgregarProductoOServicio'].dispararaccion.value="Guardar";
    indicadorNuevo=true;
}

function eliminarServicioOProducto() {    
    //Procesamos la cantidad de servicios o productos que se van a eliminar:
    var lista=document.getElementById('tagLista');
    var nodos=lista.childNodes;
    var n=nodos.length;    
    var idElementosAEliminar="";
    //alert("..."+nodos[0].childNodes[1].checked);
    for(var r=0;r<n;r++){
        if(nodos[r].childNodes[1].checked)
            idElementosAEliminar+=","+nodos[r].childNodes[1].getAttribute("id");   
    }
    //alert(idElementosAEliminar);
    if(idElementosAEliminar==""){
        mostrarMensaje("1","No hay elementos seleccionados");
    }else{
        var respuesta_operacion=eliminarServiciosOProductos(idElementosAEliminar);    
        //console.log(respuesta_operacion[1]);
        if (respuesta_operacion!=null) {        
            serviciosyproductos_ini_administrador();
            var mensaje = respuesta_operacion[0].getElementsByTagName("mensaje")[0];
            mostrarMensaje(mensaje.getAttribute("estado"),mensaje.getAttribute("descripcion"));           
        }else{
            mostrarMensaje("-1","Error desconocido");   
        } 
    }
}

var indicadorNuevo = true;

//Funcion para guardar un nuevo servicio o producto o para modificar uno existente (ya seleccionado) en la base de datos
function guardarServicioOProducto() {
    var nombre = document.forms['Dialogo_AgregarProductoOServicio'].nombre.value;
    var precio = document.forms['Dialogo_AgregarProductoOServicio'].precio.value;
    if (indicadorNuevo) {//Agregamos servcio nuevo
        var respuesta = agregarServicioOProducto(nombre, precio);         
        if (respuesta != null) {            
            var mensaje = respuesta[0].getElementsByTagName("mensaje")[0];
            //alert(mensaje.getAttribute("descripcion"));
            mostrarMensaje(mensaje.getAttribute("estado"),mensaje.getAttribute("descripcion"));
            if (mensaje.getAttribute("estado") == '0') {                
                serviciosyproductos_ini_administrador();
            }
        } else {
            //alert('Error desconocido');
            mostrarMensaje("-1","Error desconocido");
        }
    } else {//Modificamos servicio seleccionado
        respuesta=modificarServicioOProducto();
        //document.getElementById('tagLista').innerHTML = 'Actualizando...';
        if (respuesta != null) {
            var mensaje = respuesta[0].getElementsByTagName("mensaje")[0];
            //alert(mensaje.getAttribute("descripcion"));
             mostrarMensaje(mensaje.getAttribute("estado"),mensaje.getAttribute("descripcion"));
            if (mensaje.getAttribute("estado") == '0') {
                document.getElementById('tagLista').innerHTML = 'Actualizando...';
                document.getElementById('guardarProductoOServicio').disabled=true;
                serviciosyproductos_ini_administrador();
            }
        } else {
             mostrarMensaje("-1","Error desconocido");
        }
    }
}

//Funcion para obtener propiedades del servicio o producto
function obtenerPropiedadesServicioOProductoJS(e) {
    indicadorNuevo = false;
    document.forms['Dialogo_AgregarProductoOServicio'].dispararaccion.value="Modificar";
    var id = e.target.idElemento;
    var respuesta = obtenerPropiedadesServicioOProducto(id);
    if (respuesta != null) {
        var mensaje = respuesta[0].getElementsByTagName("mensaje")[0];
        if (mensaje.getAttribute("estado") == '0') {
            var elemento = respuesta[0].getElementsByTagName("serviciooproducto")[0];
            if (elemento != undefined) {
                //alert("Nombre: "+elemento.getAttribute("nombre")+", precio: "+elemento.getAttribute("precio"));
                var dialogopropiedades = document.forms['Dialogo_AgregarProductoOServicio'];
                dialogopropiedades.nombre.value = elemento.getAttribute("nombre");
                dialogopropiedades.precio.value = elemento.getAttribute("precio");
                serviciooproducto= new POJOServicioOProducto();
                serviciooproducto.id=elemento.getAttribute("id");
                serviciooproducto.nombre=elemento.getAttribute("nombre");
                serviciooproducto.precio=elemento.getAttribute("precio");
            }
        } else {
            
            //alert(mensaje.getAttribute("descripcion"));
             mostrarMensaje(mensaje.getAttribute("estado"),mensaje.getAttribute("descripcion"));
        }
    } else {
         mostrarMensaje("-1","Error desconocido");
    }
}

// ===== LLAMADAS SOBRE BASE DE DATOS =====

//Funcion que consulta todos los servicios y productos
function consultarTodosLosServiciosYProductos() {
    var respuesta = null;
    var parametros = "opcion=" + COP_1;//Definimos la opcion que el controlador ejecutara
    var XMLHttpRequestObject2 = objetoAjax();
    if (XMLHttpRequestObject2) {
        XMLHttpRequestObject2.open('POST', '../Controlador/C_AdministradorServicioYProductos.php', false);
        XMLHttpRequestObject2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        XMLHttpRequestObject2.onreadystatechange = function() {
            if (XMLHttpRequestObject2.readyState == 4 && XMLHttpRequestObject2.status == 200) {
                respuesta = new Array(XMLHttpRequestObject2.responseXML, XMLHttpRequestObject2.responseText);
                var boton=document.getElementById('guardarProductoOServicio');
                if(boton!=undefined){
                    boton.disabled=false;
                }
            }
        }
        XMLHttpRequestObject2.send(parametros);
    }
    return respuesta;
}

//Funcion para agregar un servicio o producto
function agregarServicioOProducto(nombre, precio) {
    var respuesta = null;
    var parametros = "opcion=" + COP_0 + "&nombre=" + nombre + "&precio=" + precio;//Definimos la opcion que el controlador ejecutara
    var XMLHttpRequestObject2 = objetoAjax();
    if (XMLHttpRequestObject2) {
        XMLHttpRequestObject2.open('POST', '../Controlador/C_AdministradorServicioYProductos.php', false);
        XMLHttpRequestObject2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        XMLHttpRequestObject2.onreadystatechange = function() {
            if (XMLHttpRequestObject2.readyState == 4 && XMLHttpRequestObject2.status == 200) {
                respuesta = new Array(XMLHttpRequestObject2.responseXML, XMLHttpRequestObject2.responseText);
                
            }
        }
        XMLHttpRequestObject2.send(parametros);
    }
    return respuesta;
}

//Funcion para obtener las propiedades de un servicio o producto desd ela base de datos
function obtenerPropiedadesServicioOProducto(id) {
    var respuesta = null;
    var parametros = "opcion=" + COP_2 + "&id=" + id;//Definimos la opcion que el controlador ejecutara    
    var XMLHttpRequestObject2 = objetoAjax();
    if (XMLHttpRequestObject2) {
        XMLHttpRequestObject2.open('POST', '../Controlador/C_AdministradorServicioYProductos.php', false);
        XMLHttpRequestObject2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        XMLHttpRequestObject2.onreadystatechange = function() {
            if (XMLHttpRequestObject2.readyState == 4 && XMLHttpRequestObject2.status == 200) {
                respuesta = new Array(XMLHttpRequestObject2.responseXML, XMLHttpRequestObject2.responseText);
            }
        }
        XMLHttpRequestObject2.send(parametros);
    }
    return respuesta;
}
var serviciooproducto=null;
//Funcion para modificar un servicio o producto
function modificarServicioOProducto() {
    var respuesta = null;
    var dialogo=document.forms['Dialogo_AgregarProductoOServicio'];
    var parametros = "opcion=" + COP_3 + "&id=" + serviciooproducto.getId()+"&nombre="+dialogo.nombre.value+"&precio="+dialogo.precio.value;//Definimos la opcion que el controlador ejecutara    
    var XMLHttpRequestObject2 = objetoAjax();
    if (XMLHttpRequestObject2) {
        XMLHttpRequestObject2.open('POST', '../Controlador/C_AdministradorServicioYProductos.php', false);
        XMLHttpRequestObject2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        XMLHttpRequestObject2.onreadystatechange = function() {
            if (XMLHttpRequestObject2.readyState == 4 && XMLHttpRequestObject2.status == 200) {
                respuesta = new Array(XMLHttpRequestObject2.responseXML, XMLHttpRequestObject2.responseText);
                //alert(XMLHttpRequestObject2.responseText+","+parametros+","+respuesta);                
            }
        }
        XMLHttpRequestObject2.send(parametros);
    }
    return respuesta;
}

//Funcion para eliminar uno o varios servicios o productos
function eliminarServiciosOProductos(ids) {
    var respuesta = null;
    var dialogo=document.forms['Dialogo_AgregarProductoOServicio'];
    
    //Procesamos la cantidad de elementos seleccionados para ser eliminados:
    
    
    var parametros = "opcion=" + COP_4 + "&ids=" + ids;//Definimos la opcion que el controlador ejecutara   
    //alert(parametros);
    var XMLHttpRequestObject2 = objetoAjax();
    if (XMLHttpRequestObject2) {
        XMLHttpRequestObject2.open('POST', '../Controlador/C_AdministradorServicioYProductos.php', false);
        XMLHttpRequestObject2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        XMLHttpRequestObject2.onreadystatechange = function() {
            if (XMLHttpRequestObject2.readyState == 4 && XMLHttpRequestObject2.status == 200) {
                respuesta = new Array(XMLHttpRequestObject2.responseXML, XMLHttpRequestObject2.responseText);
                //alert(XMLHttpRequestObject2.responseText+","+parametros+","+respuesta);                
            }
        }
        XMLHttpRequestObject2.send(parametros);
    }
    return respuesta;
}

//===== MENSAJES =====
/*
 * Tomás Martínez Arenas
 * Código de llamada de mensajes.
 * Descripción: Carga el dialogo definido en base a un id de mensaje
 */
//Funcion para cargar la tag adecuada de mensaje
function cargarTagMensaje(identificador_mensaje,texto) {
    var respuesta = null;    
    var parametros = "idmsj=msj" + identificador_mensaje+"&texto="+texto ;//Definimos el mensaje que queremos mostrar
    var XMLHttpRequestObject2 = objetoAjax();
    if (XMLHttpRequestObject2) {
        XMLHttpRequestObject2.open('POST', '../Vista/DialogosMensaje_Administrador.php', false);
        XMLHttpRequestObject2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        XMLHttpRequestObject2.onreadystatechange = function() {
            if (XMLHttpRequestObject2.readyState == 4 && XMLHttpRequestObject2.status == 200) {
                respuesta = XMLHttpRequestObject2.responseText;                
            }
        }
        XMLHttpRequestObject2.send(parametros);
    }
    return respuesta;
}

//Funcion para mostrar mensaje
function mostrarMensaje(id,texto){
    
    var popup=document.createElement('div');
    popup.setAttribute('id','popup');
    popup.innerHTML=cargarTagMensaje(id,texto);
    popup.setAttribute('class', 'animacionAparecer');   
    document.body.appendChild(popup);
    
}

//Funcion para desaparecer mensaje
function ocultarMensaje(){    
    //alert('ocultar');
    var popup=document.getElementById('popup');    
    document.body.removeChild(popup);
    //popup.setAttribute('class', 'animacionDesaparecer');
    //var timer=setInterval(2000,function(){document.body.removeChild(popup);clearInterval(timer)});    
}
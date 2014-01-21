<?php

class FuncionesComunes {
    //put your code here
    
    public static function enviarPost($pagina, $datos){
        //set POST variables
        $url = $pagina;
        $fields = $datos;
        $fields_string ='';
        //url-ify the data for the POST
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
        rtrim($fields_string, '&');

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        $result=curl_getinfo($ch);
        
        //close connection
        curl_close($ch);
        
        return $result;
    }
    public static function obtenerMensaje($idMensaje){
        $respuesta='';
        $doc = new DOMDocument();
        $doc->load($GLOBALS['MENSAJES']);
        $mensajes = $doc->getElementsByTagName("mensaje");

        foreach ($mensajes as $item) {
            if ($item->getAttribute('id') == $idMensaje) {
                $respuesta="<mensaje descripcion='" . $item->getAttribute('descripcion') . "'";
                $respuesta.=" estado='" . $item->getAttribute('estado') . "'></mensaje>";
                break;
            }
        }
        return $respuesta;
    }
}

?>

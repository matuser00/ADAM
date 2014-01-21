<?php

class AdministradorServiciosYProductos {

    //put your code here
    private $doc = null;

    
    const AGREGAR_SERVICIO='0';//Codigo para agregar servicio.
    const CONSULTAR_SERVICIOSYPRODUCTOS='1';//Codigo para agregar servicio.
    const CONSULTAR_SERVICIOOPRODUCTO_PORID='2';//Codigo para consultar servicio o producto especifico.
    const MODIFICAR_SERVICIOOPRODUCTO='3';//Codigo para modificar propiedades de servicio o producto especifico.
    const ELIMINAR_PRODUCTOOSERVICIO='4';//Codigo para modificar propiedades de servicio o producto especifico.
    
    //Funcion para obtener todos los servicios y productos:
    public static function obtenerServiciosYProductos() {
        error_reporting(0);
        $serviciosproductos = "<elementos>";
        $mensajeRespuesta = '<mensaje';

        $con = @mysqli_connect($GLOBALS['DIRECCION_BD'], $GLOBALS['USUARIO_BD'], $GLOBALS['CONTRASENA_BD'], $GLOBALS['NOMBRE_BD']);

       
        // Check connection
        if (mysqli_connect_errno() || !$con) {
            //Mensaje de  fallo de conexion a bd           
            $mensajeRespuesta=  FuncionesComunes::obtenerMensaje('db0003');
        } else {


            $sql = "SELECT * FROM serviciosyproductos";
            $result = mysqli_query($con, $sql);
            //$serviciosproductos= array();

            if ($result) {
                if($result->num_rows==0){
                    //Mensaje de no hay registros en la tabla:
                    $mensajeRespuesta=  FuncionesComunes::obtenerMensaje('db0002');
                }else{
                     //Mensaje de operacion exitosa
                    $mensajeRespuesta=  FuncionesComunes::obtenerMensaje('db0000');
                }
                
                while ($row = mysqli_fetch_array($result)) {
                    //Configuramos el nuevo serviciooproducto
                    $nuevo = "<serviciooproducto ";
                    $nuevo.="id='" . $row['id'] . "' ";
                    $nuevo.="nombre='" . $row['nombre'] . "' ";
                    $nuevo.="precio='" . $row['precio'] . "'></serviciooproducto>";
                    //$serviciosproductos[$indice]=$nuevo;                    
                    $serviciosproductos.=$nuevo;
                }
            } else {
                //Mensaje de que no hay registros en la tabla
                $mensajeRespuesta=  FuncionesComunes::obtenerMensaje('db0002');
            }
        }
        if ($con) {
            mysqli_close($con);
        }

        $serviciosproductos.="</elementos>";
        $respuesta = "<respuesta>\n\t\t" . $mensajeRespuesta . "\n\t\t" . $serviciosproductos . "\n\t\t</respuesta>\n\r";
        $xmlrespuesta = new SimpleXMLElement($respuesta);

        //return $respuesta;
        return $xmlrespuesta->asXML();
    }

    //Funcion para agregar servicio o producto:
    public static function agregarServicioOProducto($nuevoelemento){
         //error_reporting(0);
        $con = @mysqli_connect($GLOBALS['DIRECCION_BD'], $GLOBALS['USUARIO_BD'], $GLOBALS['CONTRASENA_BD'], $GLOBALS['NOMBRE_BD']);
        $mensajeRespuesta='';
        // Check connection
        if (mysqli_connect_errno() || !$con) {
            //Mensaje de  fallo de conexion a bd           
            $mensajeRespuesta=  FuncionesComunes::obtenerMensaje('db0003');
        } else {
             $sql = "CALL agregarServicioOProducto('".$nuevoelemento->nombre."',".$nuevoelemento->precio.")";
             $result = mysqli_query($con, $sql);
             
             if($result){
                $mensajeRespuesta=  FuncionesComunes::obtenerMensaje('db0005');
             }else{
                 $mensajeRespuesta=  FuncionesComunes::obtenerMensaje('db0004');
             }             
        }
        
         if ($con) {
            mysqli_close($con);
        }
        
         $xmlrespuesta = new SimpleXMLElement($mensajeRespuesta);
        //return $respuesta;
        return $xmlrespuesta->asXML();
    }
    
    //Funcion para obtener servicio o producto por id:
    public static function obtenerServicioOProducto_PorId($id) {
        $serviciosproductos="<elementos>";
        error_reporting(0);        
        $con = @mysqli_connect($GLOBALS['DIRECCION_BD'], $GLOBALS['USUARIO_BD'], $GLOBALS['CONTRASENA_BD'], $GLOBALS['NOMBRE_BD']);         
        // Check connection
        if (mysqli_connect_errno() || !$con) {
            //Mensaje de  fallo de conexion a bd           
            $mensajeRespuesta=  FuncionesComunes::obtenerMensaje('db0003');
        } else {


            $sql = "SELECT * FROM serviciosyproductos WHERE id=".$id;
            $result = mysqli_query($con, $sql);
            //$serviciosproductos= array();
            
            if ($result) {
                if($result->num_rows==0){
                    //Mensaje de no hay registros en la tabla:
                    $mensajeRespuesta=  FuncionesComunes::obtenerMensaje('db0002');
                }else{
                     //Mensaje de operacion exitosa
                    $mensajeRespuesta=  FuncionesComunes::obtenerMensaje('db0000');
                }                
                while ($row = mysqli_fetch_array($result)) {
                    //Configuramos el nuevo serviciooproducto
                    $nuevo = "<serviciooproducto ";
                    $nuevo.="id='" . $row['id'] . "' ";
                    $nuevo.="nombre='" . $row['nombre'] . "' ";
                    $nuevo.="precio='" . $row['precio'] . "'></serviciooproducto>";
                    //$serviciosproductos[$indice]=$nuevo;                    
                    $serviciosproductos.=$nuevo;
                }
            } else {
                //Mensaje de que no hay registros en la tabla
                $mensajeRespuesta=  FuncionesComunes::obtenerMensaje('db0002');
            }
        }
         if ($con) {
            mysqli_close($con);
         }
         
         $serviciosproductos.="</elementos>";
         $respuesta = "<respuesta>\n\t\t" . $mensajeRespuesta . "\n\t\t" .$serviciosproductos. "\n\t\t</respuesta>\n\r";
         $xmlrespuesta = new SimpleXMLElement($respuesta);
        //return $respuesta;
        return $xmlrespuesta->asXML();
    }
    
    
    //Funcion para modificar servicio o producto:
     public static function modificarServicioOProducto($serviciooproducto) {       
        error_reporting(0);        
        $con = @mysqli_connect($GLOBALS['DIRECCION_BD'], $GLOBALS['USUARIO_BD'], $GLOBALS['CONTRASENA_BD'], $GLOBALS['NOMBRE_BD']);         
        // Check connection
        if (mysqli_connect_errno() || !$con) {
            //Mensaje de  fallo de conexion a bd           
            $mensajeRespuesta=  FuncionesComunes::obtenerMensaje('db0003');
        } else {

            
            $sql = "UPDATE serviciosyproductos SET nombre='".$serviciooproducto->nombre."',precio=".$serviciooproducto->precio." WHERE id=".$serviciooproducto->id;
            $result = mysqli_query($con, $sql);
            //$serviciosproductos= array();
            
            if ($result) {               
                     //Mensaje de operacion exitosa
                    $mensajeRespuesta=  FuncionesComunes::obtenerMensaje('db0006');               
            } else {
                //Mensaje de que no hay registros en la tabla
                $mensajeRespuesta=  FuncionesComunes::obtenerMensaje('db0004');
            }
        }
         if ($con) {
            mysqli_close($con);
         }         
        
         $respuesta = "<respuesta>" . $mensajeRespuesta . "</respuesta>";
         $xmlrespuesta = new SimpleXMLElement($respuesta);
        //return $respuesta;
        return $xmlrespuesta->asXML();
    }
    
    //Funcion para eliminar un servicio o producto especifico:
     public static function eliminarServicioOProducto($id) {       
        error_reporting(0); 
        $masinfo="<masinfo>";
        $con = @mysqli_connect($GLOBALS['DIRECCION_BD'], $GLOBALS['USUARIO_BD'], $GLOBALS['CONTRASENA_BD'], $GLOBALS['NOMBRE_BD']);         
        // Check connection
        if (mysqli_connect_errno() || !$con) {
            //Mensaje de  fallo de conexion a bd           
            $mensajeRespuesta=  FuncionesComunes::obtenerMensaje('db0003');
        } else {

            if(count($id)>1)
                $sql = "DELETE FROM serviciosyproductos WHERE id IN ((".$id[1].")";
            else
                $sql = "DELETE FROM serviciosyproductos WHERE id IN ((".$id[0].")";
            //$sqlAND="";
            
           
            for ($i=2;$i<count($id);$i++){
                //$sqlAND.=" AND id='".$id[$i]."'";
                $sql.= ",(".$id[$i].")";
            }
            $sql.=")";
             $masinfo.=$sql.":-:".count($id).":-:[0]".$id[0].":-:[1]";
            $result = mysqli_query($con, $sql);
            //$serviciosproductos= array();
            
            if ($result) {               
                     //Mensaje de operacion exitosa
                    $mensajeRespuesta=  FuncionesComunes::obtenerMensaje('db0007');               
            } else {
                //Mensaje de que no hay registros en la tabla
                $mensajeRespuesta=  FuncionesComunes::obtenerMensaje('db0008');
            }
        }
         if ($con) {
            mysqli_close($con);
         }         
         $masinfo.="</masinfo>";
         $respuesta = "<respuesta>" . $mensajeRespuesta . "</respuesta>";
         $xmlrespuesta = new SimpleXMLElement($respuesta);
        //return $respuesta;
        return $xmlrespuesta->asXML();
    }
}
?>
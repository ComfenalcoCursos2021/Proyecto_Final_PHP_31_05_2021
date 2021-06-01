<?php
include "Api/Configuracion/servicio_config.php";
class Api extends getinst{
    static function getGetinst(){
        return ('getinst'.'::Getinst')(get_class(),func_get_args());
    }
    public function METHOD(){
        $arg = ([$this, 'GetParam'])(get_class(),__FUNCTION__,func_get_args());
        switch ($arg->METHOD) {
            case 'GET':
                if($arg->GET){
                    $permiso = ([$this, 'GetParam'])(get_class(),apache_request_headers()['Time'],func_get_args());
                    if(!empty($permiso)){
                        include "Entidades/paquete_".$permiso->Clase.".php";
                        ([$permiso->Clase::getGetinst(), $permiso->Method])(json_decode(file_get_contents("php://input"), true));
                    }
                    
                }
                break;
            case 'PATCH':
                    return $this->Generar_Token();
                break;
            default:
                print_r("Metodo no permitido");
                break;
        }
    }
    private function Generar_Token(){
        $obj = new stdClass();
        $obj->marca = (string) $_SERVER['REQUEST_TIME'];
        $obj->llave =  (string) crypt($obj->marca, __FUNCTION__);
        $obj->opciones = [
            'cost' => 15,
        ];
        $obj->hash = password_hash($obj->llave, PASSWORD_BCRYPT , $obj->opciones);
        return json_encode($obj,JSON_PRETTY_PRINT);
        // if (password_verify($marca, $hash)) {
        //     echo '¡La contraseña es válida!';
        // } else {
        //     echo 'La contraseña no es válida.';
        // }
    }
}
print_r(Api::getGetinst()->METHOD(["METHOD" => $_SERVER['REQUEST_METHOD']]));
?>
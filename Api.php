<?php
// header("content-type: application/json");
include "Api/Configuracion/servicio_config.php";
class Api extends getinst{
    static function getGetinst(){
        return ('getinst'.'::Getinst')(get_class(),func_get_args());
    }
    public function METHOD():string{
        $arg = ([$this, 'GetParam'])(get_class(),__FUNCTION__,func_get_args());
        switch ($arg->METHOD) {
            case 'GET':
                if($arg->GET){
                    $permiso = ([$this, 'GetParam'])(get_class(),apache_request_headers()['Time'],func_get_args());
                    if(!empty($permiso) &&  $this->Validar_Token(apache_request_headers(), $permiso)){
                        include "Entidades/paquete_".$permiso->Clase.".php";
                        return ([$permiso->Clase::getGetinst(), $permiso->Method])(null);
                    }
                }
                break;
            case 'POST':
                if($arg->POST){
 
                    $permiso = ([$this, 'GetParam'])(get_class(),apache_request_headers()['Time'],func_get_args());
                    if(!empty($permiso) &&  $this->Validar_Token(apache_request_headers(), $permiso)){
                        include "Entidades/paquete_".$permiso->Clase.".php";
                        return ([$permiso->Clase::getGetinst(), $permiso->Method])(json_decode(file_get_contents("php://input"), true));
                    }
                    
                }
                break;
            case 'PATCH':
                    echo $this->Generar_Token();
                    return '';
                break;
            default:
                return "Metodo no permitido";
                break;
        }
    }
    private function Validar_Token():bool{
        $Headers = new stdClass();
        $Headers->apache = (object) func_get_args()[0];
        $Headers->permiso = (object) func_get_args()[1];
        if(!empty($Headers->permiso->id)){
            if (password_verify($Headers->apache->Hash, json_decode($this->Generar_Token($Headers->apache))->hash)) {
                return true;
            }
            return false;
        }
        
    }
    private function Generar_Token():string{
        $obj = new stdClass();
        if(func_num_args()!=0){
            $obj->marca = (string) func_get_args()[0]->Time;
            $obj->llave =  (string) crypt($obj->marca, __FUNCTION__);
            if(!($obj->llave == func_get_args()[0]->Hash)){
                return json_encode(["hash" => "Error"], JSON_PRETTY_PRINT);
            }
        }else{
            $obj->marca = (string) $_SERVER['REQUEST_TIME'];
            $obj->llave =  (string) crypt($obj->marca, __FUNCTION__);
        }
        $obj->opciones = [
            'cost' => 15,
        ];
        $obj->hash = password_hash($obj->llave, PASSWORD_BCRYPT , $obj->opciones);
        return json_encode($obj,JSON_PRETTY_PRINT);
    }
}
echo json_encode(["PLANTILLA"=> Api::getGetinst()->METHOD(["METHOD" => $_SERVER['REQUEST_METHOD']])],JSON_PRETTY_PRINT);
?>
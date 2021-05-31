<?php
    include "Serivicios/servicio_inst.php";

    class getinst{
        static $Get = null;
        static $fichero;
        static function Getinst($get_class):mixed{
            self::$fichero = json_decode(file_get_contents('../Api/Configuracion/config.json'), true);
            self::$Get = new stdClass();
            if(isset(self::$fichero[$get_class]['id'])){
                self::$Get->{set::inst[self::$fichero[$get_class]['id']]} = null;
                return self::$Get->{set::inst[self::$fichero[$get_class]['id']]} = (!(self::$Get->{set::inst[self::$fichero[$get_class]['id']]} instanceof self))?
                                new $get_class
                                : self::$Get->{set::inst[self::$fichero[$get_class]['id']]};
            }else{
                self::$Get->Messages = self::$fichero['Messages']['Clase'];
                return self::$Get;
            }
        }
        // static function getParam():mixed{
        //     $Param = json_decode(file_get_contents("config.json"), true)['Clase123']['Metodo123']['Param_Opcionales'];
        //     $arg = (func_num_args()!=0) ? (object) func_get_args()[0]: new stdClass();
        //     foreach ($Param as $key => $value) {
        //         if(isset($arg->{$key})) continue;
        //         else $arg->{$key} = $value;
        //     }
        //     return $arg;
        // }
        public function saludar(){
            return "Saludo config";
        }
    }




?>
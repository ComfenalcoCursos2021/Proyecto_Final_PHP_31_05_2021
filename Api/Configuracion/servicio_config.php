<?php
    class getinst{
        static $Get = null;
        static $fichero;
        static function Getinst(string $get_class):object{
            self::$fichero = json_decode(file_get_contents('Api/Configuracion/config.json'), true);
            self::$Get = new stdClass();
            self::$Get->{$get_class} = null;
            if(!(self::$Get instanceof self)){
                self::$Get->{$get_class} = new $get_class;
            }
            return  self::$Get->{$get_class};
        }
        protected function GetParam(string $get_class, string $get_function):object{
            $arg = (!empty(func_get_arg(2))) ? (object) func_get_args()[2][0]: new stdClass();
            foreach (self::$fichero[$get_class][$get_function]['Param_Opcionales'] as $key => $value) {
                if(isset($arg->{$key})) continue;
                else $arg->{$key} = $value;
            }
            return $arg;
        }
    }




?>
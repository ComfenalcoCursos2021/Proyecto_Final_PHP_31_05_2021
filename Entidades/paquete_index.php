<?php
include "../Api/Configuracion/servicio_config.php";
class index extends getinst{
    static function getGetinst(){
        return getinst::Getinst(get_class());
    }
    public function saludar(){
        return "Saludo index";
    }
}
// print_r(index::getGetinst()->saludar());
print_r($_SERVER['REQUEST_TIME'])
?>
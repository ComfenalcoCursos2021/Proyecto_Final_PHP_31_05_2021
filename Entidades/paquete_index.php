<?php


// header("content-type: application/json");
class index extends getinst{
    static function getGetinst(){
        return ('getinst'.'::Getinst')(get_class(),func_get_args());
    }
    public function Logo(){
        print_r(([$this, 'GetParam'])(get_class(),__FUNCTION__,func_get_args()));
    }
}


?>
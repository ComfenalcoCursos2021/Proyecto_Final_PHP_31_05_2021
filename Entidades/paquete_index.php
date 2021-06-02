<?php
class index extends getinst{
    private $plantilla;
    private $plantilla2;
    static function getGetinst(){
        return ('getinst'.'::Getinst')(get_class(),func_get_args());
    }
    public function Logo(){
        $param = (object) ([$this, 'GetParam'])(get_class(),__FUNCTION__,func_get_args());
        $this->plantilla = (string) <<<HTML_LOGO
            <span class="font-weight-bold">${!${''} = $param->Nombre}</span> ${!${''} = $param->Apellidos}
        HTML_LOGO;
        return $this->plantilla;
    }
    public function Menu(){
        $param = (object) ([$this, 'GetParam'])(get_class(),__FUNCTION__,func_get_args());
        $this->plantilla = (string) <<<HTML_MENU
            <li class="nav-item ">
                <a class="nav-link text-light" target="_blank" href="${!${''} = $param->MENU_PC[0]["Enlace"]}">${!${''} = $param->MENU_PC[0]["Nombre"]}</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link text-light" target="_blank" href="${!${''} = $param->MENU_PC[1]["Enlace"]}">${!${''} = $param->MENU_PC[0]["Nombre"]}</a>
            </li>
        HTML_MENU;
        $this->plantilla2 = (string) <<<HTML_MENU
            <li class="mb-5">
                <a href="${!${''} = $param->MENU_MOVIL[0]["Enlace"]}" class="text-decoration-none display-4 text-light">${!${''} = $param->MENU_MOVIL[0]["Nombre"]}</a>
            </li>
            <li class="mb-5">
                <a href="${!${''} = $param->MENU_MOVIL[1]["Enlace"]}" class="text-decoration-none display-4 text-light">${!${''} = $param->MENU_MOVIL[1]["Nombre"]}</a>
            </li>
        HTML_MENU;
        $obj = new stdClass();
        $obj->PC = $this->plantilla;
        $obj->MOVIL = $this->plantilla2;
        return json_encode($obj,JSON_PRETTY_PRINT);
    }
}


?>
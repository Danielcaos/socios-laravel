<?php

class loginControl extends Controller{
    
    function __construct(){
        parent::__construct();
    }

    function render($ubicacion = null)
    {

        $constr = "login";
        if (isset($ubicacion[0])) {
            $this->view->render($constr, $ubicacion[0]);
        } else {
            $this->view->render($constr, 'index');
        }
    }

    function validarDatos($param){
        if($param==null)return;
            $valor = array();
            $documento_user = $param[0];
            //echo($documento_user);
            $_SESSION["documento"] = $documento_user;
            $password_user = $param[1];
            //echo($password_user);

            $valor[0] = $_SESSION["documento"];
            //echo($valor[0]);
            //echo($documento_user);
            $valor[1] = $this->model->verificarUser($documento_user, $password_user);
            echo json_encode($valor);
    }

    function cerrarSesion(){
        unset($_SESSION['documento']);
        session_destroy();
        header('Location: ' . constant('URL'). 'loginControl');
    }

}

?>
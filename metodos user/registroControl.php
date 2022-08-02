<?php

    class registroControl extends Controller{
        function __construct(){
            parent::__construct();
            if (!isset($_SESSION['documento'])) {
                header('Location: ' . constant('URL') . 'loginControl');
                return;
            }
        }

        function render($ubicacion = null){
            $constr = "registro";

            if(isset($ubicacion[0])){
                $this->view->render($constr , $ubicacion[0]);
            }else{
                $this->view->render($constr, 'index');}
        }


        function registrog(){
            $cedula = $_POST['cedula'];
            $nombre = $_POST['nombre'];
            $ciudad = $_POST['ciudad'];
            $contacto = $_POST['contacto'];          
        
            $temp = $this->model->insertarInvitado(['cedula_invitado'=>$cedula, 'nombre_invitado'=>$nombre, 'ciudad_invitado'=>$ciudad, 'contacto_invitado'=>$contacto]);
            echo json_encode($temp);
        }
    }


?>
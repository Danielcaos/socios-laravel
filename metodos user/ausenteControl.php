<?php



class ausenteControl extends Controller{
    function __construct(){
        parent::__construct();
        if (!isset($_SESSION['documento'])) {
            header('Location: ' . constant('URL') . 'loginControl');
            return;
        }
    }

    function render($ubicacion = null){
        $constr = "ausente";

        if(isset($ubicacion[0])){
            $this->view->render($constr , $ubicacion[0]);
        }else{
            $this->view->render($constr, 'index');}
    }

    function ausenteg(){
        $codigo = $_POST['codigo'];
        $dias = $_POST['dias'];
        $fecha = $_POST['fecha'];
        $diasAusente = "90";
        $hoy = getdate();
        $fechaIni = $hoy['year'].'-01-01';
        $fechaFin = $hoy['year'].'-12-31';

        $temp3 = $this->model->verificarIngresos($codigo, $fechaIni, $fechaFin);

        $temp2 = $this->model->verificarAusente($codigo);
        if(!$temp2){
            echo json_encode([false, 'El Socio no es valido']);
            return;
        }else{
            if(($temp3+$dias) > $diasAusente){
                echo json_encode([false, 'El numero de dias es superior a los habiles. Dias restantes: '.($diasAusente-$temp3)]);
                return;
            }else{
                $diasv = '1';
                $fechaIngresos = '';
                $aux = date_create($hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday']-1);
                for($i = 0; $i < $dias; $i++){
                    date_add($aux, date_interval_create_from_date_string($diasv." days"));
                    $fechasIngresos  = (string)date_format($aux,"Y-m-d");
                    $temp = $this->model->insertarAusente(['cod_socio_ausente'=>$codigo, 'dias_ausente'=>$diasv, 'fecha_ingre_ausente'=>$fechasIngresos]);
                }
                echo json_encode([true, $temp]);
                return;
            }
        }
    }

}


?>
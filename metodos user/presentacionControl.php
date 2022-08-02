<?php

    class presentacionControl extends Controller{
        function __construct(){
            parent::__construct();
            if (!isset($_SESSION['documento'])) {
                header('Location: ' . constant('URL') . 'loginControl');
                return;
            }
        }

        function render($ubicacion = null){
            $constr = "presentacion";
            if(isset($ubicacion[0])){
                $this->view->render($constr , $ubicacion[0]);
            }else{
                $this->view->render($constr, 'index');}
        }

        /* Presentacion del invitado y validacion de requisitos */
        function presentaciong(){
            $codigo = $_POST['codigoi'];
            $cedula = $_POST['cedulai'];
            $fecha = $_POST['fechai'];
            $dias = $_POST['diasi'];
            $tipo = $_POST['tipoi'];
            $fechaIni = '';
            $fechaFin = '';
            $pibot = '';
            $diasCucuta = "2";
            $diasExterior = "60";

            $hoy = getdate();
            if($hoy['mon'] == 1){
                $fechaIni = $hoy['year'].'-0'.$hoy['mon'].'-01';
                $pibot = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                $fechaFin  = date("Y-m-t", strtotime($pibot));
            }else
            if($hoy['mon'] == 2){
                $fechaIni = $hoy['year'].'-0'.$hoy['mon'].'-01';
                $pibot = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                $fechaFin  = date("Y-m-t", strtotime($pibot));
            }else
            if($hoy['mon'] == 3){
                $fechaIni = $hoy['year'].'-0'.$hoy['mon'].'-01';
                $pibot = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                $fechaFin  = date("Y-m-t", strtotime($pibot));
            }else
            if($hoy['mon'] == 4){
                $fechaIni = $hoy['year'].'-0'.$hoy['mon'].'-01';
                $pibot = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                $fechaFin  = date("Y-m-t", strtotime($pibot));
            }else
            if($hoy['mon'] == 5){
                $fechaIni = $hoy['year'].'-0'.$hoy['mon'].'-01';
                $pibot = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                $fechaFin  = date("Y-m-t", strtotime($pibot));
            }else
            if($hoy['mon'] == 6){
                $fechaIni = $hoy['year'].'-0'.$hoy['mon'].'-01';
                $pibot = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                $fechaFin  = date("Y-m-t", strtotime($pibot));
            }else
            if($hoy['mon'] == 7){
                $fechaIni = $hoy['year'].'-0'.$hoy['mon'].'-01';
                $pibot = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                $fechaFin  = date("Y-m-t", strtotime($pibot));
            }else
            if($hoy['mon'] == 8){
                $fechaIni = $hoy['year'].'-0'.$hoy['mon'].'-01';
                $pibot = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                $fechaFin  = date("Y-m-t", strtotime($pibot));
            }else
            if($hoy['mon'] == 9){
                $fechaIni = $hoy['year'].'-0'.$hoy['mon'].'-01';
                $pibot = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                $fechaFin  = date("Y-m-t", strtotime($pibot));
            }else
            if($hoy['mon'] == 10){
                $fechaIni = $hoy['year'].'-'.$hoy['mon'].'-01';
                $pibot = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                $fechaFin  = date("Y-m-t", strtotime($pibot));
            }else
            if($hoy['mon'] == 11){
                $fechaIni = $hoy['year'].'-'.$hoy['mon'].'-01';
                $pibot = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                $fechaFin  = date("Y-m-t", strtotime($pibot));
            }else
            if($hoy['mon'] == 12){
                $fechaIni = $hoy['year'].'-'.$hoy['mon'].'-01';
                $pibot = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                $fechaFin  = date("Y-m-t", strtotime($pibot));
            }
            /* Se encarga de contar los ingresos del invitado !CUCUTA*/
            $inicioAnio = $hoy['year'].'-01-01';
            $finAnio = $hoy['year'].'-12-31';
            $temp6 = $this->model->verificarIngresos($cedula, $tipo, $inicioAnio, $finAnio);

            /* Se encarga de contar los ingresos del invitado CUCUTA*/
            $temp5 = $this->model->verificarIngresos($cedula, $tipo, $fechaIni, $fechaFin);

            /* Se encarga de verificar la ciudad del invitado */
            $temp4 = $this->model->verificarCiudad($cedula);

            /* Se encarga de verificar que el socio sea valido */
            $temp3 = $this->model->verificarSocio($codigo);

            /* Se encarga de verifical que el invitado exista */
            $temp2 = $this->model->verificarUser($cedula);

            if($temp2){
                if(!$temp3){
                    echo json_encode([false, 'El Socio no es valido']);
                    return;
                }else{
                    if($temp4 && ($temp5+$dias) > $diasCucuta){
                        echo json_encode([false, 'El numero de dias es superior a los habiles. Dias restantes: '.($diasCucuta-$temp5)]);
                        return;
                    }else
                    if(!$temp4 && ($temp6+$dias) > $diasExterior){
                        echo json_encode([false, 'El numero de dias es superior a los habiles. Dias restantes: '.($diasExterior-$temp6)]);
                        return;
                    }else{
                        $diasv = '1';
                        $fechaIngresos = '';
                        $aux = date_create($hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday']-1);
                        for($i = 0; $i < $dias; $i++){
                            date_add($aux, date_interval_create_from_date_string($diasv." days"));
                            $fechasIngresos  = (string)date_format($aux,"Y-m-d");
                            $temp = $this->model->insertarPresentacion(['codigo_socio_pres'=>$codigo, 'cedula_invitado_pres'=>$cedula, 'fecha_pres_invitado'=>$fechasIngresos, 'num_dias_pres'=>$diasv, 'tipo_pres'=>$tipo]);
                        }
                        echo json_encode([true, $temp]);
                        return;
                    }
                }
                
            }else{
                echo json_encode([false, 'El invitano no esta registrado']);
                return;
            }

        }

        /* registri de restaurante */
        function alimentog(){
            $codigo = $_POST['codigob'];
            $cedula = $_POST['cedulab'];
            $fecha = $_POST['fechab'];
            $dias = '';
            $tipo = $_POST['tipob'];

            $temp2 = $this->model->verificarUser($cedula);
            $temp3 = $this->model->verificarSocio($codigo);
            if($temp2){
                if(!$temp3){
                    echo json_encode([false, 'El Socio no es valido']);
                    return;
                }else{
                    $temp = $this->model->insertarPresentacion(['codigo_socio_pres'=>$codigo, 'cedula_invitado_pres'=>$cedula, 'fecha_pres_invitado'=>$fecha, 'num_dias_pres'=>$dias, 'tipo_pres'=>$tipo]);
                    echo json_encode([true,$temp]);
                    return;
                }
            }else{
                echo json_encode([false, 'El invitano no esta registrado']);
                return;
            }
        }

    }

?>
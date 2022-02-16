<?php

    
    use repositories\CitaRepository;
    require_once("./repositories/CitaRepository.php");

    class CitaController{
        public function nueva(){
            require_once('./views/citas/form_citas.php');
            $_SESSION['errorCit']=['','',''];
        }

        public function anadir(){
            $idPac = $_SESSION['usuario']->getId();
            $idDoc = $_POST['doctor'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $registrar = true;


            $_SESSION['errorCit']=['','',''];

            if(empty($idDoc)){
                $registrar = false;
                $_SESSION['errorCit'][0] = "El doctor es obligatorio";
            }

            if(empty($fecha)){
                $registrar = false;
                $_SESSION['errorCit'][1] = "La fecha es obligatoria";
            }

            if(empty($hora)){
                $registrar = false;
                $_SESSION['errorCit'][2] = "La hora es obligatoria";
            }

            if($registrar == false){
                $url = base_url.'cita/nueva';
                header("Location: ".$url);
            }else{
                $citaRepository = new CitaRepository();
                $citaRepository->insertar($idPac,$idDoc,$fecha,$hora);
            }
        }

        public function mostrarTodas(){
            $citaRepository = new CitaRepository();
            $todos = $citaRepository->getAll();
            return $todos;
        }

        public function mostrar(){
            require_once('./views/citas/todas_citas.php');
        }

        public function borrar(){
            $citaRepository = new CitaRepository();

            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $citaRepository->delete($id);

                header("Location: ".base_url."cita/mostrar");
            }else{
                echo("Error");
                var_dump($_GET['id']);
            }
        }
    }

?>
<?php

use repositories\DoctorRepository;

    require_once('./models/Doctor.php');
    require_once('./repositories/DoctorRepository.php');

    class DoctorController{

        public function anadir(){
            $_SESSION['errorDoc']=['','','',''];
            require_once('./views/doctor/anadir.php');
        }

        public function save(){
            $nombre = $_POST['nomDoc'];
            $apellidos = $_POST['apDoc'];
            $telefono = $_POST['tlfDoc'];
            $especialidad = $_POST['espDoc'];
            $registrar = true;


            $_SESSION['errorDoc']=['','','',''];

            if(empty($nombre)){
                $registrar = false;
                $_SESSION['errorDoc'][0] = "El nombre es obligatorio";
            }

            if(empty($apellidos)){
                $registrar = false;
                $_SESSION['errorDoc'][1] = "Los apellidos son obligatorios";
            }

            if(empty($telefono)){
                $registrar = false;
                $_SESSION['errorDoc'][2] = "El telefono es obligatorio";
            }

            if(empty($especialidad)){
                $registrar = false;
                $_SESSION['errorDoc'][3] = "La especialidad es obligatoria";
            }

            if($registrar == false){
                $url = base_url.'doctor/anadir';
                header("Location: ".$url);
            }else{
                $docRepository = new DoctorRepository();
                $docRepository->insertar($nombre,$apellidos,$telefono,$especialidad);
            }
    }

    public function mostrarTodos(){
        $docRepository = new DoctorRepository();
        $todos = $docRepository->getAll();
        return $todos;
    }

    public function getById($id){
        $docRepository = new DoctorRepository();
        $nombre = $docRepository->getNombreById($id);
        return $nombre['nombre'];
    }
}

?>
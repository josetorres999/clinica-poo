<?php
namespace repositories;

use config\Database;
use models\Doctor;
use PDOStatement;
use PDO;
use PDOException;

class DoctorRepository{
        public function __construct(){

        }


        public static function getAll(){
            $db = new Database;
            $query = "SELECT * FROM doctores";
            $db->consulta($query);
            $res = $db->extraerRegistro();

            return $res;
        }

        public function insertar($nombre,$apellidos,$tlf,$esp){
            $db = new Database();
            $query = $db->conexion->prepare("INSERT INTO doctores VALUES(null,:nombre,:apellidos,:telefono,:especialidad)");
            $query->bindParam(':nombre',$nombre);
            $query->bindParam(':apellidos',$apellidos);
            $query->bindParam(':telefono',$tlf);
            $query->bindParam(':especialidad',$esp);

            $query->execute();

            return $query->fetch(PDO::FETCH_ASSOC);
        }

        public function getById($id){
            try{
                $db = new Database();
                $query = $db->conexion->prepare("SELECT * FROM pacientes WHERE id=:id");
                $query->bindParam(':id',$id);
                $query->execute();
                $resultado = $query->fetchAll(PDO::FETCH_CLASS, Doctor::class);
                return $resultado;
            }catch(PDOException $pdo){
                echo("Hubo en error al recuperar la informacion: ".$pdo->getMessage());
            }
        }

        public function getNombrebyId($id){
            try{   
                $db = new Database();
                $query = $db->conexion->prepare("SELECT nombre FROM doctores WHERE id=:id");
                $query->bindParam(":id",$id);
                $query->execute();
                $nombre = $query->fetchAll(PDO::FETCH_ASSOC);
                return $nombre[0];
            }catch(PDOException $pdo){

            }
        }
    }

?>
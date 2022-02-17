<?php
    namespace repositories;

    use config\Database;
    use PDO;



    class CitaRepository{
        
        public static function getAll(){
            $db = new Database;
            $query = "SELECT * FROM citas";
            $db->consulta($query);
            $res = $db->extraerRegistro();

            return $res;
        }

        public static function insertar($idPac, $idDoc, $fecha, $hora){
            $db = new Database;

            $query = $db->conexion->prepare("INSERT INTO citas VALUES(null,:idPac,:idDoc,:fecha,:hora)");
            $query->bindParam(':idPac',$idPac);
            $query->bindParam(':idDoc',$idDoc);
            $query->bindParam(':fecha',$fecha);
            $query->bindParam(':hora',$hora);

            $query->execute();

            return $query->fetch(PDO::FETCH_ASSOC);
        }

        public function delete($id){
            $db = new Database;

            $query = $db->conexion->prepare("DELETE FROM citas WHERE id=:id");
            $query->bindParam(':id',$id);

            $query->execute();
        }
    }


?>
<?php
class UserModel
{
    private $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function authenticate($username, $md5Password) {

        //consulta sql con pdo
        $sql = "SELECT * FROM usuarios WHERE username = :username AND password = :password AND status = 'Activo'";
        $smtp = $this->conn->prepare($sql);

        //Vinculamos los parametros
        $smtp->bindParam(':username', $username, PDO::PARAM_STR);
        $smtp->bindParam(':password', $md5Password, PDO::PARAM_STR);

        //Ejecutamos y obtenemos los resultados
        $smtp->execute();
        $data = $smtp->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getUserInfo($userId) {
        $sql = "SELECT id_user, name_user, foto, permisos_acceso FROM usuarios WHERE id_user = :userId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}

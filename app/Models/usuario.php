<?php 
class Usuario{
    public $id_usuario;
    public $nombre;
    public $contrasena;
    public $correo;
    public $tipo;
    public $telefono;
    public $direccion;

    public function __construct()
    {
        $this->tipo = "cliente";
    }

    public static function buscarUsuarioPorCorreo($correo){
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $usuario = null;
        $sql = "SELECT * FROM usuarios WHERE correo=?";
        $stmt = $mysqli->prepare($sql);
        if($stmt) {
            $stmt->bind_param("s", $correo);
            if($stmt->execute()) {
                $result = $stmt->get_result();//stdClass
                if($result->num_rows >= 1) {
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    $usuario = new Usuario();
                    $usuario->id_usuario=$row["id_usuario"];
                    $usuario->nombre=$row["nombre"];
                    $usuario->telefono=$row["telefono"];
                    $usuario->direccion=$row["direccion"];
                    $usuario->correo=$row["correo"];
                    $usuario->tipo=$row["tipo"];
                    $usuario->contrasena=$row["contrasena"];
                }
            }
            $stmt->close();
        } 
        $mysqli->close();
        return $usuario;
    }

    public function registrarUsuario(){
        $this->encriptarContrasena();
        $validacion = false;
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        $sql="INSERT INTO usuarios (nombre, telefono, direccion, correo, contrasena, tipo) values (?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($sql);
        if($stmt){
            $stmt->bind_param("ssssss", $this->nombre, $this->telefono, $this->direccion, $this->correo, $this->contrasena, $this->tipo);
            
            if($stmt->execute()){
                $validacion = true;
            }

            $stmt->close();
        } 
        $mysqli->close();
        return $validacion;
    }

    public function encriptarContrasena(){
        $this->contrasena = md5($this->contrasena);
    }

    public function editarUsuario($nuevaContraseña){
        $validacion = false;

        if($nuevaContraseña){
            $this->encriptarContrasena();
        }

        $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $sql="UPDATE usuarios SET nombre=?, telefono=?, direccion=?, correo=?, contrasena=? WHERE correo=?";
        $stmt = $mysqli->prepare($sql);
        if($stmt) {
            $stmt->bind_param("ssssss", $this->nombre, $this->telefono, $this->direccion, $this->correo, $this->contrasena, $this->correo);
            if($stmt->execute()) {
                $validacion = true;
            }
            $stmt->close();
        } 
        $mysqli->close();

        return $validacion;
    }
}
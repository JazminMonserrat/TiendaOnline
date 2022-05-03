<?php 
class Producto{
    public $id_producto;
    public $imagenProducto;
    public $nombre;
    public $descripcion;
    public $categoria;
    public $precio;
    public $cantidad;

    public function registrarProducto()
    {
        $validacion = false;
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        $sql="INSERT INTO productos (nombre, descripcion, categoria, cantidad, precio, imagenProducto) values (?,?,?,?,?,?);";
        $stmt = $mysqli->prepare($sql);
        if($stmt){
            $stmt->bind_param("sssids", $this->nombre, $this->descripcion, $this->categoria, $this->cantidad, $this->precio, $this->imagenProducto);
            
            if($stmt->execute()){
                $validacion = true;
            }

            $stmt->close();
        }
        $mysqli->close();
        return $validacion;
    }

    public static function buscarProducto($id){
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $producto = null;
        $sql = "SELECT * FROM productos WHERE id_producto = ?";
        $stmt = $mysqli->prepare($sql);
        if($stmt) {
            $stmt->bind_param("i", $id);
            if($stmt->execute()) {
                $result = $stmt->get_result();//stdClass
                if($result->num_rows >= 1) {
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    $producto = new Producto();
                    $producto->id_producto = $row["id_producto"];
                    $producto->nombre = $row["nombre"];
                    $producto->descripcion = $row["descripcion"];
                    $producto->categoria = $row["categoria"];
                    $producto->precio = $row["precio"];
                    $producto->cantidad = $row["cantidad"];
                    $producto->imagenProducto = $row["imagenProducto"];
                }
            }
            $stmt->close();
        }
        $mysqli->close();
        return $producto;
    }

    public function editarProducto(){
        $validacion = false;
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $sql="UPDATE productos SET nombre=?, descripcion=?, categoria=?, precio=?, cantidad=?, imagenProducto=? WHERE id_producto=?";
        $stmt = $mysqli->prepare($sql);
        if($stmt) {
            $stmt->bind_param("sssdisi", $this->nombre, $this->descripcion, $this->categoria, $this->precio, $this->cantidad, $this->imagenProducto, $this->id_producto);
            if($stmt->execute()) {
                $validacion = true;
            }
            $stmt->close();
        } 
        $mysqli->close();
        return $validacion;
    }

    public function eliminarProducto(){
        $validacion = false;
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $sql = "DELETE FROM productos WHERE id_producto = ?";
        $stmt = $mysqli->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $this->id_producto);
            if ($stmt->execute()) {
                $validacion = true;
            }
            $stmt->close();
        }
        $mysqli->close();
        return $validacion;
    }

    public static function buscarProductoPorClave($busqueda){
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $productos = [];
        $sql = "SELECT * FROM productos WHERE nombre like ?";
        $stmt = $mysqli->prepare($sql);
        if($stmt) {
            $busqueda = "%".$busqueda."%";
            $stmt->bind_param("s", $busqueda);
            if($stmt->execute()) {
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()) {
                    $producto = new Producto();
                    $producto->id_producto = $row["id_producto"];
                    $producto->nombre = $row["nombre"];
                    $producto->descripcion = $row["descripcion"];
                    $producto->categoria = $row["categoria"];
                    $producto->precio = $row["precio"];
                    $producto->cantidad = $row["cantidad"];
                    $producto->imagenProducto = $row["imagenProducto"];
                    $productos[] = $producto;
                }
            }
            $stmt->close();
        } 
        $mysqli->close();
        return $productos;
    }

    public static function buscarProductosDefault(){
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $productos = [];
        $sql = "SELECT * FROM productos";
        if($result = $mysqli->query($sql)){
            if($result->num_rows > 0){ 
                while($row = $result->fetch_array()){
                    $producto = new Producto();
                    $producto->id_producto = $row["id_producto"];
                    $producto->nombre = $row["nombre"];
                    $producto->descripcion = $row["descripcion"];
                    $producto->categoria = $row["categoria"];
                    $producto->precio = $row["precio"];
                    $producto->cantidad = $row["cantidad"];
                    $producto->imagenProducto = $row["imagenProducto"];
                    $productos[]=$producto;
                }   
            }
            $result->close();
        }
        $mysqli->close();
        return $productos;
    }
}
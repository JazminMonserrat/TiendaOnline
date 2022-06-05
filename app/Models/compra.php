<?php
class Compra
{
    public $id_compra;
    public $nombreCliente;
    public $productos;
    public $precioTotal;
    public $metodoPago;
    public $fecha;
    public $id_usuario;
    public $direccion;
    public $totalVendio;

    public function __construct()
    {
        $this->productos = [];
        //YYYY-MM-DD
    }

    public function registrarVenta()
    {
        $validacion = false;
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        $sql = "INSERT INTO ventas (total, direccion, nombreCliente, fechaVenta, totalVendio, id_usuario) values (?,?,?,?,?,?);";
        $stmt = $mysqli->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("dsssdi", $this->precioTotal, $this->direccion, $this->nombreCliente, $this->fecha, $this->totalVendio, $this->id_usuario);

            if ($stmt->execute()) {
                $validacion = true;
            }

            
            $stmt->close();

            $id = $mysqli->insert_id;

            $this->registrarProductosVentas($id, $mysqli);
            $this->registraPago($id,$mysqli);
        }
        $mysqli->close();
        return $validacion;
    }


    public function registrarProductosVentas($id, $mysqli)
    {
        foreach ($this->productos as $producto) {
            $subtotal = $producto->precio * $producto->cantidadVendida;
            $sql = "INSERT INTO venta_producto (id_venta, id_producto, cantidad, subtotal) values (?,?,?,?);";
            $stmt = $mysqli->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("iiid", $id, $producto->id_producto, $producto->cantidadVendida, $subtotal);
                $stmt->execute();
                $stmt->close();

                $this->restarInventario($producto->id_producto, $producto->cantidad - $producto->cantidadVendida, $mysqli);
            }
        }
    }

    public function restarInventario($id, $cantidad, $mysqli)
    {
        $validacion = false;
        $sql="UPDATE productos SET cantidad=? WHERE id_producto=?";
        $stmt = $mysqli->prepare($sql);
        if($stmt) {
            $stmt->bind_param("ii", $cantidad, $id);
            if($stmt->execute()) {
                $validacion = true;
            }
            $stmt->close();
        }
        return $validacion;
    }

    public function registraPago($id, $mysqli)
    {
        $validacion = false;
        $sql = "INSERT INTO pagos (referencia, total, cantidadComprada, tipo, id_venta) values (?,?,?,?,?);";
        $stmt = $mysqli->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sdisi", $this->metodoPago->referencia, $this->metodoPago->total, $this->metodoPago->cantidadComprada
            , $this->metodoPago->tipo, $id);
            if ($stmt->execute()) {
                $validacion = true;
            }
            $stmt->close();
        }

        return $validacion;
    }

    public static function obtenerHistorico($id){
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $compras = [];
        $sql = "SELECT * FROM ventas WHERE id_usuario = ?";
        $stmt = $mysqli->prepare($sql);
        if($stmt) {
            $stmt->bind_param("i", $id);
            if($stmt->execute()) {
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()) {
                    $compra = new Compra();
                    $compra->id_compra = $row["id_venta"];
                    $compra->nombreCliente = $row["nombreCliente"];
                    $compra->direccion = $row["direccion"];
                    $compra->precioTotal = $row["total"];
                    $compra->fecha = $row["fechaVenta"];
                    $compra->totalVendio = $row["totalVendio"];
                    $compra->id_usuario = $row["id_usuario"];
                    $compra->productos = Compra::obtenerProductosVenta($compra->id_compra, $mysqli);
                    $compras[] = $compra;
                }
            }
            $stmt->close();
        } 
        $mysqli->close();
        return $compras;
    }

    public static function obtenerProductosVenta($idVenta, $mysqli){
        $productos = [];
        $sql = "SELECT vp.cantidad as cantidad, p.nombre as nombre, p.imagenProducto as imagenProducto, p.id_producto as id_producto FROM productos p, venta_producto vp WHERE vp.id_venta = ? and p.id_producto = vp.id_producto";
        $stmt = $mysqli->prepare($sql);
        if($stmt) {
            $stmt->bind_param("i", $idVenta);
            if($stmt->execute()) {
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()) {
                    $producto = new Producto();
                    $producto->id_producto = $row["id_producto"];
                    $producto->nombre = $row["nombre"];
                    $producto->imagenProducto = $row["imagenProducto"];
                    $producto->cantidadVendida = $row["cantidad"];
                    $productos[] = $producto;
                }
            }
            $stmt->close();
        }
        return $productos;
    }
}

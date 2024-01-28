<?php

require_once 'db/Database.php';
require_once 'model/Model.php';

class Pedidos implements Model{
    private $id;
    private $fecha;
    private $id_cliente;
    private $direccion_entrega;
    private $total;


    /**
     * Get the value of id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha() {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     */
    public function setFecha($fecha): self {
        $this->fecha = $fecha;
        return $this;
    }

    /**
     * Get the value of id_cliente
     */
    public function getIdCliente() {
        return $this->id_cliente;
    }

    /**
     * Set the value of id_cliente
     */
    public function setIdCliente($id_cliente): self {
        $this->id_cliente = $id_cliente;
        return $this;
    }

    /**
     * Get the value of direccion_entrega
     */
    public function getDireccionEntrega() {
        return $this->direccion_entrega;
    }

    /**
     * Set the value of direccion_entrega
     */
    public function setDireccionEntrega($direccion_entrega): self {
        $this->direccion_entrega = $direccion_entrega;
        return $this;
    }

    /**
     * Get the value of total
     */
    public function getTotal() {
        return $this->total;
    }

    /**
     * Set the value of total
     */
    public function setTotal($total): self {
        $this->total = $total;
        return $this;
    }

 /**
     * Obtiene todos los pedidos con detalles de productos y clientes.
     *
     * @return PDOStatement
     */
    public function findAll() {
        $database = new Database('root', '', 'localhost', 3307);
        $db = $database->conectar();

        $query = "SELECT 
                    pedidos.id , 
                    pedidos.fecha, 
                    clientes.nombre AS cliente_nombre, 
                    pedidos.direccion_entrega, 
                    pedidos.total,
                    productos.precio,
                    productos.nombre AS producto_nombre,
                    clientes.dni,
                    pedidos_has_productos.cantidad
                  FROM pedidos
                  INNER JOIN clientes ON pedidos.id_cliente = clientes.id
                  INNER JOIN pedidos_has_productos ON pedidos.id = pedidos_has_productos.id_pedido
                  INNER JOIN productos ON pedidos_has_productos.id_producto = productos.id";

        $result = $db->query($query);
        $db = $database->desconectar();

        return $result;
    }

    /**
     * Obtiene los detalles de un pedido específico por ID de cliente.
     *
     * @param int $id - Identificador del cliente.
     * @return PDOStatement
     */
    public function findById($id) {
        $database = new Database('root', '', 'localhost', 3307);
        $db = $database->conectar();

        $query = "SELECT 
                    pedidos.id AS pedido_id, 
                    pedidos.fecha, 
                    clientes.nombre AS cliente_nombre,
                    clientes.apellido,
                    clientes.correo AS email, 
                    pedidos.direccion_entrega AS direccion, 
                    pedidos.total AS totalCompra,
                    productos.precio,
                    productos.id AS producto_id,
                    productos.nombre AS producto,
                    pedidos_has_productos.cantidad
                  FROM pedidos
                  INNER JOIN clientes ON pedidos.id_cliente = clientes.id
                  INNER JOIN pedidos_has_productos ON pedidos.id = pedidos_has_productos.id_pedido
                  INNER JOIN productos ON pedidos_has_productos.id_producto = productos.id
                  WHERE id_cliente = $id";

        $result = $db->query($query);
        $db = $database->desconectar();

        return $result;
    }

    /**
     * Obtiene los estados de todos los pedidos.
     *
     * @return PDOStatement
     */
    public function findEstados() {
        $database = new Database('root', '', 'localhost', 3307);
        $db = $database->conectar();

        $query = "SELECT 
                    pedidos.id AS pedido_id, 
                    estado.nombre AS estado_pedido,
                    pedido_has_estado.fecha AS fecha
                  FROM pedidos
                  INNER JOIN pedido_has_estado ON pedidos.id = pedido_has_estado.id_pedido
                  INNER JOIN estado ON pedido_has_estado.id_estado = estado.id";

        $result = $db->query($query);
        $db = $database->desconectar();

        return $result;
    }
}
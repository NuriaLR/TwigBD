<?php
require_once 'db/Database.php';

class Producto{

    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    
    

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
     * Get the value of nombre
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre($nombre): self {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     */
    public function setDescripcion($descripcion): self {
        $this->descripcion = $descripcion;
        return $this;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio() {
        return $this->precio;
    }

    /**
     * Set the value of precio
     */
    public function setPrecio($precio): self {
        $this->precio = $precio;
        return $this;
    }

    /**
     * Get the value of stock
     */
    public function getStock() {
        return $this->stock;
    }

    /**
     * Set the value of stock
     */
    public function setStock($stock): self {
        $this->stock = $stock;
        return $this;
    }


   /**
     * Obtiene todos los productos.
     *
     * @return PDOStatement
     */
    public function findAll() : PDOStatement {
        $database = new Database('root', '', 'localhost', 3307);
        $db = $database->conectar();
        $query = "SELECT * FROM productos";
        $result = $db->query($query);
        $db = $database->desconectar();
        return $result;
    }

    /**
     * Obtiene los detalles de un producto por ID.
     *
     * @param int $id - Identificador del producto.
     * @return PDOStatement
     */
    public function findById($id): PDOStatement {
        $database = new Database('root', '', 'localhost', 3307);
        $db = $database->conectar();
        $query = "SELECT * FROM productos WHERE id = $id";
        $result = $db->query($query);
        $db = $database->desconectar();
        return $result;
    }

    /**
     * Actualiza un producto por ID.
     *
     * @param int $id - Identificador del producto.
     * @return void
     */
    public function updateById($id): void {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];

        $database = new Database('root', '', 'localhost', 3307);
        $db = $database->conectar();
        $query = "
            UPDATE productos
            SET nombre = '$nombre', 
                descripcion = '$descripcion', 
                precio = '$precio', 
                stock = $stock
            WHERE id = $id;
        ";
        $result = $db->query($query);

        $db = $database->desconectar();
    }

    /**
     * Almacena un nuevo producto.
     *
     * @param array $datos - Datos del producto.
     * @return void
     */
    public function store($datos): void {
        $query = "INSERT INTO productos (" . implode(",", array_keys($datos)) . ")VALUES ('" . implode("','", array_values($datos)) . "')";
        $database = new Database('root', '', 'localhost', 3307);
        $db = $database->conectar();
        $db->exec($query);
        $db = $database->desconectar();
    }

    /**
     * Elimina un producto por ID.
     *
     * @param int $id - Identificador del producto.
     * @return void
     */
    public function destroyById($id): void {
        $database = new Database('root', '', 'localhost', 3307);
        $query = "DELETE FROM productos WHERE id = $id";
        $db = $database->conectar();
        $db->exec($query);
        $db = $database->desconectar();
    }
}



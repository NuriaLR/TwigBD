<?php
require_once 'controller/Controller.php';
require_once 'model/Productos.php';

class ProductosController implements Controller {

    /**
     * Muestra la lista de todos los productos.
     *
     * @return void
     */
    public static function index() {
        // Crear una instancia de la clase Producto
        $producto = new Producto();

        // Obtener todos los productos usando el método findAll
        $productos = $producto->findAll()->fetchAll();

        // Renderizar la plantilla 'productos/index.twig' con la lista de productos
        echo $GLOBALS['twig']->render('productos/index.twig', [
            'productos' => $productos
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     *
     * @return void
     */
    public static function create() {
        // Renderizar la plantilla 'productos/crear.twig'
        echo $GLOBALS['twig']->render('productos/crear.twig');
    }

    /**
     * Guarda un nuevo producto en la base de datos.
     *
     * @return void
     */
    public static function save() {
        // Recoger datos del formulario
        $datos = array();
        if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {
            $datos['nombre'] = $_POST['nombre'];
        }
        if (isset($_POST['descripcion']) && !empty($_POST['descripcion'])) {
            $datos['descripcion'] = $_POST['descripcion'];
        }
        if (isset($_POST['precio']) && !empty($_POST['precio'])) {
            $datos['precio'] = $_POST['precio'];
        }
        if (isset($_POST['stock']) && !empty($_POST['stock'])) {
            $datos['stock'] = $_POST['stock'];
        }

        // Crear una instancia de la clase Producto y almacenar los datos
        $producto = new Producto();
        $producto->store($datos);

        // Redirigir a la página de productos
        header('Location: productos');
    }

    /**
     * Muestra el formulario para editar un producto específico.
     *
     * @param int $id - Identificador del producto.
     * @return void
     */
    public static function edit($id) {
        // Obtener el identificador del producto de la consulta GET
        $id = $_GET['id'];

        // Crear una instancia de la clase Producto para obtener detalles del producto específico
        $producto = new Producto();
        $productos = $producto->findById($id)->fetchAll();

        // Renderizar la plantilla 'productos/edit.twig' con los detalles del producto
        echo $GLOBALS['twig']->render('productos/edit.twig', [
            'productos' => $productos
        ]);
    }

    /**
     * Actualiza un producto en la base de datos.
     *
     * @param int $id - Identificador del producto.
     * @return void
     */
    public static function update($id) {
        // Obtener el identificador del producto de la consulta GET
        $id = $_GET['id'];

        // Crear una instancia de la clase Producto y actualizar los datos del producto
        $producto = new Producto();
        $productos = $producto->updateById($id);

        // Redirigir a la página de productos
        header('Location: productos');
    }

    /**
     * Elimina un producto de la base de datos.
     *
     * @param int $id - Identificador del producto.
     * @return void
     */
    public static function destroy($id) {
        // Obtener el identificador del producto de la consulta GET
        $id = $_GET['id'];

        // Crear una instancia de la clase Producto y eliminar el producto
        $producto = new Producto();
        $productos = $producto->destroyById($id);

        // Redirigir a la página de productos
        header('Location: productos');
    }
}

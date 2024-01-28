<?php
require_once 'model/Pedidos.php';

class PedidosController {

    /**
     * Muestra la lista de todos los pedidos.
     *
     * @return void
     */
    public static function index() {
        // Crear una instancia de la clase Pedidos
        $pedidos = new Pedidos();

        // Obtener todos los pedidos usando el método findAll
        $pedidos = $pedidos->findAll()->fetchAll();

        // Renderizar la plantilla 'pedidos/index.twig' con la lista de pedidos
        echo $GLOBALS['twig']->render('pedidos/index.twig', [
            'pedidos' => $pedidos
        ]);
    }

    /**
     * Muestra los estados de un pedido específico.
     *
     * @param int $id - Identificador del pedido.
     * @return void
     */
    public static function estadosClientes($id) {
        // Obtener el identificador del pedido de la consulta GET
        $id = $_GET['id'];

        // Crear una instancia de la clase Pedidos para obtener detalles del pedido específico
        $pedidoCliente = new Pedidos();
        $pedidoClientes = $pedidoCliente->findById($id)->fetchAll();
        
        // Crear una instancia de la clase Pedidos para obtener los estados de los pedidos
        $pedidoEstado = new Pedidos();
        $pedidoEstados = $pedidoEstado->findEstados()->fetchAll();

        // Renderizar la plantilla 'pedidos/estados.twig' con los detalles del pedido y los estados
        echo $GLOBALS['twig']->render('pedidos/estados.twig', [
            'pedidoClientes' => $pedidoClientes,
            'pedidoEstados' => $pedidoEstados
        ]);
    }
}

<?php
require_once 'model/Clientes.php';

class ClientesController {

    /**
     * Muestra la lista de clientes.
     *
     * No recibe parámetros explícitos ya que utiliza la instancia
     * de la clase Clientes para obtener la lista de clientes.
     *
     * @return void
     */
    public static function index() {
        // Crear una instancia de la clase Clientes
        $cliente = new Clientes();

        // Obtener todos los clientes usando el método findAll
        $clientes = $cliente->findAll()->fetchAll();

        // Renderizar la plantilla 'clientes/index.twig' con la lista de clientes
        echo $GLOBALS['twig']->render('clientes/index.twig', [
            'clientes' => $clientes
        ]);
    }
}

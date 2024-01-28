<?php

class IndexController {

    /**
     * Muestra la página de inicio.
     *
     * Este método no recibe parámetros ya que simplemente renderiza
     * la plantilla 'index.twig'.
     *
     * @return void
     */
    public static function index() {
        // Renderizar la plantilla 'index.twig'
        echo $GLOBALS['twig']->render('index.twig');
    }
}

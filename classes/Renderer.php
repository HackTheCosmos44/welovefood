<?php

class Renderer {
    
    /**
    * Cette fonction affiche la vue requise, avec des données, en fonction du template HTML
    *
    * @param [type] $view
    * @param array $data
    * @param string $template
    * @return void
    */
    public static function render($view, $data = [], $template="views/template.phtml") : void {
        require_once $template;
    }
}
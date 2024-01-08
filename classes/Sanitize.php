<?php

trait Sanitize {
    /**
    * Cette fonction permet d'éviter les failles xss (strip_tags()) 
    * et les éléments html (htmlspecialchars())
    * et les antislash (stripcslashes())
    * et elle supprime les espaces indésirables en début et fin de chaîne (trim())
    *
    * @param mixed $inputValue
    * @return string
    */
    public function sanitize(mixed $inputValue): string {
        return trim(stripcslashes(strip_tags($inputValue)));
    }
}
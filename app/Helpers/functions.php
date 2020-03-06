<?php

if (!function_exists('retiraAcentos')) {
    
    /**
     * Retirar Acentuação de uma String
     * 
     * @param type $texto
     * @return type
     */
    function retiraAcentos($texto) {
        $array1 = array(
            "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç",
            "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç", "'", " ", "ª", "º"
        );
        $array2 = array(
            "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c",
            "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C", "", " ", " ", " "
        );
        return str_replace($array1, $array2, $texto);
    }
}

if (!function_exists('limitaCaracteres')) {
    
    /**
     * Function Limita Caracteres
     * 
     * @param type $str
     * @param type $max
     * @return type
     */
    function limitaCaracteres($str, $max) {
        if (strlen($str) > $max) {
            $str = substr_replace(retiraAcentos($str),'...', $max);
        }
        return $str;
    }
}
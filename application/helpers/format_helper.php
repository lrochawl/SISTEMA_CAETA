<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('data_format_mysql')) {
    function data_format_mysql($data_br) {
        if (empty($data_br)) {
            return null;
        }
        // Se já estiver no formato yyyy-mm-dd, retorna
        if (preg_match('/^\d{4}-\d{2}-\d{2}/', $data_br)) {
            return $data_br;
        }
        $partes = explode('/', $data_br);
        if (count($partes) == 3 && checkdate((int)$partes[1], (int)$partes[0], (int)$partes[2])) {
            return $partes[2] . '-' . $partes[1] . '-' . $partes[0];
        }
        return null; // Ou lança uma exceção/log de erro
    }
}

if (!function_exists('money_format_to_mysql')) {
    function money_format_to_mysql($valor_br) {
        if ($valor_br === null || $valor_br === '') {
            return null;
        }
        $valor = str_replace('.', '', $valor_br);
        $valor = str_replace(',', '.', $valor);
        if (is_numeric($valor)) {
            return $valor;
        }
        return null; // Ou lança uma exceção/log de erro
    }
}

// Você também precisará de funções para formatar do banco para exibição:
if (!function_exists('data_format_brasileiro')) {
    function data_format_brasileiro($data_mysql) {
        if (empty($data_mysql) || $data_mysql == '0000-00-00') {
            return '';
        }
        $data_mysql = substr($data_mysql, 0, 10); // Remove a hora, se houver
        $partes = explode('-', $data_mysql);
        if (count($partes) == 3 && checkdate((int)$partes[1], (int)$partes[2], (int)$partes[0])) {
            return $partes[2] . '/' . $partes[1] . '/' . $partes[0];
        }
        return ''; // Ou valor original
    }
}

if (!function_exists('money_format_to_br')) {
    function money_format_to_br($valor_mysql, $casas_decimais = 2) {
         if ($valor_mysql === null || !is_numeric($valor_mysql)) {
            return ''; // ou 0.00
        }
        return number_format((float)$valor_mysql, $casas_decimais, ',', '.');
    }
}
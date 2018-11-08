<?php
    /**
     * Database.php
     * 
     * @author Jose Alejandro Chan Martin <alejandrochanmartin1@gmail.com>
     */

    /**
     * Clase Database
     */
    class Database extends PDO
    {
        /**
         * Funcion constructora para la conexion con la base de datos
         * @return type
         */
    public function __construct()
    {
    parent::__construct(
    
    'mysql:host='.DB_HOST.';'.
    'dbname='.DB_NAME,
    
    DB_USER,
    DB_PASS,
    array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.DB_CHAR
        ));
    
    }
}
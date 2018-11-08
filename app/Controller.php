<?php
    /**
     * Controller.php
     * 
     * @author Jose Alejandro Chan Martin <alejandrochanmartin1@gmail.com>
     */
    /**
     * Clase AppController
     */
    abstract class AppController 
    {
        /**
         * $_view
         */
        protected $_view;
        protected $_messages;
        /**
         * Funcion de construccion
         * @return type
         */
        public function __construct()
        {
        $this->_view = new View(new Request);
        $this->_messages = new \Plasticbrain\FlashMessages\FlashMessages();
        }
    
        /**
         * Funcion index
         * @return type
         */
        abstract function index();
        /**
         * Funcion para cargar los modelos
         * @param $modelo 
         * @return type
         */
        protected function loadModel($modelo)
        {
        $modelo = $modelo."Model";
        $rutaModelo = ROOT."models".DS.$modelo.".php";


        if (is_readable($rutaModelo)) 
        {
            require_once($rutaModelo);
            $modelo = new $modelo;

            return $modelo;
        }
        else
        {
         throw new Exception("Error al cargar el modelo");
        }
    
    }
        /**
         * Funcion para redireccionar
         * @param array $url 
         * @return type
         */
        public function redirect($url = array())
        {
        $path = "";
        if ($url["controller"]) 
        {
            $path .= $url["controller"];
        }
        if ($url["action"]) 
        {
            $path .="/".$url["action"];
        }
            return APP_URL.$path;
            header("LOCATION: ".APP_URL.$path);
    }   
}
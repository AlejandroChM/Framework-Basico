<?php
  /**
   * Request.php
   * 
   * @author Jose Alejandro Chan Martin <alejandrochanmartin1@gmail.com>
   */
    /**
     * Clase Request
     */
    class Request
    {
      /**
       * @var $_controlador para almacenar los controladores
       */
      private $_controlador;
      /**
       * @var $_metodo para almacenar metodos
       */
      private $_metodo;
      /**
       * @var $_argumentos para almacenar argumentos
       */
      private $_argumentos;
      /**
       * Funcion de construccion
       * @return type
       */
      public function __construct()
      {
          if (isset($_GET['url'])) 
          {
              $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
              $url = explode("/", $url);
              $url = array_filter($url);

              $this->_controlador = strtolower(array_shift($url));
              $this->_metodo = strtolower(array_shift($url));
              $this->_argumentos = $url;

          }
          if (!$this->_controlador) 
          {
              $this->_controlador = DEFAULT_CONTROLLER;
          }
          if (!$this->_metodo) 
          {
              $this->_metodo = "index";
          }
          if (!$this->_argumentos) 
          {
              $this->_argumentos = array();
          }
      }
      /**
       * Funcion getController para obtener los controladores
       * @return type
       */
      public function getControlador()
      {
  		return $this->_controlador;
      }
      /**
       * Funcion getMetodo para obtener los metodos
       * @return type
       */
      public function getMetodo()
      {
  		return $this->_metodo;
      }
      /**
       * Funcion getArgs para obtener los argumentos
       * @return type
       */
      public function getArgs()
      {
  		return $this->_argumentos;
      }
  }
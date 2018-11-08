<?php
	/**
   * View.php
   * 
   * @author Jose Alejandro Chan Martin <alejandrochanmartin1@gmail.com>
   */
	 /**
	  * Class View
	  */
	class View
	{
	    private $_controlador;
	    private $_msg;
	    /**
	     * Funcion de constructor
	     * @param Request $peticion 
	     * @return type
	     */
	    public function __construct(Request $peticion)
	    {

	    $this->_controlador = $peticion->getControlador();
	    $this->_msg = new \Plasticbrain\FlashMessages\FlashMessages();
		}
		/**
		 * Funcion renderizar para recargar 
		 * @param $vista 
		 * @param bool $item 
		 * @return type
		 */
		public function renderizar($vista, $item = false){

		$_layoutParams = array(

			"ruta_css"=>APP_URL."views/layouts/".DEFAULT_LAYOUT."/css/",

			"ruta_img"=>APP_URL."views/layouts/".DEFAULT_LAYOUT."/img/",

			"ruta_js"=>APP_URL."views/layouts/".DEFAULT_LAYOUT."/js/"
		);

		$rutaVista = ROOT."views".DS.$this->_controlador.DS.$vista.".phtml";

		if (is_readable($rutaVista)) 
		{

		include_once(ROOT."views".DS."layouts".DS.DEFAULT_LAYOUT.DS."header.php");

		include_once($rutaVista);

		include_once(ROOT."views".DS."layouts".DS.DEFAULT_LAYOUT.DS."footer.php");
		}
		else
		{
	    	throw new Exception("Vista no encontrada");
	    }
		}    
	}
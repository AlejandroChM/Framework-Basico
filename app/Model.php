<?php

	/**
	 * Model.php
	 * 
	 * @author Jose Alejandro Chan Martin <alejandrochanmartin1@gmail.com>
	 */

	/**
	 * Clase AppModel
	 */
	class AppModel
	{
	protected $_db;
	/**
	 * Funcion construct
	 * @return type
	 */
	public function __construct(){

	$this->_db = new Database();
		}
	}
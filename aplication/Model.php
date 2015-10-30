<?php

/**
 * @access public
 * @author Cruz Enrique Martinez
 * @category Modelo
 * @copyright Software Libre
 * @example  Gestiona los datos dentro el sistema aplication/Model.php
 * @global Clase administradora de de datos
 * @package AppModel
 * @since 13/10/2015
 * @version v.1.0
 */
class AppModel
{

	/**
	 * @access protected
	 * @var string el nombre de la base de daotos
	 */
	protected $_db;
	

	/**
	 * @access public
	 * @return Database retorna la variable de la base  $_db
	 */
	public function __construct(){
	
		$this->_db = new Database();
	
	}

}
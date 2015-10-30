<?php

/**
 * @author Cruz Enrique Martinez
 * @category Modelo
 * @copyright Software Libre
 * @example modelos de las tareas models/tareasModel.php
 * @global Clase mdela para la ejecucion 
 * @package tareasModel
 * @subpackage AppModel
 * @since 18/10/2015
 * @version v.1.0
 */
class tareasModel extends AppModel
{

	/**
	 * Constructor clase tareasModel
	 * @return none No dretorna nada
	 */
	public function __construct()
	{
	
		parent::__construct();
	
	}

	/**
	 * Obtiene a todas las tareass
	 * @return string Devuelve solo juna lista de tareas
	 */
	public function getTareas()
	{
	
		$tareas = $this->_db->query("SELECT * FROM tareas");

		return $tareas->fetchall();
	
	}

}
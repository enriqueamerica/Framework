<?php

/**
 * @access public
 * @author Cruz Enrique mARTINEZ
 * @category Request SOLICITUD
 * @copyright Software Libre
 * @example gestiona las respuestas del sistema aplication/Request.php 
 * @global clase que administra las respuesta
 * @package Request o solicitud
 * @since 18/10/2015
 * @version v.1.0
 */
class Request 
{

	/**
	 * @access private
	 * @var string Inicia el controlador
	 */
	private $_controlador;
	
	/**
	 * @access private
	 * @var string Inicia el metodo
	 */
	private $_metodo;
	
	/**
	 * @access private
	 * @var string Inicia los argumentos
	 */
	private $_argumentos;
	
	/**
	 * Constructor  clase Request
	 * @access public
	 * @return string retorna el valor contenido
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
	
		if (!isset($this->_argumentos))
		{
		
			$this->_argumentos = array();
		
		}
	
	}
	
	/**
	 * @access public
	 * @return C
	 */
	public function getControlador()
	{
	
		return $this->_controlador;
	
	}
	
	/**
	 * @access public
	 * @return retorna el valor contenido
	 */
	public function getMetodo()
	{
	
		return $this->_metodo;
	
	}
	
	/**
	 * @access public
	 * @return string retorna el valor contenido
	 */
	public function getArgs()
	{
	
		return $this->_argumentos;
	
	}

}
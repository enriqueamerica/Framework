<?php

/**
 * @access public
 * @author Cruz Enrique Martinez 
 * @category View parte de vista
 * @copyright Software Libre
 * @example clase vista para la aplicacion aplication/View.php 
 * @global Clase vista
 * @package View
 * @since 18/10/2015
 * @version v.1.0
 */
class View
{
	/**
	 * @var private
	 */
	private $_controlador;
	private $_metodo;
	
	/**
	 * Constructor de la clase
	 * @param Request $peticion o solicitud Objeto de la clase Request
	 * @return no retorna nada
	 */
	public function __construct(Request $peticion)
	{
	
		$this->_controlador = $peticion->getControlador();
		
		$this->_metodo = $peticion->getMetodo();
	
	}
	
	/**
	 * muestra el contenido del modelo
	 * @param string $vista obtiene la ruta de la vista
	 * @param boolean $item obtiene el estado del item
	 * @throws exception Vista no encontrada
	 * @return no retorna ninguno
	 */
	public function renderizar($vista, $item = false)
	{
	
		$_layoutParams = array(
		
			"ruta_css"=>APP_URL."views/layouts/".DEFAULT_LAYOUT."/css/",
			
			"ruta_img"=>APP_URL."views/layouts/".DEFAULT_LAYOUT."/img/",
			
			"ruta_js"=>APP_URL."views/layouts/".DEFAULT_LAYOUT."/js/"
		
		);
		
		$rutaVista = ROOT."views".DS.$this->_controlador.DS.$vista.".phtml";
		
		if($this->_metodo == 'login')
		{
			$layout = 'login';
		}
		else
		{
			$layout = DEFAULT_LAYOUT;
		}
		
		if (is_readable($rutaVista))
		{
		
			include_once(ROOT."views".DS."layouts".DS.$layout.DS."header.php");
			
			include_once($rutaVista);
			
			include_once(ROOT."views".DS."layouts".DS.DEFAULT_LAYOUT.DS."footer.php");
		
		}
		else
		{
		
			throw new Exception("Vista no encontrada");
		
		}
	
	}

}
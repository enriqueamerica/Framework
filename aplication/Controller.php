<?php

/**
 * @access abstract
 * @author Edward Rodríguez
 * @category Controller
 * @copyright Software Libre
 * @example aplication/Controller.php Clase controladora del sistema
 * @global Clase controladora de datos
 * @package AppController
 * @since 13/10/2015
 * @version v.1.0
 */
abstract class AppController
{

	/**
	 * @var View Envia la vista asignada al modelo
	 */
	protected $_view;
	protected $db;
	
	/**
	 * Constructor de la clase AppController
	 * @return none No devuelve nada
	 */
	public function __construct()
	{

		$this->_view = new View(new Request);
		
		$this->db = new Database();
			
	}
	
	/**
	 * Método abstracto principal
	 */
	abstract function index();
	
	/**
	* Metodo encargado de redireccionar las paginas
	*/
	protected function redirect($url = array())
	{
		$path = "";
		if($url["controller"])
		{
			$path .= $url["controller"];
		}
		if(isset($url["action"]))
		{
			$path .= "/".$url["action"];
		}
		header("location: ".APP_URL.$path);
	}
	
	/**
	 * Método encargado de la carga del modelo
	 * @access protected
	 * @throws Exception Error al cargar el modelo
	 * @return $modelo Devuelve el nombre del modelo
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

}
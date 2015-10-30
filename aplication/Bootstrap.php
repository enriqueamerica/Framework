<?php

/**
 * @access public
 * @author Cruz Enrique Martinez
 * @category Bootstrap
 * @copyright Software Libre
 * @example  Clase para carrgar y especificar el  contenido
 * @global Clase en aplication para /Bootstrap.php 
 * @package AppModel
 * @since 18/10/2015
 * @version v.1.0
 */
class Bootstrap
{
	/**
	 * inicio la jfuncion operatjiva del sistema
	 * @param Request $peticion  solicitud
	 * @return none no retorna nada
	 */
	public static function run(Request $peticion)
	{
	
		$controller = $peticion->getControlador()."Controller";
		
		$rutaControlador = ROOT."controllers".DS.$controller.".php";
		
		$metodo = $peticion->getMetodo();
		
		$args = $peticion->getArgs();
		
		/*echo "<br>".$rutaControlador;
		exit;*/
		
		if (is_readable($rutaControlador))
		{
			
			require_once $rutaControlador;
			
			$controller = new $controller;
		
			if (is_callable(array($controller, $metodo))) 
			{
			
				$metodo = $peticion->getMetodo();
			
			} 
			else 
			{
			
				$metodo = "index";
			
			}
			
			if ($metodo == "login")
			{
				
			}
			else
			{
			 Authorization::logged();
			}
		
			if (isset($args))
			{
			
				call_user_func_array(array($controller, $metodo), $peticion->getArgs());
			
			}
			else
			{
			
				call_user_func(array($controller, $metodo));
			
			}
		
		} 
		else 
		{
		
			throw new Exception("Controlador no encontrado");
		
		}
	
	}

}
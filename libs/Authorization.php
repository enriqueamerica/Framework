<?php
/**
 * Clase  para el de  Autorizacion
 * 
 * valida los usuarios del sistema
 * @author  Cristian Bernal <crisbera@gmail.com>
 */
class Authorization{
	
	/**
	 * Método logged 
	 * 
	 * comprueba si el usuario a iniciado sesion
	 * @return  void no retorna ningun valor
	 */
	static function logged(){
		
		if(!isset($_SESSION)){
			session_start();
		}
		if(!$_SESSION['logged']){
		    header("Location: ".APP_URL."usuarios/login");
		    exit;
		}
	}

	/**
	 * Método login
	 * permite  el usuario inicie sesión 
	 * @param  $user array datos del usuario
	 * @return  void no retorna ningun valor
	 */
	public function login($user){
		session_start();
		$_SESSION['logged'] = true;
	    $_SESSION['username'] = $user["username"];
	    $_SESSION['start'] = time();
		$_SESSION['expire'] = $_SESSION['start'] + (5 * 60) ;
	}	
	
	/**
	 * Método logout
	 * 
	 * Método que termina  sesión del usuario
	 * 
	 */
	public function logout(){
		// remove all session variables
		session_unset();

		// destroy the session
		session_destroy();
		echo"<script type='text/javascript'>
		     alert('Ha salido correctamente');
		    window.location='".APP_URL."usuarios/login';
		    </script>";
	}
}
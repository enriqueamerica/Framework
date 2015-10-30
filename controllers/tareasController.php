<?php

/**
 * @author Cruz enrique Martinez 
 * @category Controlador
 * @copyright Software Libre
 * @example mControlador de tareas controller/tareasController.php 
 * @global Clase controladora en la ejecucion de  las tareas de la aplicacion
 * @package tareasController
 * @subpackage AppController
 * @since 18/10/2015
 * @version v.1.0
 */
class tareasController extends AppController 
{

	/**
	 * el constructor de la clase tareasController
	 * @return none retorna nada void
	 */
	public function __construct()
	{
	
		parent::__construct();
	
	}
	
	/**
	 * Método con el que inicia la clase tareasController
	 * @return void
	 */
	public function index()
	{

		//echo "Hola mundo";

/*		$tareas = $this->loadModel("tareas");
		
		$this->_view->tareas = $tareas->getTareas();
		
		$this->_view->titulo = "Página principal";
		
		$this->_view->renderizar("index");*/
		
		$this->_view->titulo = "Página principal";
		
		$this->_view->tareas = $this->db->find('tareas', 'all', null);
		
		$this->_view->renderizar("index");
	
	}
	
	public function add()
	{
		if($_POST)
		{
			if($this->db->save('tareas', $_POST))
			{
				$this->redirect(array('controller' => 'tareas'));
			}
			else
			{
				$this->redirect(array('controller' => 'tareas', 'action' => 'add'));
			}
		}
		else
		{
			$this->_view->titulo = "Agregar tarea";
			$this->_view->renderizar('add');
		}
	}
	
	public function edit($id = null)
	{
		if($_POST)
		{
			if($this->db->update('tareas', $_POST))
			{
				$this->redirect(array('controller' => 'tareas', 'action' => 'index'));
			}
			else
			{
				$this->redirect(array('controller' => 'tareas', 'action' => 'edit/'.$_POST['id']));
			}
		}
		else
		{
			$this->_view->titulo = "Editar tarea";
			$this->_view->tarea = $this->db->find('tareas', 'first', array('conditions' => 'id='.$id));
			$this->_view->renderizar('edit');
		}
	}
	
	public function delete($id = null)
	{
		$condition = 'id='.$id;
		if($this->db->delete('tareas', $condition))
		{
			$this->redirect(array('controller' => 'tareas', 'action' => 'index'));
		}
	}

}
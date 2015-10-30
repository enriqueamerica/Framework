<?php

class usuariosController extends AppController
{
	private $pass;
	public function __construct()
	{
		parent::__construct();
		$this->pass = new Password();
	}
	public function index()
	{
		$this->_view->titulo = "Usuarios";
		$this->_view->usuarios = $this->db->find("usuarios", "all");
		$this->_view->renderizar('index');
	}
	public function add()
	{
		if($_POST)
		{
			$_POST['password'] = $this->pass->getPassword($_POST['password']);
			if($this->db->save('usuarios', $_POST))
			{
				$this->redirect(array('controller' => 'usuarios'));
			}
			else
			{
				$this->redirect(array('controller' => 'usuarios', 'action' => 'add'));
			}
		}
		else
		{
			$this->_view->titulo = "Agregar usuarios";
			$this->_view->renderizar('add');
		}
	}
	public function edit($id = null)
	{
		if($_POST)
		{
			if(!empty($_POST['pass']))
			{
				$_POST['password'] = $this->pass->getPassword($_POST['password']);
			}
			if($this->db->update('usuarios', $_POST))
			{
				$this->redirect(array('controller' => 'usuarios', 'action' => 'index'));
			}
			else
			{
				$this->redirect(array('controller' => 'usuarios', 'action' => 'edit/'.$_POST['id']));
			}
		}
		else
		{
			$this->_view->titulo = "Editar usuarios";
			$this->_view->usuario = $this->db->find('usuarios', 'first', array('conditions' => 'id='.$id));
			$this->_view->renderizar('edit');
		}
	}
	public function delete($id = null)
	{
		$condition = 'id='.$id;
		if($this->db->delete('usuarios', $condition))
		{
			$this->redirect(array('controller' => 'usuarios', 'action' => 'index'));
		}
	}
	public function login()
	{
		if($_POST)
		{
			$pass = new Password();
			$filter = new Validations();
			$auth = new Authorization();

			$username = $filter->sanitizeText($_POST["username"]);
			$password = $filter->sanitizeText($_POST["password"]);

			$options['conditions'] = " username = '$username'";
			$usuario = $this->db->find("usuarios", "first", $options);

			if($pass->isValid($password, $usuario['password'])){
				$auth->login($usuario);
				$this->redirect(array("controller" => "tareas"));
			}else{
				echo "Usuario Invalido";
			}
		}
		$this->_view->renderizar('login');
	}
	public function logout()
	{
		$auth = new Authorization();
		$auth->logout();
	}
}
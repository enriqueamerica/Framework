<?php

/**
 * @access public
 * @author Cruz Enrique Martinez
 * @category Base de datos
 * @copyright Software Libre
 * @example Database/Database.php  se encaga de gestionar la base de datos
 * @global Clase para la administracion  dela base
 * @package Database
 * @subpackage PDO
 * @since 13/10/2015
 * @version v.1.0
 */
class Database // Database extends PDO
{
	public $connection;
	private $dsn;
	private $drive;
	private $host;
	private $database;
	private $username;
	private $password;
	public $result;
	public $lastInsertId;
	public $numberRows;
	
	/**
	* Constructor de la clase
	* @return void
	*/
	public function __construct($drive = 'mysql', $host = 'localhost', $database = 'gestion', $username = 'root', $password = ''){
	
		$this->drive = $drive;
		
		$this->host = $host;
		
		$this->database = $database;
		
		$this->username = $username;
		
		$this->password = $password;
		
		$this->connection();
	
	}
	
	/**
	* Este es el metodo para conexion de la base de datos.
	* permite establecer la conexion
	* @return void
	*/
	private function connection()
	{
	
		$this->dsn = $this->drive.':host='.$this->host.';dbname='.$this->database;
		
		try
		{
		
			$this->connection = new PDO(
			
			$this->dsn,
			
			$this->username,
			
			$this->password
			
			);
		
			$this->connection->setAttribute(
			
			PDO::ATTR_ERRMODE,
			
			PDO::ERRMODE_EXCEPTION);
		
		} 
		catch(PDOException $e)
		{
		
			echo "ERROR: " . $e->getMessage();
			
			die();
		
		}
	
	}
	
	/**
	* Metodo guardar o save
	* sirve para guardar registros
	* @param $table la tabla a la que se le va a hacer la consulta
	* @param $data son los valor que se van a guardar
	* @return object
	* @author CRuz Enrique Martinez
	*/
	public function save($table = NULL, $data = array())
	{
	
		$sql = "SELECT * FROM $table";
		
		$result = $this->connection->query($sql);
		
		for ($i=0; $i < $result->columnCount(); $i++) {
		
			$meta = $result->getColumnMeta($i);
			
			$fields[$meta['name']]=null;
		
		}
		
		$fieldsToSave="id";
		
		$valueToSave="NULL";
		
		foreach ($data as $key => $value) {
		
			if(array_key_exists($key, $fields)){
			
				$fieldsToSave .= ", ".$key;
				
				$valueToSave .= ", "."\"$value\"";
			
			}
		
		}
		
		$sql = "INSERT INTO $table ($fieldsToSave) VALUES ($valueToSave);";
		
		//echo $sql;
		//exit;
		
		$this->result = $this->connection->query($sql);
		
		$this->lastInsertId = $this->connection->lastInsertId();
		
		return $this->result;
	
	}
	
	/**
	* Método encontrar o find 
	* sirve para hacer consultas a  la bases de datos
	* @param string $table nombre de la tabla para consultar
	* @param string $query el tipo de consulta
	* - all
	* - first
	* - count
	* @param array $options manera de hacer restricciones a la  consulta
	* - fields
	* - conditions
	* - group
	* - order
	* - limit
	* @return object
	*/
	public function find($table = null, $query = null, $options = array()){
		
		$fields = '*';
		
		$parameters = '';
		
		if(!empty($options['fields']))
		{
		
			$fields = $options['fields'];
		
		}
		
		if(!empty($options['conditions']))
		{
		
			$parameters = ' WHERE '.$options['conditions'];
		
		}
		
		if(!empty($options['group']))
		{
		
			$parameters .= ' GROUP BY '.$options['group'];
		
		}
		
		if(!empty($options['order']))
		{
		
			$parameters .= ' ORDER BY '.$options['order'];
		
		}
		
		if(!empty($options['limit']))
		{
		
			$parameters .= ' LIMIT '.$options['limit'];
		
		}
		
		switch ($query)
		{
		
			case 'all':
			
				$sql = "SELECT $fields FROM ".$table.' '.$parameters;
			
				$this->result = $this->connection->query($sql);
			
			break;
			
			
			case 'count':
			
				$sql = "SELECT COUNT(*) FROM ".$table.' '.$parameters;
				
				$result = $this->connection->query($sql);
				
				$this->result = $result->fetchColumn();
			
			break;
			
			
			case 'first':
			
				$sql = "SELECT $fields FROM ".$table.' '.$parameters;
				
				$result = $this->connection->query($sql);
				
				$this->result = $result->fetch();
			
			break;
			
			
			default:
			
				$sql = "SELECT $fields FROM ".$table.' '.$parameters;
				
				$this->result = $this->connection->query($sql);
				
			break;
		
		}
		
		return $this->result;
	
	}
	
	/**
	* Metodo actualizar o update
	* sirve para actualizar registros
	* @param $table tabla a consultar
	* @param $data los valores a actualizar
	* @return object
	* @author Cruz Enrique Martinez
	*/
	public function update ($table = null, $data = array()){
	
		$sql = "SELECT * FROM $table";
		
		$result = $this->connection->query($sql);
		
		for ($i=0; $i < $result->columnCount(); $i++) {
		
			$meta = $result->getColumnMeta($i);
			
			$fields[$meta['name']]=null;
		
		}
		
		if(array_key_exists("id", $data))
		{
		
			//Update
			
			$fieldsToSave = "";
			
			$id = $data["id"];
			
			unset($data["id"]);
			
			//$i = 0;
			
			foreach ($data as $key => $value) {
			
				if(array_key_exists($key, $fields))
				{
				
					$fieldsToSave .= $key."="."\"$value\", ";
				
				}
				
				//$i++;
			
			}
			
			$fieldsToSave = substr_replace($fieldsToSave, '', -2);
			
			$sql = "UPDATE $table SET $fieldsToSave WHERE $table.id = $id;";
			/*echo $sql;
			exit;*/
		
		}
		
		$this->result = $this->connection->query($sql);
		
		return $this->result;
		
	}
	
	/**
	* Método eliminar o delete
	* sirve para eliminar registros
	* @param $table tabla a consultar
	* @param $condition impone la condicjion a cumplir
	* @return object
	* @author Cruz Enrique Martinez Estrada
	*/
	public function delete($table = null, $condition = null){
	
		$sql = "DELETE FROM $table WHERE $condition".";";
		
		$this->result = $this->connection->query($sql);
		
		$this->numberRows = $this->result->rowCount();
		
		return $this->result;
	
	}
	
	/**
	 * Descripcion
	 * @access public
	 * @return none no regresa ningun dato
	 */
	/*public function __construct()
	{
	
		parent::__construct(
		
			'mysql:host='.DB_HOST.';'.
			
			'dbname='.DB_NAME,
			
			DB_USER,
			
			DB_PASS,
			
			array(
			
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.DB_CHAR
			
			)
			
		);
	
	}*/

}
$db = new Database();
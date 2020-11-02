<?php 

/**
 * Habilita conexion a la BBDD de Apolo.
 */
class ApoloDB
{
	private $host = "192.168.12.16";
	private $usuario = "cvalencia";
	private $clave = "J1Mmel$";
	private $db = "mx";
	public $ApoloConn;
	public function __construct()
	{
		$this->ApoloConn = new mysqli($this->host, $this->usuario, $this->clave,$this->db)
			or die(mysqli_error());

		$this->ApoloConn->set_charset("utf8");
	}
	function __destruct()
	{
		mysqli_close($this->ApoloConn);
	}
	/**
	 * Ejecuta un Query dado usando la conexion al a BBDD de Apolo..
	 * 
	 * @param string $query Query.
	 * @return object Resultados de la consulta a la BBDD.
	 */
	public function buscar($query)
	{
		$rst = $this->ApoloConn->query($query) or die($this->ApoloConn->error);
		if($rst)
			return $rst->fetch_all(MYSQLI_ASSOC);
		return false;
	}
}

class VicidialDB
{
	private $host = "192.168.12.18";
	private $usuario = "cvalencia";
	private $clave = "J1Mmel$";
	private $db = "asterisk";
	public $VicidialConn;
	public function __construct()
	{
		$this->VicidialConn = new mysqli($this->host, $this->usuario, $this->clave,$this->db)
			or die(mysqli_error());
		$this->VicidialConn->set_charset("utf8");
	}
	function __destruct()
	{
		mysqli_close($this->VicidialConn);
	}
	/**
	 * Ejecuta un Query dado usando la conexion al a BBDD de ViciDial.
	 * 
	 * @param string $query Query.
	 * @return object Resultados de la consulta a la BBDD.
	 */
	public function buscar($query)
	{
		$rst = $this->VicidialConn->query($query) or die($this->VicidialConn->error);
		if($rst)
			return $rst->fetch_all(MYSQLI_ASSOC);
		return false;
	}
}

class ACDDB
{
	private $host = "192.168.12.19";
	private $usuario = "arevueltas";
	private $clave = "Dolphin7705";
	private $db = "MX_aaiacdreport";
	public $VicidialConn;
	public function __construct()
	{
		$this->VicidialConn = new mysqli($this->host, $this->usuario, $this->clave,$this->db)
			or die(mysqli_error());
		$this->VicidialConn->set_charset("utf8");
	}
	function __destruct()
	{
		mysqli_close($this->VicidialConn);
	}
	/**
	 * Ejecuta un Query dado usando la conexion al a BBDD de ViciDial.
	 * 
	 * @param string $query Query.
	 * @return object Resultados de la consulta a la BBDD.
	 */
	public function buscar($query)
	{
		$rst = $this->VicidialConn->query($query) or die($this->VicidialConn->error);
		if($rst)
			return $rst->fetch_all(MYSQLI_ASSOC);
		return false;
	}
}

?>
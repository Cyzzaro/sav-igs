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
		$this->ApoloConn = new mysqli($this->host, $this->usuario, $this->clave, $this->db)
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
		if ($rst)
			return $rst->fetch_all(MYSQLI_ASSOC);
		return false;
	}
}

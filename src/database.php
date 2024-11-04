<?php
namespace App;
class DB {
	public $host;
	public $dbname;
	public $charset;
	public $user;
	public $pass;
	public $pdo;

	public function __construct() {
		$conf = json_decode(file_get_contents(__DIR__ . '/../conf/database.json'),true);

		$this->host = $conf['host'];
		$this->dbname = $conf['dbname'];
		$this->charset = $conf['charset'];
		$this->user = $conf['user'];
		$this->pass = $conf['pass'];

		try {
			$this->pdo = new \PDO("mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset", $this->user, $this->pass);
		} catch (\Exception $exception) {
			echo 'Database error : ' . $exception->getMessage();
			exit;
		}
	}



	public function saveOne($obj) {
		$class = $obj::class;  
		$table = substr($class,10); //10 for App\Model\
		$types = $class::DBTYPES;
		array_shift($types); // remove id

		if ($obj->getId() === null) {
			$query = "INSERT INTO $table (";
			foreach ($types as $k => $v) {
				$query .= "$k, ";
			}
			$query = substr($query, 0, -2) . ") VALUES ("; //-2 pour ", "
			foreach ($types as $k => $v) {
				$query .= ":$k, ";
			}
			$query = substr($query, 0, -2) . ");"; //-2 pour ", "

			$req = $this->pdo->prepare($query);
			foreach ($types as $k => $v) {
				$getter = 'get' . ucfirst($k);
				$req->bindValue(":$k", method_exists($obj, $getter) ? $obj->$getter() : null);
			}

			try {
				$req->execute();
				return "OK";
			} catch (\PDOException $e) {
				return $e->getMessage();
			}
		}
		else {
			$query = "UPDATE $table SET ";
			foreach ($types as $k => $v) {
				$query .= "$k = :$k, ";
			}
			$query = substr($query, 0, -2) . " WHERE id = :id"; //-2 pour ", "

			$req = $this->pdo->prepare($query);
			$req->bindValue(":id",$obj->getId());
			foreach ($types as $k => $v) {
				$getter = 'get' . ucfirst($k);
				$req->bindValue(":$k", method_exists($obj, $getter) ? $obj->$getter() : null);
			}
			
			try {
				$req->execute();
				return "OK";
			} catch (\PDOException $e) {
				return $e->getMessage();
			}
		}
	}
	public function deleteOne($obj) {
		$class = $obj::class;  
		$table = substr($class,10); //10 for App\Model\

		$req = $this->pdo->prepare("DELETE FROM $table WHERE id = :id");
		$req->bindParam(':id',$obj->id);

		try {
			$req->execute();
			return "OK";
		} catch (\PDOException $e) {
			return $e->getMessage();
		}
	}
	public function getOneById($class, $id) {
		$table = substr($class,10); //10 for App\Model\
		$req = $this->pdo->prepare("SELECT * FROM $table WHERE id = :id");
		$req->bindParam(':id',$id);

		try {
			$req->execute();
		} catch (\PDOException $e) {
			return $e->getMessage();
		}

		$res = $req->fetch();
		$obj = new $class();

		foreach ((object)$res as $k => $v) {
			$setter = 'set' . ucfirst($k) . "()";
			if (method_exists($obj, $setter)) {
				$obj->$setter($v);
			}
		}
		return $obj;
	}
	public function getOneBy($class, $search) {
		$table = substr($class,10); //10 for App\Model\
		$req = $this->pdo->prepare("SELECT * FROM $table WHERE id = :id");
		$req->bindParam(':id',$id);

		try {
			$req->execute();
		} catch (\PDOException $e) {
			return $e->getMessage();
		}

		$res = $req->fetch();
		$obj = new $class();

		foreach ((object)$res as $k => $v) {
			$setter = 'set' . ucfirst($k) . "()";
			if (method_exists($obj, $setter)) {
				$obj->$setter($v);
			}
		}
		return $obj;
	}
	public function getAll($class, $limit = -1, $offset = -1) {
		$table = substr($class,10); //10 for App\Model\
		$query = "SELECT * FROM $table";
		if ($limit > 0) {
			$query .= " LIMIT $limit";
			if ($offset > 0 ) {
				$query .= " OFFSET $offset";
			}
		}

		$req = $this->pdo->prepare($query.";");
		try {
			$req->execute();
		} catch (\PDOException $e) {
			return $e->getMessage();
		}

		$res = $req->fetchAll();

		$objs = [];
		foreach ($res as $r) {
			$obj = new $class();
			foreach ((object)$r as $k => $v) {
				$setter = 'set' . ucfirst($k);
				if (method_exists($obj, $setter)) {
					$obj->$setter($v);
				}
			}
			$objs[] = $obj;
		}
		return $objs;
	}
}
$db = new DB();
?>
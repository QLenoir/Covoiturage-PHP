<?php
class SalarieManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function getAllSalaries() {
		$req = $this->db->prepare('SELECT * FROM salarie ORDER BY per_num;');
		$req->execute();

		while ($salarie = $req->fetch(PDO::FETCH_OBJ)) {
			$listeSalaries[] = new Salarie($salarie);
		}

		return $listeSalaries;

		$req->closeCursor();
	}

	public function addSalarie($salarie) {
		
		$req = $this->db->prepare('INSERT INTO salarie(per_num,sal_telprof, fon_num) VALUES (:p_num, :sal_tel, :fon_num)');
		$req->bindValue(':p_num', $this->db->lastInsertId(),PDO::PARAM_STR);
		$req->bindValue(':sal_tel', $salarie->getSalTel(),PDO::PARAM_STR);
		$req->bindValue(':fon_num', $salarie->getFonNum(),PDO::PARAM_STR);
		
		$req->execute();
	}
}
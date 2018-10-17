<?php
class ParcoursManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function getAllParcours() {
		$req = $this->db->prepare('SELECT par_num,par_km,vil_num1,vil_num2 FROM parcours ORDER BY par_num;');
		$req->execute();

		while ($parcours = $req->fetch(PDO::FETCH_OBJ)) {
			$listeParcours[] = new Parcours ($parcours);
		}

		return $listeParcours;

		$req->closeCursor();
	}

	public function addParcours($parcours) {
		
		$req = $this->db->prepare('INSERT INTO Parcours(vil_num1,vil_num2,par_km) VALUES (:vil_num1, :vil_num2, :par_km);');
		$req->bindValue(':vil_num1',$parcours->getVilNum1(),PDO::PARAM_STR);
		$req->bindValue(':vil_num2',$parcours->getVilNum2(),PDO::PARAM_STR);
		$req->bindValue(':par_km',$parcours->getParKm(),PDO::PARAM_STR);
		$req->execute();
	}

	public function exists($parcours) {

		$req = $this->db->prepare('SELECT vil_num1,vil_num2 FROM parcours');
		$req->execute();
		
		while ($res = $req->fetch(PDO::FETCH_OBJ)) {	
			$parcoursTable = new Parcours($res);
			if ( ( $parcours->getVilNum1() === $parcoursTable->getVilNum1() && $parcours->getVilNum2() === $parcoursTable->getVilNum2() ) || ($parcours->getVilNum2() === $parcoursTable->getVilNum1() && $parcours->getVilNum1() === $parcoursTable->getVilNum2() )) {
				return true;
			}
		}
		return false;
	}

	public function getNbParcours(){
		$req = $this->db->prepare('SELECT * FROM PARCOURS');
		$req->execute();
		return $req->rowCount();
	}

}

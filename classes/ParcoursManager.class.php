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

	public function getAllVilleParcours() {
		$req = $this->db->prepare('SELECT vil_num1 AS vil_num FROM parcours UNION SELECT vil_num2 AS vil_num FROM parcours');
		$req->execute();

		while ($villes = $req->fetch(PDO::FETCH_OBJ)) {
			$listeVilleParcours[] = new Ville($villes);
		}

		foreach ($listeVilleParcours as $attribut => $value) {
			$value->setVilNom($this->recupNomVille($value->getVilNum()));
		}

		return $listeVilleParcours;
	}

	public function recupNomVille($numVille) {
		$req = $this->db->prepare('SELECT vil_nom FROM ville WHERE vil_num="'.$numVille.'";');
		$req->execute();
		$res = $req->fetch(PDO::FETCH_OBJ);
		$ville = new Ville($res);
		return $ville->getVilNom();
	}
}

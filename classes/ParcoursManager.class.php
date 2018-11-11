<?php
class ParcoursManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	//Retourne la liste de tous les parcours de la base de données
	public function getAllParcours() {
		$req = $this->db->prepare('SELECT * FROM parcours ORDER BY par_num;');
		$req->execute();

		while ($parcours = $req->fetch(PDO::FETCH_OBJ)) {
			$listeParcours[] = new Parcours ($parcours);
		}

		return $listeParcours;

		$req->closeCursor();
	}

	//Ajoute un nouveau parcours dans la base de données
	public function addParcours($parcours) {
		
		$req = $this->db->prepare('INSERT INTO parcours(vil_num1,vil_num2,par_km) VALUES (:vil_num1, :vil_num2, :par_km);');
		$req->bindValue(':vil_num1',$parcours->getVilNum1(),PDO::PARAM_STR);
		$req->bindValue(':vil_num2',$parcours->getVilNum2(),PDO::PARAM_STR);
		$req->bindValue(':par_km',$parcours->getParKm(),PDO::PARAM_STR);
		$req->execute();
	}

	//Renvoie true si le parcours existe déja et false sinon
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

		$req->closeCursor();
	}

	//Retourne le nombre total de parcours dans la base de données
	public function getNbParcours(){
		$req = $this->db->prepare('SELECT * FROM parcours');
		$req->execute();
		return $req->rowCount();
	}

	//Récupère tous les numéro de ville de la table parcours 
	public function getAllVilleParcours() {
		$villeManager = new VilleManager($this->db);
		$req = $this->db->prepare('SELECT vil_num1 AS vil_num FROM parcours UNION SELECT vil_num2 AS vil_num FROM parcours');
		$req->execute();

		while ($villes = $req->fetch(PDO::FETCH_OBJ)) {
			$listeVilleParcours[] = new Ville($villes);
		}

		foreach ($listeVilleParcours as $attribut => $value) {
			$value->setVilNom($villeManager->recupNomVille($value->getVilNum()));
		}

		return $listeVilleParcours;

		$req->closeCursor();
	}

	//Récupère toutes les villes possibles selon un numéro de ville de départ donné
	public function getVilleParcours($vil_num1) {
		$villeManager = new VilleManager($this->db);

		$req = $this->db->prepare('SELECT vil_num2 AS vil_num FROM parcours WHERE vil_num1=:vil_num1 UNION SELECT vil_num1 AS vil_num FROM parcours WHERE vil_num2=:vil_num1;');
		$req->bindValue(':vil_num1',$vil_num1,PDO::PARAM_STR);
		$req->execute();

		while ($villes = $req->fetch(PDO::FETCH_OBJ)) {
			$listeVilleParcours[] = new Ville($villes);
		}

		foreach ($listeVilleParcours as $attribut => $value) {
			$value->setVilNom($villeManager->recupNomVille($value->getVilNum()));
		}
		return $listeVilleParcours;

		$req->closeCursor();
	}

	//Renvoie trouve le numéro de parcours de deux villes données
	public function findParNum($vil_num1,$vil_num2) {
		$req = $this->db->prepare('SELECT par_num FROM parcours WHERE (vil_num1=:vil_num1 AND vil_num2=:vil_num2) OR (vil_num1=:vil_num2 AND vil_num2=:vil_num1);');
		$req->bindValue(':vil_num1',$vil_num1,PDO::PARAM_STR);
		$req->bindValue(':vil_num2',$vil_num2,PDO::PARAM_STR);
		$req->execute();
		$res = $req->fetch(PDO::FETCH_OBJ);
		$parcours = new Parcours($res);
		return $parcours->getParNum();

		$req->closeCursor();
	}

	//Retourne le sens du parcours selon la ville du départ
	public function findProSens($par_num,$vil_num1){
		$req = $this->db->prepare('SELECT vil_num1,vil_num2 FROM parcours WHERE par_num=:par_num;');
		$req->bindValue(':par_num',$par_num,PDO::PARAM_STR);
		$req->execute();
		$res = $req->fetch(PDO::FETCH_OBJ);
		$par = new Parcours($res);
		if($par->getVilNum1()===$vil_num1){
			return 0;
		} else {
			return 1;
		}

		$req->closeCursor();
	}
}

<?php
class PersonneManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function getAllPersonne() {
		$req = $this->db->prepare('SELECT * FROM personne ORDER BY p_nom;');
		$req->execute();

		while ($personne = $req->fetch(PDO::FETCH_OBJ)) {
			$listePersonnes[] = new personne ($personne);
		}

		return $listePersonnes;

		$req->closeCursor();
	}

	public function addPersonne($personne) {
		
		$req = $this->db->prepare('INSERT INTO personne(per_nom,per_prenom,per_tel,per_mail, per_login, per_pwd) VALUES (:p_nom, :p_prenom, :p_tel, :p_mail, :p_login, :p_mdp)');
		$req->bindValue(':p_nom', $personne->getPNom(),PDO::PARAM_STR);
		$rep -> bindValue(':p_prenom', $personne->getPPrenom(),PDO::PARAM_STR);
		$rep -> bindValue(':p_tel', $personne->getPTel(),PDO::PARAM_STR);
		$rep -> bindValue(':p_mail', $personne->getPMail(),PDO::PARAM_STR);
		$rep -> bindValue(':p_login', $personne->getPLogin(),PDO::PARAM_STR);
		$rep -> bindValue(':p_mdp', $personne->getPMdp(),PDO::PARAM_STR);
		$req->execute();
	}

	public function exists($personne) {

		$req = $this->db->prepare('SELECT per_nom,per_prenom,per_tel,per_mail, per_login, per_pwd FROM personne');
		$req->execute();
		
		while ($res = $req->fetch(PDO::FETCH_OBJ)) {	
			$personnetable = new personne($res);
			if($personne === $personnetable->getPMail()){
				return true;
			}
		}
		return false;
	}

	public function getNbPersonne(){
		$req = $this->db->prepare('SELECT * FROM personne');
		$req->execute();
		return $req->rowCount();
	}


}
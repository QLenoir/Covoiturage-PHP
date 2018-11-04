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
			$listePersonnes[] = new Personne ($personne);
		}

		return $listePersonnes;

		$req->closeCursor();
	}

	public function addPersonne($personne) {
		
		$req = $this->db->prepare('INSERT INTO personne(per_nom,per_prenom,per_tel,per_mail, per_login, per_pwd) VALUES (:p_nom, :p_prenom, :p_tel, :p_mail, :p_login, :p_mdp)');
		$req->bindValue(':p_nom', $personne->getPNom(),PDO::PARAM_STR);
		$req-> bindValue(':p_prenom', $personne->getPPrenom(),PDO::PARAM_STR);
		$req-> bindValue(':p_tel', $personne->getPTel(),PDO::PARAM_STR);
		$req-> bindValue(':p_mail', $personne->getPMail(),PDO::PARAM_STR);
		$req-> bindValue(':p_login', $personne->getPLogin(),PDO::PARAM_STR);
		$req-> bindValue(':p_mdp', $personne->getPMdp(),PDO::PARAM_STR);
		$req->execute();
	}

	public function exists($personne) {

		$req = $this->db->prepare('SELECT per_mail, per_login FROM personne');
		$req->execute();
		
		while ($res = $req->fetch(PDO::FETCH_OBJ)) {	
			$personnetable = new Personne($res);
			if($personne->getPMail() === $personnetable->getPMail() || $personne->getPLogin() === $personnetable->getPLogin()){
				return true;
			}
		}
		return false;

		$req->closeCursor();
	}

	public function getNbPersonne(){
		$req = $this->db->prepare('SELECT * FROM personne');
		$req->execute();
		return $req->rowCount();
	}


}
<?php
class VilleManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function login($connexion){
		$connexion->setPerPwd(sha1(sha1($connexion->getPerPwd)).SALT);

		$req = $this->db->prepare('SELECT per_login,per_pwd FROM personne');
		$req->execute();
			while ($res = $req->fetch(PDO::FETCH_OBJ)) {	
				$connexionTable = new Connexion($res);
				if($connexion->getPerLogin() === $connexionTable->getPerLogin() && $connexion->getPerPwd() === $connexionTable->getPerPwd()){
					return true;
				}
			}
		return false;
	}
}

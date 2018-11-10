<?php
class ConnexionManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function login($connexion){
		$connexion->setPerPwd(sha1(sha1($connexion->getPerPwd()).SALT));
		$req = $this->db->prepare('SELECT per_login,per_pwd FROM personne WHERE per_login=:per_login;');
		$req->bindValue(':per_login',$connexion->getPerLogin(),PDO::PARAM_STR);
		$req->execute();
		$res = $req->fetch(PDO::FETCH_OBJ);	
		$connexionTable = new Connexion($res);	
		if($connexion->getPerLogin() === $connexionTable->getPerLogin() && $connexion->getPerPwd() === $connexionTable->getPerPwd()) {
			if($connexion->getCaptcha() == $connexion->getReponse()){
				return 1;
			} else {
				return (-1);					
			}
		}
		return 0;

		$req->closeCursor();
	}
}

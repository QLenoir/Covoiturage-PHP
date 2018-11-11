<?php
class ConnexionManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	//Renvoie un code retour selon la réussite de la connexion : 1 si le login/mdp correspond ainsi que le captcha, 0 si le login/mdr ne correspond pas et -1 si le login/mdp est bon mais pas le patcha
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

<?php
class Departement{

	private $dep_num;
	private $dep_nom;
	private $vil_num;


	public function __construct($valeurs) {
		if (!empty($valeurs)) {
			$this -> affecte($valeurs);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $attribut =>$valeur){

			switch ($attribut){
				case 'dep_num' : $this->setDNum($valeur);
					break;
				case 'dep_nom' : $this->setDNom($valeur);
					break;
				case 'vil_num' : $this->setVNum($valeur);
					break;
			}
		}
	}
	public function setDNum($num) {
		$this->dep_num = $num;
	}
	public function setDNom($nom) {
		$this->dep_nom = $nom;
	}
	public function setVNum($vilNum){
		$this->vil_num = $vilNum;
	}

	public function getDNum() {
		return $this->dep_num ;
	}
	public function getDNom() {
		return $this->dep_nom;
	}
	public function getVNum(){
		return $this->vil_num;
	}
}
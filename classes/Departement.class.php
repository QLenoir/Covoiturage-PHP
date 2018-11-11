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
				case 'dep_num' : $this->setDepNum($valeur);
					break;
				case 'dep_nom' : $this->setDepNom($valeur);
					break;
				case 'vil_num' : $this->setVilNum($valeur);
					break;
			}
		}
	}
	public function setDepNum($num) {
		$this->dep_num = $num;
	}
	public function setDepNom($nom) {
		$this->dep_nom = $nom;
	}
	public function setVilNum($vilNum){
		$this->vil_num = $vilNum;
	}

	public function getDepNum() {
		return $this->dep_num ;
	}
	public function getDepNom() {
		return $this->dep_nom;
	}
	public function getVilNum(){
		return $this->vil_num;
	}
}
<?php
class Etudiant{
	private $etu_num;
	private $dep_num;
	private $div_num;

	public function __construct($valeurs) {
		if (!empty($valeurs)) {
			$this -> affecte($valeurs);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $attribut =>$valeur){

			switch ($attribut){
				case 'per_num' : $this->setEtuNum($valeur);
					break;
				case 'dep_num' : $this->setDepNum($valeur);
					break;
				case 'div_num' : $this->setDivNum($valeur);
					break;
				
			}
		}
	}
	public function setEtuNum($num) {
		$this->etu_num = $num;
	}
	public function setDepNum($num) {
		$this->dep_num = $num;
	}
	public function setDivNum($num){
		$this->div_num = $num;
	}

	public function getEtuNum() {
		return $this->etu_num;
	}
	public function getDepNum() {
		return $this->dep_num;
	}
	public function getDivNum() {
		return $this->div_num;
	}
}
<?php
class Fonction{
	private $fon_num;
	private $fon_libelle;

	public function __construct($valeurs) {
		if (!empty($valeurs)) {
			$this -> affecte($valeurs);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $attribut =>$valeur){

			switch ($attribut){
				case 'fon_num' : $this->setFNum($valeur);
					break;
				case 'fon_libelle' : $this->setFLib($valeur);
					break;
				
			}
		}
	}
	public function setFNum($num) {
		$this->fon_num = $num;
	}
	public function setFLib($lib){
		$this->fon_libelle = $lib;
	} 

	public function getFNum(){
		return $this->fon_num;
	}
	public function getFLib(){
		return $this->fon_libelle;
	}
}
<?php
class Salarie{
	private $sal_num;
	private $sal_tel;
	private $fon_num;

	public function __construct($valeurs) {
		if (!empty($valeurs)) {
			$this -> affecte($valeurs);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $attribut =>$valeur){

			switch ($attribut){
				case 'sal_num' : $this->setSalNum($valeur);
					break;
				case 'sal_telprof' : $this->setSalTel($valeur);
					break;
				case 'fon_num' : $this->setFonNum($valeur);
					break;
				
			}
		}
	}
	public function setSalNum($num) {
		$this->sal_num = $num;
	}
	public function setSalTel($num) {
		$this->sal_tel = $num;
	}
	public function setFonNum($num){
		$this->fon_num = $num;
	}

	public function getSalNum() {
		return $this->sal_num;
	}
	public function getSalTel() {
		return $this->sal_tel;
	}
	public function getDivNum() {
		return $this->fon_num;
	}
}
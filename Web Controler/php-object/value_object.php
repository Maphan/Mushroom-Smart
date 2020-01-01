<?php 
class Value{
		private $name,$MaxTemp,$MinTemp,$MaxHum,$MixHum;
		
		function __construct($n,$maxT,$minT,$maxh,$minH){
			$this->name=$n;
			$this->MaxTemp=$maxT;
			$this->MinTemp=$minT;
			$this->MaxHum=$maxh;
			$this->MinHum=$minH;
		}
		public function getName(){
			return $this->name;
		}
		public function getMaxTemp(){
			return $this->MaxTemp;
		}
		public function getMinTemp(){
			return $this->MinTemp;
		}
		public function getMaxHum(){
			return $this->MaxHum;
		}
		public function getMinHum(){
			return $this->MinHum;
		}	
	}
?>
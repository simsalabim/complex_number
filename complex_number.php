<?php 
class ComplexNumber
{
	protected $real_unit;
	protected $imaginary_unit;
	static $imaginary_sign = 'i';
	
	public function __construct($real_unit = 0, $imaginary_unit = 0) {
		if(is_string($real_unit)) list($real_unit, $imaginary_unit) = self::units($real_unit);
		if(is_array($real_unit)) list($real_unit, $imaginary_unit) = $real_unit;
		return $this->set(array('real_unit' => (int) $real_unit, 'imaginary_unit' => (int) $imaginary_unit));
	}
	
	public function set($attribute = null, $value = null){
		if(!is_array($attribute)) eval("return \$this->" . $attribute . " = \$value;");
		foreach($attribute as $field => $value) {
			eval("\$this->" . $field . " = \$value;");
		}
		return true;
	}
	
	public function __toString(){
		return ($this->isReal() ? $this->real_unit : ($this->real_unit ? $this->real_unit : '')) . $this->isImaginary();
	}
	
	public function add($first = null, $second = null, $subtract = false){
		if($this) {
			$second = $first;
			$first = $this;
		}
		$first = self::recognize($first);
		$second = $subtract ? self::invert(self::recognize($second)) : self::recognize($second);
		return new ComplexNumber($first->real_unit + $second->real_unit, $first->imaginary_unit + $second->imaginary_unit);
	}
	
	public function subtract($first = null, $second = null){
		return self::add($first, $second, true);
	}
	
	public function invert($number = null){
		if(is_null($number)) $number = $this;
		$number = self::recognize($number);
		return new ComplexNumber($number->real_unit * (-1), $number->imaginary_unit * (-1));
	}
	
	public function recognize($number){
		if($number instanceof ComplexNumber) return $number;
		return new ComplexNumber(self::units($number));
	}
	
	public function units($string){
		if(preg_match(self::mask(), $string, $matches)) return array($matches[1], $matches[2]);
		return false;
	}

	public function isImaginary($number = null){
		if(!is_null($number)){
			$number = self::recognize($number);
			return $number->imaginary_unit != 0;
		}
		if(!$this->imaginary_unit) return false;
		return ($this->imaginary_unit > 0 && $this->real_unit ? '+' : ($this->imaginary_unit < 0 ? '-' : '')) . (abs($this->imaginary_unit) != 1 ? abs($this->imaginary_unit) : '') . self::$imaginary_sign;
	}
	
	public function isReal($number = null){
		return !self::isImaginary($number);
	}
	
	protected function mask(){
		return '/([+|-]?[\d]*)([+|-]?[\d])*[' . self::$imaginary_sign . ']?/';
	}
}

?>
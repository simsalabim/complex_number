<?php 
	require_once 'complex_number.php';
	
	$lf = "\n"; // $lf = '<br />';
	
	$numbers = array(
					new ComplexNumber(1, 5),
					new ComplexNumber('-2-4i'),
					new ComplexNumber(),
					new ComplexNumber('4+5i'),
					new ComplexNumber(array(5,1)),
					new ComplexNumber('-5-1i'),
					new ComplexNumber('7+0i'),
					new ComplexNumber('18'),
					new ComplexNumber('')
	);

	foreach($numbers as $key => $number){
		echo $key + 1 . ' number: ' . $number . $lf;
	}
	
	echo $lf . 'Operations: ' . $lf;
	echo '1 number + 2 number: ' . ComplexNumber::add($numbers[0], $numbers[1]) . $lf;
	echo '2 number + 5 number: ' . $numbers[1]->add($numbers[4]) . $lf;
	
	echo '4 number - 2 number: ' . ComplexNumber::subtract($numbers[3], $numbers[1]) . $lf;
	echo '7 number - 6 number: ' . $numbers[6]->subtract($numbers[5]) . $lf;
	
	echo '5 number inversion: ' . ComplexNumber::invert($numbers[4]) . $lf;
	echo '2 number inversion: ' . $numbers[1]->invert() . $lf;
	
	echo '4 number + (6-8i): ' . ComplexNumber::add($numbers[3], '6-8i') . $lf;
	echo '4 number + (13+2i): ' . $numbers[3]->add('13+2i') . $lf;
	
	echo 'is 5 number real: ' . ComplexNumber::isReal($numbers[4]) . $lf;
	echo 'is (3+7i) real: ' . ComplexNumber::isReal('3+7i') . $lf;
	echo 'is (3) real: ' . ComplexNumber::isReal('3') . $lf;
	echo 'is 3 number imaginary(not real): ' . ComplexNumber::isImaginary($numbers[2]) . $lf;
	echo 'is 7 number real: ' . $numbers[6]->isReal() . $lf;
	
	foreach($numbers as $number) $number = null;
	
?>
<?php
/**
 * 获取1～1000的质数,注意1不是质数
 * 质数是除了1和它本身之外没有其他因数
 */
function getprimenum(){
	$m=0;
	for ($i = 2;$i <= 1000; $i++) {
		if ($i == 2 || $i == 3) {
			$m++;
			echo $i."  ";
		} else {
			$mid = $i/2;
			$ech = false;
			for($j=2;$j<=$mid;$j++){
				if($i % $j == 0){
					$ech = true;
				}
			} 
			if ($ech == false) {
				$m++;
				echo $i."  ";
				if ($m % 8 == 0) {
					echo "<br/>";
				}
			}
		}
	}
}

getprimenum();
?>
<?php
/**
* 这个程序时针对密码进行加密的,采用每位数字平方的方法
* @param $str 需要加密的字符串 n位
* @param $restr 加密成的字符串
*/
function encryption_str($str) {
	!$str && $str = "123456";
	$len = strlen($str);
	$arr = str_split($str);
	for ($i = 0;$i < $len; $i++) {
		$dec[$i] = ord($arr[$i]);
		$dec_b[$i] = str_pad($dec[$i], 3, 0, STR_PAD_LEFT);//默认3位长度
		$arr_dec = str_split($dec_b[$i]);
		for($j=0;$j<3;$j++){
			$dec_sqr[$i][$j]=pow($arr_dec[$j], 2);
			$dec_hex[$i][$j]=str_pad(dechex($dec_sqr[$i][$j]), 2, 0, STR_PAD_LEFT);
		}
		$hex[$i]=implode($dec_hex[$i]);
		$hex[$i]=str_pad($hex[$i],8,0,STR_PAD_LEFT);
	}
	
	$hex = implode($hex);//***1***
	$hex = str_ireplace('00000','FF',$hex);
	$hex = str_ireplace('0000','EE',$hex);//***2***
	$len_s = strlen($hex);
	if ($len_s%2!==0) {
		$len_s = $len_s+1;
		$hex = str_pad($hex,$len_s,0,STR_PAD_LEFT);//默认长度偶数位
	}
	$arr_hex=str_split($hex,2);
	for ($k=0;$k<$len_s/2;$k++) {
		$restr_s[$k] =chr(hexdec($arr_hex[$k]));
	}
	$restr = implode($restr_s);
	return $restr;
}

?>

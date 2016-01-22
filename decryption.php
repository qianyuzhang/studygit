<?php 
/**
 * 这个程序是针对加密的字符串进行解密
 * @param $str 需要解密的字符串
 * @param $restr 解密完成的代码
 */
function decryption_str($str) {
	$len = strlen($str);
	$len_b = decbin($len);
	$arr = str_split($str);
	for ($i=0;$i<$len;$i++) {
		$dec[$i] = ord($arr[$i]);
		$hex[$i] = str_pad(dechex($dec[$i]),2,0,STR_PAD_LEFT);
	}
	$str_hex = implode($hex);//***2***
	$str_hex = str_ireplace('FF','00000',$str_hex);
	$str_hex = str_ireplace('EE','0000',$str_hex);
	$len_s = strlen($str_hex);
	if ($len_s%2 !==0) {
		$str_hex=substr($str_hex,1);
	}//***1***
	$arr_hex = str_split($str_hex,8);
	for ($j=0;$j<count($arr_hex);$j++) {
		$arr_hex2[$j]=str_split($arr_hex[$j],2);
		for($k=0;$k<4;$k++){
			$arr_dec[$j][$k]=sqrt(hexdec($arr_hex2[$j][$k]));
		}
		$dec[$j] = implode($arr_dec[$j]);
		$arr_str[$j] = chr($dec[$j]);
	}

	$restr = implode($arr_str);
	return $restr;
}

?>
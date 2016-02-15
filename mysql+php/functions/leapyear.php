<?php 
/**
 * 
 * 编写闰年相关的函数
 * @param int $year  所求的年份是否是闰年
 */
function getifleapyear ($year) {
		$nowyear = date('Y');
		$year = $year ? $year : $nowyear;
		if ($year % 100 === 0) {
				if ($year % 400 === 0) {
						echo $year."年是闰年"  ;
				} else {
						echo $year."年不是闰年"  ;
				}
		} else if ($year % 4 === 0) {
				echo $year."年是闰年" ;
		} else {
				echo $year."年不是闰年" ;
		}
}
getifleapyear(2100);
?>
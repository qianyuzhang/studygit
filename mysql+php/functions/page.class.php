<?php 
class page{
	/**
	*$curPage   第n页
	*$totNum	   总数量
	*$href	   页面连接
	*$pageSize	页面数量
	*$show   默认为3，因为当页数大于等于3个的时候，连接能够正常显示，如果小于3个，则要特殊处理
	*$suffix 判断是否为绝对连接，默认不是为false；
	* 显示格式 举例      上一页  1 2 3 4 5 6 下一页
	**
	*/
	function __construct($curPage,$totNum,$href,$pageSize=20,$show=3,$suffix=false){
		sfcontext::getInstance()->getConfiguration()->loadHelpers('Url');
		
		$totPage = ceil($totNum/$pageSize);//上取整，求得总页数
		$prePage = $curPage - 1;//上一页
		$nextPage = $curPage + 1;//下一页
		$start = $curPage > $show ? $curPage - $show : 1;
		$end = ($totPage > $show && $curPage + $show < $totPage) ? $curPage + $show : $totPage;
		
		$topPage = $pageStr = '';
		if($suffix)
			$curPage > 1 && $pageStr .= '<a href="'.$href.$prePage.'.html" class="dw">上一页</a> ';
		else 
			$curPage > 1 && $pageStr .= '<a href="'.url_for($href.$prePage).'" class="dw">上一页</a> ';
		
		
		for ($i = $start; $i <= $end; $i++)
		{
			$active = '';
			if ($i == $curPage) $active = ' class="hover"';
			if($suffix)
				$pageStr .= '<a href="'.$href.$i.'.html"'.$active.'>'.$i.'</a> ';
			else
				$pageStr .= '<a href="'.url_for($href.$i).'"'.$active.'>'.$i.'</a> ';
		}
		if($suffix)
			$curPage < $totPage && $pageStr .= '<a href="'.$href.$nextPage.'.html" class="dw">下一页</a> ';
		else
			$curPage < $totPage && $pageStr .= '<a href="'.url_for($href.$nextPage).'" class="dw">下一页</a> ';
		
		$topPage .= "<span class='f_l m_r_10'>". $curPage.'/'.$totPage.'</span>';
		$curPage > 1 && $topPage .= '<a href="'.url_for($href.$prePage).'" class="dw">上一页</a> ';
		$curPage ==1 && $topPage .= '<a href="javascript:return false;" class="dw">上一页</a> ';
		
		$curPage < $totPage && $topPage .= '<a href="'.url_for($href.$nextPage).'" class="dw">下一页</a> ';
		$curPage == $totPage && $topPage .= '<a href="javascript:return false;" class="dw">下一页</a> ';
		$this->topPage = $topPage;

		$totPage < 2 && $pageStr = '';
	
		$this->totPage = $totPage;
		$this->pageStr = $pageStr;
		
		
	}
}
?>








<?php
//样式2
class page2
{
	/**
	*$curPage   要显示的页数
	*$totNum		总数量
	*$href		连接
	*$pageSize  每－页的数量
	*$atitle		每个连接的title中的固定文字
	*$show      默认为3，因为当页数大于等于3的时候，连接能够正常显示，当小于3的时候，则需要特殊处理
	* 显示格式举例     上一页  5/10 下一页
	**
	*/
    
	function __construct($curPage,$totNum,$href,$pageSize=20, $atitle = '', $show=3)
	{
		
		sfContext::getInstance()->getConfiguration()->loadHelpers('Url');  
		
		$totPage = ceil($totNum/$pageSize);
		$prePage = $curPage - 1;
		$nextPage = $curPage + 1;
		$start = $curPage > $show ? $curPage - $show : 1;
		$end = ($totPage > $show && $curPage + $show < $totPage) ? $curPage + $show : $totPage;
		
		$topPage = $pageStr = '';
		$curPage > 1 && $pageStr .= '<a class="pageup bk" title="' . $atitle . '第' . $prePage.'页'. '" href="'.url_for($href.$prePage).'">上一页</a>';
		
		
      $pageStr.="<span class='number bk'><span class='num'>{$curPage}</span>/{$totPage}</span>";
	
		$curPage < $totPage && $pageStr .= '
        <a class="pagedn bk" title="' . $atitle .'第'    .    $nextPage.'页'. '" href="'.url_for($href.$nextPage).'">下一页</a>';
		
		$curPage > 1 && $topPage .= '<a class="pageup bk" title="' . $atitle . '第'.$prePage.'页'. '" href="'.url_for($href.$prePage).'">上一页</a>';
		$curPage ==1 && $topPage .= '<a href="javascript:return false;" title="' . $atitle . '"  class="pageup bk">上一页</a>';
		
		$curPage < $totPage && $topPage .= '<a href="'.url_for($href.$nextPage).'" title="' . $atitle . '第'.$nextPage.'页'. '"  class="pagedn bk">下一页</a>';
		$curPage == $totPage && $topPage .= '<a href="javascript:return false;" title="' . $atitle . '"  class="pagedn bk">下一页</a>';
		$this->topPage = $topPage;

		$totPage < 2 && $pageStr = '';
		
		$this->totPage = $totPage;
      $pageStr="<div class='pagebox'>{$pageStr}</div>";	
      $this->pageStr = $pageStr;	
	}
}
class newPage{

	/**
	*$curPage    要显示的页数
	*$totNum		 总数量
	*$href		 页面连接
	*$pageSize	 每一个页面的数量
	*$atitle		 每一个连接的title中要添加的固定的文字
	**显示格式举例    共100页  11 12 13 14 15 16 17 18 19   20  21－30  
		快捷分页：1－10  31－40  41－50  51－60  61－70  71－80  81－90  91－100
	**
	*/
	function __construct($curPage,$totNum,$href,$pageSize=20, $atitle = ''){
		sfContext::getInstance()->getConfiguration()->loadHelpers('Url');  
		
		$totPage = ceil($totNum/$pageSize);//页数
		$prePage = $curPage - 1;//上一页
		$nextPage = $curPage + 1;//下一页
		$pageGroup = ceil($totPage/10); //分组个数
//第一部分 当前组	
		$pageStr = "<div class='clearfix mb'>";
		$pageStr .= "<div class='fl'>";
		$pageStr .= "共<span class='plr8'>".$totPage."</span>页";
		$pageStr .= "</div>";
		$pageStr .= "<div class='cityhouse_page fr'>";
		$startPage = ceil($curPage/10)*10-9;//展开的页面的开头数字

		for($i=0;$i<10;$i++){
			if(intval($curPage) == intval($startPage+$i)){
				$active = "class='active'";
			}else{
				$active = "";
			}
			$pageStr .= "<a ".$active." title='第".intval($startPage+$i)."页' href='".url_for($href.intval($startPage+$i))."'>".intval($startPage+$i)."</a>";
			if(($startPage+$i)>=$totPage)break;
		}
		
		
//第二部分 下一组	
		if(intval($startPage+10-1)>=$totPage){//当前页码在最后一组
			$pageStr .= "";
		}elseif(intval($startPage+20-1)>=$totPage){//当前页码是倒数第二组
			$pageStr .= "<a class='pgdn' title='' href='".url_for($href.intval($startPage+10))."'>".intval($startPage+10)."-".intval($totPage)."</a>";
		}elseif(intval($startPage+20-1)<$totPage){//当前页码是正常组
			$pageStr .= "<a class='pgdn' title='' href='".url_for($href.intval($startPage+10))."'>".intval($startPage+10)."-".intval($startPage+20-1)."</a>";
		}
		$pageStr .= "</div>";
		$pageStr .= "</div>";

//第三部分 快捷翻页
		$quick_tmp = "<div class='shortcut'>";
		$quick_tmp  .= "<span class='tith'>快捷翻页:&nbsp&nbsp&nbsp</span>";
		$quick_a = "";

		for ($j = 0 ; $j < $pageGroup ; $j ++) {
			if (intval($startPage) == intval($j*10+1)) continue;
			if (intval($startPage+10) == intval($j*10+1)) continue;
			
			$quick_a .= "<a href='".url_for($href.intval($j*10+1))."'>&nbsp;";
			
			if (intval(($j+1)*10)>$totPage) {
				$quick_a .= intval($j*10+1)."-".$totPage;
			} else {
				$quick_a .= intval($j*10+1)."-".intval(($j+1)*10);
			}
			$quick_a .= "</a>";
		}
		
		$quick_tmp .= $quick_a;
		$quick_tmp .= "</div>";
		if ($quick_a != "") {
			$pageStr .= $quick_tmp;
		}
		$totPage < 2 && $pageStr = '';
		$this->pageStr = $pageStr;
		
	}
}



class foasalePage{//二手房租房页面（包含快捷翻页）

	/**
	*$curPage   当前页面
	*$totNum		总数量
	*$href      页面连接
	*$pageSize  每一页的数量
	*$atitle    每一个连接中title中的固定文字
	*显示格式举例   共121页  11 12 13 14 15 16 17 18 19 20 
               快捷分页：1－10  31－40  41－50  51－60  61－70  71－80  81－90  91－100  101-110   111-120  121
	*/
	function __construct($curPage,$totNum,$href,$pageSize=20, $atitle = ''){
		sfContext::getInstance()->getConfiguration()->loadHelpers('Url');  
		
		$totPage = ceil($totNum/$pageSize);//页数
		$prePage = $curPage - 1;//上一页
		$nextPage = $curPage + 1;//下一页
		$pageGroup = ceil($totPage/10); //分组个数
//第一部分 当前组	
		$pageStr = "<div class='page1 mb5 clearfix'>";
		$pageStr .= "<span  class='page_p'> 共{$totPage}页 </span>";
		$startPage = ceil($curPage/10)*10-9;//展开的页面的开头数字
		for($i=0;$i<10;$i++){
			if(intval($curPage)==intval($startPage+$i)){
				$active = "class='active'";
			}else{
				$active = "";
			}
            //第一页不加分页标记
            if(($i==0&&intval($startPage/10)==0)){
                $tmpHref=url_for(str_replace(array('-pg','?params=pg'),array('',''),$href));
            }else{
                $tmpHref=url_for($href.intval($startPage+$i));
            			}
			$pageStr .= "<a ".$active." title='第".intval($startPage+$i)."页' href='".$tmpHref."'>".intval($startPage+$i)."</a>";
			if(($startPage+$i)>=$totPage)break;
		}
		
		
//第二部分 下一组	
		if(intval($startPage+10-1)>=$totPage){//当前页码在最后一组
			$pageStr .= "";
		}elseif(intval($startPage+20-1)>=$totPage){//当前页码是倒数第二组
			$pageStr .= "<a class='pgdn' title='' href='".url_for($href.intval($startPage+10))."'>".intval($startPage+10)."-".intval($totPage)."</a>";
		}elseif(intval($startPage+20-1)<$totPage){//当前页码是正常组
			$pageStr .= "<a class='pgdn' title='' href='".url_for($href.intval($startPage+10))."'>".intval($startPage+10)."-".intval($startPage+20-1)."</a>";
		}
		$pageStr .= "</div>";

//第三部分 快捷翻页
		$quick_tmp = "<div class='page2'>";
		$quick_tmp  .= "<span class='tith'>快捷翻页:</span>";
		$quick_a = "";

		if($pageGroup>16){//翻页分组超过16个，只显示16个
			if(intval($startPage-1)<80){// 前7不够则从0开始
				$j_tmp=0;
				$c_tmp = 16;
			}elseif(($pageGroup-floor($startPage/10))<9){//后7不够则从后面算	
				$j_tmp=$pageGroup-16;
				$c_tmp = $pageGroup;
			}else{
				$j_tmp = floor($startPage/10)-7;
				$c_tmp = $j_tmp+16;
			}
		}else{
			$j_tmp=0;
			$c_tmp = $pageGroup;
		}
		for($j=$j_tmp;$j<$c_tmp;$j++){
//		for($j=0;$j<$pageGroup;$j++){
			if(intval($startPage)==intval($j*10+1))continue;
			if(intval($startPage+10)==intval($j*10+1))continue;
			
            //第一页不加分页标记
            if(($i==0&&intval($startPage/10)==0)){
                $tmpHref=url_for(str_replace(array('-pg','?params=pg'),array('',''),$href));
            }else{
                $tmpHref=url_for($href.intval($j*10+1));
            }
            
			$quick_a .= "<a href='".$tmpHref."'>&nbsp;";
			
			if(intval(($j+1)*10)>$totPage){
				$quick_a .= intval($j*10+1)."-".$totPage;
			}else{
				$quick_a .= intval($j*10+1)."-".intval(($j+1)*10);
			}
			$quick_a .= "</a>";
		}
		
		$quick_tmp .= $quick_a;
		$quick_tmp .= "</div>";
		if ($quick_a!=""){
			$pageStr .= $quick_tmp;
		}
		$totPage < 2 && $pageStr = '';
		$this->pageStr = $pageStr;
		
	}
}

class page_map{
	
	function __construct($curPage,$totNum,$href,$pageSize=20)
	{
		
		sfContext::getInstance()->getConfiguration()->loadHelpers('Url');  
		
		$totPage = ceil($totNum/$pageSize);
		$prePage = $curPage - 1;
		$nextPage = $curPage + 1;
		$start = $prePage > 0 ? $prePage: 1;
		$end = ($nextPage < $totPage) ? $nextPage : $totPage;
		$pageStr = '';

		$curPage > 1 && $pageStr .= '<a href="'.url_for($href.$prePage).'" title="第'.$prePage.'页'. '"  class="pgdn">上页</a>';
		$curPage ==1 && $pageStr .= '<a href="javascript:return false;" title=""  class="pgdn">上页</a>';
		$curPage < $totPage && $pageStr .= '<a href="'.url_for($href.$nextPage).'" title="第'.$nextPage.'页'. '"  class="pgdn">下页</a>';
		$curPage == $totPage && $pageStr .= '<a href="javascript:return false;" title=""  class="pgdn">下页</a>';
		$totPage < 2 && $pageStr = '';
		
		$this->pageStr = $pageStr;	
	}
}
class page3
{
	function __construct($curPage,$totNum,$href,$pageSize=20, $atitle = '', $show=1){
		
		sfContext::getInstance()->getConfiguration()->loadHelpers('Url');  
		
		$totPage = ceil($totNum/$pageSize);
		$prePage = $curPage - 1;
		$nextPage = $curPage + 1;
		$start = $curPage > $show ? $curPage - $show : 1;
		$end = ($totPage > $show && $curPage + $show < $totPage) ? $curPage + $show : $totPage;
		
		$topPage = $pageStr = '';
		$curPage > 1 && $pageStr .= '<a href="'.url_for($href.$prePage).'" title="' . $atitle . '第'.$prePage.'页'. '" class="pgup">上一页</a>';
		if($start>1){
			$pageStr .= '<a href="'.$href . 1 .'.html" title="' . $atitle .'第1页'. '"' . $active.'>'. 1 .'</a>';
		}
		if($start>2){
			$pageStr .= '<a href="javascript:void(0);" >...</a>';
		}
		for ($i = $start; $i <= $end; $i++){
			$active = '';
			if ($i == $curPage) $active = ' class="active"';
			$pageStr .= '<a href="'.url_for($href.$i) . '"  title="' . $atitle .'第'.$i.'页'. '"'.$active.'>'.$i.'</a>';
		}
		if($totPage-1>$end){
			$pageStr .= '<a href="javascript:void(0);" >...</a>';
		}
		if($totPage>$end){
		$pageStr .= '<a href="'.$href . $totPage .'.html" title="' . $atitle .'第'.$totPage.'页'. '"' . $active.'>'.$totPage.'</a>';
		}
		$curPage < $totPage && $pageStr .= '<a href="'.url_for($href.$nextPage).'" title="' . $atitle .'第'.$nextPage.'页'. '" class="pgdn">下一页</a>';

		$totPage < 2 && $pageStr = '';
		
		$this->totPage = $totPage;
		$this->pageStr = $pageStr;
		
		
	}
}
?>

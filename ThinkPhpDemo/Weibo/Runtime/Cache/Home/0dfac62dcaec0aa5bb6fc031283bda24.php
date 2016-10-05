<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>for循环和if判断和三元操作符和switch判断和比较/区间标签</title>
</head>
<body>

<!-- eq==; neq!=; gt>; egt>=; lt<; elt<=; hep===; nhep!== -->

<?php $__FOR_START_451827651__=1;$__FOR_END_451827651__=10;for($item=$__FOR_START_451827651__;$item <= $__FOR_END_451827651__;$item+=1){ echo ($item); ?></br><?php } ?>
</br>

<!-- 在模板中使用IF,一定要注意elseif 和 else 后面的结束 / -->
<?php if($num < 10): ?>num小于10
 <?php elseif($num > 10): ?> num 大于 10
 <?php else: ?> num 等于 10<?php endif; ?>
<br />

<!-- 三元操作符 -->
<?php echo ($num>10?'大于10':'小于或等于10'); ?>
<br />
<?php switch($name): case "teacher": ?>小明，滚出去<?php break;?>
   <?php case "xiaohong": case "xiaohuang": ?>小明，你给我滚出去<?php break;?>
   <delault/>小明，自己滚出去了<?php endswitch;?>
<br />

<!-- <比较标签 name="变量名" value="变量值">输出内容</比较标签> -->
<?php if(($val) == "10"): ?>val = 10;<?php endif; ?>
<?php if(($val) != "10"): ?>val !=10; <?php else: ?> val == 10;<?php endif; ?>
<?php if(($val) == "10"): ?>val === 10;<?php else: ?> val!==10;<?php endif; ?>
<br />

<!-- 区间标签：在in notin; 之间between notbetween; range(type选择在/之间) -->
<?php if(in_array(($rangeVal), explode(',',"1,2,3"))): ?>在1,2,3区间<?php else: ?>不在1,2,3区间<?php endif; ?><br/>
<?php if(!in_array(($rangeVal), explode(',',"1,2,3,4"))): ?>不在,4区间<?php else: ?>在1,2,3,4区间<?php endif; ?><br/>
<?php $_RANGE_VAR_=explode(',',"1,10");if($rangeVal>= $_RANGE_VAR_[0] && $rangeVal<= $_RANGE_VAR_[1]):?>在1与10之间<?php else: ?>不在1与10之间<?php endif; ?><br/>
<?php $_RANGE_VAR_=explode(',',"1,100");if($rangeVal<$_RANGE_VAR_[0] || $rangeVal>$_RANGE_VAR_[1]):?>确实不在1,100这里!!<?php else: ?>在1,100之间<?php endif; ?><br/>
<?php if(in_array(($rangeVal), explode(',',"1,2,3,4,11"))): ?>存在<?php else: ?>不存在<?php endif; ?>

</body>
</html>
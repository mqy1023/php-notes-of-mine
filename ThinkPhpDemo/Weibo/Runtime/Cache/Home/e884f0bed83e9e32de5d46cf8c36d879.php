<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>volist和foreach循环数组</title>
</head>
<body>

<?php if(is_array($person)): $i = 0; $__LIST__ = array_slice($person,1,2,true);if( count($__LIST__)==0 ) : echo "none data" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><p><?php echo ($data["name"]); ?> ---volist--- <?php echo ($data["age"]); ?></p><?php endforeach; endif; else: echo "none data" ;endif; ?>
<br />

<?php if(is_array($person)): foreach($person as $key=>$data): ?><p><?php echo ($data["name"]); ?> ---foreach--- <?php echo ($data["age"]); ?></p><?php endforeach; endif; ?>

</body>
</html>
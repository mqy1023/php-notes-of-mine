<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
<?php echo (substr(md5($me['name']),0,5)); ?>
<br />
<?php echo ((isset($me['age']) && ($me['age'] !== ""))?($me['age']):'22'); ?>
<br />
<!-- ###代表$now本身(使用它是为了避免编译程序误解$now为输出值) -->
<?php echo (date('Y-m-d H:i:s',$now)); ?>
<br />
<?php echo (date('Y-m-d g:i a',time())); ?>
<br />
<?php echo (THINK_VERSION); ?>
</body>
</html>
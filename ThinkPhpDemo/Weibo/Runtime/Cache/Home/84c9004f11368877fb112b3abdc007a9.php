<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>if判断</title>
</head>
<body>
<!-- eq==; neq!=; gt>; egt>=; lt<; elt<=; hep===; nhep!== -->
<!-- 在模板中使用IF,一定要注意elseif 和 else 后面的结束 / -->
<?php if($num < 10): ?>num小于10
 <?php elseif($num > 10): ?> num 大于 10
 <?php else: ?> num 等于 10<?php endif; ?>
</body>
</html>
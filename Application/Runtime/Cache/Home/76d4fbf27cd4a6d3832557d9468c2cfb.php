<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>查看下载</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>
	<script src="/Public/jquery/jquery.min.js"></script>
	<link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="/Public/bootstrap/js/bootstrap.min.js"></script>
	<script src="/Public/js/clipboard.js"></script>
	

<script language="javascript">  
    function work1(target) {  
        //e.preventDefault();  
		$("#dropdownMenu1").text($(target).text());
    }   
	
	 function work2(target) {  
        //e.preventDefault();  
		$("#dropdownMenu2").text($(target).text());
    }  
	
		 function work3(target) {  
        //e.preventDefault();  
		$("#dropdownMenu3").text($(target).text());
    }  
</script> 

</head>
<body class="background_color">
	<div class="container">
	

		 <!-- Target -->
<input id="bar" value="<?php echo ($url); ?>">

<!-- Trigger -->
<button class="btn" data-clipboard-action="cut" data-clipboard-target="#bar">
    复制到浏览器
</button>
		</div>
 
</body>
  
</html>
<script>
var clipboard = new Clipboard('.btn');

clipboard.on('success', function(e) {
    console.info('Action:', e.action);
    console.info('Text:', e.text);
    console.info('Trigger:', e.trigger);

    e.clearSelection();
});

clipboard.on('error', function(e) {
    console.error('Action:', e.action);
    console.error('Trigger:', e.trigger);
});</script>
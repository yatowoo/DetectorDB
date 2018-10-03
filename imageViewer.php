<!DOCTYPE html>
<html>

<head>
	<title>Detector Database</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="static/resource/ustc.ico">
	<link rel="stylesheet" href="static/css/bootstrap.min.css">
	<link href="static/css/flat-ui.min.css" rel="stylesheet">
	<script src="static/js/jquery.min.js"></script>
	<script src="static/js/popper.min.js"></script>
	<script src="static/js/flat-ui.min.js"></script>
	<script src="static/js/respond.min.js"></script>
	<link href="static/css/baguetteBox.min.css" rel="stylesheet">
	<script src="static/js/baguetteBox.min.js"></script>
</head>
<body>
    <?php 
        include_once 'navbar.html';
        include_once 'Viewer.html';
        include_once 'footer.html';
	?>
	<script>
		<?php
			include 'utils.php';
			// GET params : exp=EPD&type=RXB&uid=[1..60]&test=[noise|signal]
			if(check_param('exp') && check_param('type') && check_param('uid') && check_param('test')){
				echo 'var exp = "' . $_GET['exp'] . '";';
				echo 'var type = "' . $_GET['type'] . '";';
				echo 'var uid = "' . $_GET['uid'] . '";';
				echo 'var test = "' . $_GET['test'] . '";';
			}else{
				echo 'var exp = null;';
				echo 'var type = null;';
				echo 'var uid = -1;';
				echo 'var test = null;';
			}
		?>
		$(document).ready(function(){
			$('.breadcrumb li')[1].innerHTML = '<a href="#">' + exp+'</a>';
			$('.breadcrumb li')[2].innerHTML = '<a href="#">' + type+'</a>';
			$('.breadcrumb li')[3].innerHTML = String(uid);
			$('#'+test).attr('class','list-group-item active');
			$('#Signal').attr('href',
				window.location.href.replace(test,'Signal'));
			$('#Noise').attr('href',
				window.location.href.replace(test,'Noise'));
			for(var ch = 0 ; ch < 16 ; ch++){
				//var imgPath = "/detdb/getImage.php?exp=" + exp + "&type=" + type + "&uid=" + uid + "&test=" + test + "&channel=" + ch;
				var imgPath = "/detdb/DATA/" + exp + '/' + type + 'Summary/' + type + uid + '/' + test + ch + '.png';
				var zoomHref = test + ch + ".png";
				var aTag = document.createElement("a");
				aTag.setAttribute('href', imgPath);
				aTag.setAttribute('data-caption', 'Channel '+ ch);
				var imgTag = document.createElement("img");
				imgTag.setAttribute('src',imgPath);
				var imgW = $('.gallery')[0].clientWidth / 4;
				imgTag.setAttribute('width',imgW + 'px');
				imgTag.setAttribute('title','Channel '+ ch);
				imgTag.setAttribute('alt','No Image');
				aTag.appendChild(imgTag);
				$('.gallery').append(aTag);
			}
			baguetteBox.run('.baguetteBoxTwo');
		});
	</script>
</body>
</html>

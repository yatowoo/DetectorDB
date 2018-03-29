<!DOCTYPE html>
<html>

<head>
	<title>Detector Database</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://cdn.bootcss.com/flat-ui/2.3.0/css/flat-ui.min.css" rel="stylesheet">
	<script src="https://cdn.bootcss.com/flat-ui/2.3.0/js/vendor/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>
	<script src="https://cdn.bootcss.com/flat-ui/2.3.0/js/flat-ui.min.js"></script>
	<script src="https://cdn.bootcss.com/flat-ui/2.3.0/js/vendor/respond.min.js"></script>
	<link href="https://cdn.bootcss.com/baguettebox.js/1.10.0/baguetteBox.min.css" rel="stylesheet">
	<script src="https://cdn.bootcss.com/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
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
			for(var ch = 0 ; ch < 16 ; ch++){
				var imgPath = "/detdb/Noise0.png";
				var aTag = document.createElement("a");
				aTag.setAttribute('href', imgPath);
				aTag.setAttribute('data-caption', 'Channel '+ ch);
				var imgTag = document.createElement("img");
				imgTag.setAttribute('src',imgPath);
				imgTag.setAttribute('height','125px');
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

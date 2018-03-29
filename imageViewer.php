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
		baguetteBox.run('.gallery');
	</script>
</body>
</html>

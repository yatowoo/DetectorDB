<!DOCTYPE html>
<html>

<head>
	<title>Detector Database</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="static/resource/ustc.ico">
	<link rel="stylesheet" href="static/css/bootstrap.min.css">
	<link href="static/css/flat-ui.min.css" rel="stylesheet">
	<link href="static/css/bootstrap-table.css" rel="stylesheet">
	<script src="static/js/jquery.min.js"></script>
	<script src="static/js/popper.min.js"></script>
	<script src="static/js/flat-ui.min.js"></script>
	<script src="static/js/respond.min.js"></script>
	<script src="static/js/bootstrap-table.min.js"></script>
	<script src="static/js/bootstrap-table-filter-control.min.js"></script>
	<script src="static/js/FileSaver.min.js"></script>
	<script src="static/js/tableExport.min.js"></script>
	<script src="static/js/bootstrap-table-export.min.js"></script>
</head>
<body>
    <?php 
        include_once 'navbar.html';
        include_once 'DB.html';
        include_once 'footer.html';
    ?>

    <script>
		<?php
			// Redirection for QR code interface
			include_once 'utils.php';
			if(check_param('tbname') && check_param('uid')){
				$url = "md.php?tbname=" . $_GET['tbname'] . "&uid=" . $_GET['uid'];
				echo "window.location.href='$url';";
			};
			// Set table name by $_GET?
			if(check_param('tbname')){
				$tbname = $_GET['tbname'];
			}
			else{
				$tbname = 'mrpc';
			}
			echo "var tbname = '" . $tbname . "';" ;
            $tbheader = json_decode(file_get_contents('tbheader.json'), true);
            echo "var tbheader=";
            echo json_encode($tbheader[$tbname]);
            echo ";\n";
		?>
		$('#'+tbname).attr('class','list-group-item active');
    </script>
    <script src="load.js"></script>
</body>
</html>

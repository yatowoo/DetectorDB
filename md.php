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
	<link rel="stylesheet" href="github-md.css">
</head>
<body>
  <?php 
    include_once 'navbar.html';
    include_once 'DetailMRPC.html';
    include_once 'footer.html';
	?>

	<script>
		// Rendering markdown-body
		$(document).ready(function(){
			// Options from windows.location.href - Util Function
			urlparams = window.location.href.split("?")[1];
			if(urlparams == undefined){
				$(".markdown-body")[0].innerText = "Data Not Found.";
				return;
			}
			$.getJSON("/detdb/query.php?q=detail&"+urlparams,
			function(data){
				// Nothing in database
				if(data.length == 0){
					$(".markdown-body")[0].innerText = "Data Not Found.";
					return;
				}
				$(".breadcrumb li")[2].innerText = data.main.exp;
				$(".breadcrumb li")[3].innerText = data.main.type;
				$(".breadcrumb li")[4].innerText = data.main.mid;
				// Basic Infomation
				tbmain = $(".markdown-body table")[0];
				tbmain.getElementsByTagName("th")[1].innerText = data.main.uid;
				tbmain.getElementsByTagName("td")[1].innerText = data.main.exp;
				tbmain.getElementsByTagName("td")[3].innerText = data.main.type;
				tbmain.getElementsByTagName("td")[5].innerText = data.main.stage;
				tbmain.getElementsByTagName("td")[7].innerText = data.main.mid;
				tbmain.getElementsByTagName("td")[9].innerText = data.main.qa;
				tbmain.getElementsByTagName("td")[11].innerText = data.main.test;
				
				if(data.track != undefined){
					tbmain.getElementsByTagName("td")[15].innerText = data.track[data.track.length-1].status;
					tbmain.getElementsByTagName("td")[17].innerText = data.track[data.track.length-1].location;
					tbmain.getElementsByTagName("td")[19].innerText = data.track[data.track.length-1].owner;
					tbmain.getElementsByTagName("td")[21].innerText = data.track[data.track.length-1].date;
					tbmain.getElementsByTagName("td")[23].innerText = data.track[data.track.length-1].comment;
				}
				// Production QA
				if(data.qa != undefined && data.qa.chart != undefined && data.qa.chart != "")
					$("#qa-chart")[0].src = data.qa.chart;
				else
					$("#qa-chart")[0].src = "DATA/mrpc/qa/uid" + data.main.uid + ".png";

				// Test
					// Setup
				tbsetup = $(".markdown-body table")[1].getElementsByTagName("td");
				if(data.setup != undefined){
					tbsetup[1].innerText = data.setup.from;
					tbsetup[3].innerText = data.setup.to;
					tbsetup[5].innerText = data.setup.location;
					tbsetup[7].innerText = data.setup.sys;
					tbsetup[9].innerText = data.setup.trigger;
					tbsetup[11].innerText = data.setup.fee;
					tbsetup[13].innerText = data.setup.daq;
					if(data.setup.gas != undefined && data.setup.gas != null){
						tbsetup[17].innerText = data.setup.gas["R134a"];
						tbsetup[19].innerText = data.setup.gas["iso-C4H10"];
						tbsetup[21].innerText = data.setup.gas["SF6"];
					}
					if(data.setup.env != undefined && data.setup.env != null){
						tbsetup[25].innerText = data.setup.env.T;
						tbsetup[27].innerText = data.setup.env.RH;
					}
				}
					// Result
				tbresult = $(".markdown-body table")[2].getElementsByTagName("td");
				if(data.test != undefined){
					tbresult[7].innerText = (data.test.noiserate * 1).toFixed(2);
					tbresult[8].innerText = (data.test.acceptance * 100).toFixed(1);
					tbresult[9].innerText = (data.test.efficiency * 100).toFixed(1);
					tbresult[10].innerText = (data.test.resolution * 1).toFixed(1);
					tbresult[11].innerText = (data.test.current * 1).toFixed(0);
					// TODO : design API for PATH to binary object
					if(data.test.currentfile != undefined && data.test.currentfile != "")
						$("#current-chart")[0].src = data.test.currentfile;
					else
						$("#current-chart")[0].src = "DATA/mrpc/test/current/uid"+data.main.uid+".png";

					if(data.test.noisefile != undefined && data.test.noisefile != "")
						$("#noise-chart")[0].src = data.test.noisefile;
					else
						$("#noise-chart")[0].src = "DATA/mrpc/test/noise/uid"+data.main.uid+".png";
				}
			});
		});
	</script>
</body>
</html>

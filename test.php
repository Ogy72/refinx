<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Refinx</title>

    <!--css-->
    <link rel="stylesheet" href="css/halaman-utama.css">
    <link rel="stylesheet" href="css/view.css">
    <link rel="stylesheet" href="css/print.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker3.min.css">

    <!--JS-->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="js/Chart.js"></script>
</head>

<div style="width:500px; height:500px">
        <canvas id="chartCart"></canvas>
  </div>
<body>

</body>
</html>

<script>
$(document).ready(function(){
  test();
});

function test(){
  var action = "data";
    $.ajax({
    url:"data.php",
    method:"POST",
    data:{action:action},
    success:function(data){
      var tipe = [];
      var jumlah = [];

      for (var i in data) {
      	tipe.push(data[i].tipe);
        jumlah.push(data[i].jumlah);
      }

      var ctx = document.getElementById("chartCart").getContext('2d');
      var chartInk = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: tipe,
            datasets: [{
                label: '',
                data: jumlah,
                backgroundColor: [
                '#0000ff',
                '#ff0000',
                '#ffff00',
                '#008000'
                ],
                borderColor: [
                '#0000ff',
                '#ff0000',
                '#ffff00',
                '#008000'
                ],
                borderWidth:1
            }]
        },
        options: {
			    scales: {
				    yAxes: [{
					    ticks: {
						    beginAtZero:true
					    }
				    }]
			    }
		    }
      });

    }
  })
}
</script>
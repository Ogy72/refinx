<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <script type="text/javascript" src="js/Chart.js"></script>
</head>
<body>

    <div class="panel-grafik">
        <h3 id="grf-refill">Grafik Refill Per-Teknisi</h3>
        <h3 id="grf-tinta">Grafik Penggunaan Tinta</h3>
        <h3 id="grf-cartridge">Grafik Jumlah Cartridge Masuk</h3>
        <p><? echo "Bulan : "; echo date('M-Y')?></p>
        <canvas id="chartReff" class="chartReff"></canvas>
        <canvas id="chartInk" class="chartInk"></canvas>
        <canvas id="chartCart" class="chartCart"></canvas>
        
    </div>
    <div class="panel-button">
        <input type="button" value="Grafik Refill" class="btn-grafik" id="grafik-refill">
        <input type="button" value="Grafik Tinta" class="btn-grafik" id="grafik-tinta">
        <input type="button" value="Grafik Cartridge" class="btn-grafik" id="grafik-cartridge">
    </div>
</body>
</html>

<?
include "model/model_infrefill.php";

$get = new model_infrefill();
$month = date('m');
?>

<script>

    grafik_refill();
    $('#grf-refill').show();
    $('#grf-tinta').hide();
    $('#grf-cartridge').hide();
    $('.chartInk').hide();
    $('.chartCart').hide();

    $('#grafik-tinta').click(function(){
        grafik_tinta();
        $('#grf-refill').hide();
        $('#grf-tinta').show();
        $('#grf-cartridge').hide();

        $('.chartReff').hide();
        $('.chartInk').show();
        $('.chartCart').hide();
    });

    $('#grafik-cartridge').click(function(){
        grafik_cartridge();
        $('#grf-refill').hide();
        $('#grf-tinta').hide();
        $('#grf-cartridge').show();

        $('.chartReff').hide();
        $('.chartInk').hide();
        $('.chartCart').show();
        
    })

    $('#grafik-refill').click(function(){
        grafik_refill();
        $('#grf-tinta').hide();
        $('#grf-cartridge').hide();
        $('#grf-refill').show();

        $('.chartInk').hide();
        $('.chartCart').hide();
        $('.chartReff').show();
    })

    function grafik_tinta(){
    var ctx = document.getElementById("chartInk").getContext('2d');
    var chartInk = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Canon", "HP"],
            datasets: [{
                label: 'Black',
                data: [
                    <?
                    $get->merek = 'Canon';
                    $get->warna = 'Black';
                    $get->month = $month;
                    $data = $get->color();
                    $x = $get->fetch($data);
                    echo $x['total_isi'];
                    ?>,
                    <?
                    $get->merek = 'HP';
                    $get->warna = 'Black';
                    $get->month = $month;
                    $data = $get->color();
                    $x = $get->fetch($data);
                    echo $x['total_isi'];
                    ?>
                ],
                backgroundColor: [
                'rgba(0, 0, 0, 0.7)',
                'rgba(0, 0, 0, 0.7)',
                ],
                borderColor: [
                'rgba(0, 0, 0)',
                'rgba(0, 0, 0)',
                ],
                borderWidth:1
            },
            {
                label: 'Cyan',
                data: [
                    <?
                    $get->merek = 'Canon';
                    $get->warna = 'Cyan';
                    $get->month = $month;
                    $data = $get->color();
                    $x = $get->fetch($data);
                    echo $x['total_isi'];
                    ?>,
                    <?
                    $get->merek = 'HP';
                    $get->warna = 'Cyan';
                    $get->month = $month;
                    $data = $get->color();
                    $x = $get->fetch($data);
                    echo $x['total_isi'];
                    ?>
                ],
                backgroundColor: [
                'rgba(0, 255, 255, 0.7)',
				'rgba(0, 255, 255, 0.7)',
                ],
                borderColor: [
                'rgba(0, 255, 255)',
				'rgba(0, 255, 255)',
                ],
                borderWidth:1
            },
            {
                label: 'Magenta',
                data: [
                    <?
                    $get->merek = 'Canon';
                    $get->warna = 'Magenta';
                    $get->month = $month;
                    $data = $get->color();
                    $x = $get->fetch($data);
                    echo $x['total_isi'];
                    ?>,
                    <?
                    $get->merek = 'HP';
                    $get->warna = 'Magenta';
                    $get->month = $month;
                    $data = $get->color();
                    $x = $get->fetch($data);
                    echo $x['total_isi'];
                    ?>],
                backgroundColor: [
                'rgba(255, 0, 255, 0.7)',
				'rgba(255, 0, 255, 0.7)'
                ],
                borderColor: [
                'rgba(255, 0, 255)',
				'rgba(255, 0, 255)'
                ],
                borderWidth:1
            },
            {
                label: 'Yellow',
                data: [
                    <?
                    $get->merek = 'Canon';
                    $get->warna = 'Yellow';
                    $get->month = $month;
                    $data = $get->color();
                    $x = $get->fetch($data);
                    echo $x['total_isi'];
                    ?>,
                    <?
                    $get->merek = 'HP';
                    $get->warna = 'Yellow';
                    $get->month = $month;
                    $data = $get->color();
                    $x = $get->fetch($data);
                    echo $x['total_isi'];
                    ?>],
                backgroundColor: [
                'rgba(255, 255, 0, 0.7)',
				'rgba(255, 255, 0, 0.7)'
                ],
                borderColor: [
                'rgba(255, 255, 0)',
				'rgba(255, 255, 0)'
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

    

    function grafik_cartridge(){
    var action = "dat-cartridge";
    $.ajax({
        url:"controller/controller_infrefill.php",
        method:"POST",
        data:{action:action},
        success:function(data){
            var tipe = [];
            var jumlah = [];

            for (var i in data){
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
                    'rgba(255, 0, 0, 0.7)',
                    'rgba(0, 0, 255, 0.7)',
                    'rgba(255, 255, 0, 0.7)',
                    'rgba(256, 165, 0, 0.7)',
                    'rgba(0, 128, 0, 0.7)',
                    'rgba(0, 0, 0, 0.7)'
                    ],
                    borderColor: [
                    'rgba(255, 0, 0, 0.7)',
                    'rgba(0, 0, 255, 0.7)',
                    'rgba(255, 255, 0, 0.7)',
                    'rgba(256, 165, 0, 0.7)',
                    'rgba(0, 128, 0, 0.7)',
                    'rgba(0, 0, 0, 0.7)'
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

    function grafik_refill(){
    var action = "dat-refill";
    $.ajax({
        url:"controller/controller_infrefill.php",
        method:"POST",
        data:{action:action},
        success:function(data){
            var nama = [];
            var jumlah_refill = [];

            for (var i in data){
                nama.push(data[i].nama);
                jumlah_refill.push(data[i].jumlah_refill);
            }

        var ctx = document.getElementById("chartReff").getContext('2d');
        var chartInk = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: nama,
                datasets: [{
                    label: '',
                    data: jumlah_refill,
                    backgroundColor: [
                    'rgba(255, 0, 0, 0.7)',
                    'rgba(0, 0, 255, 0.7)',
                    'rgba(255, 255, 0, 0.7)',
                    'rgba(256, 165, 0, 0.7)',
                    'rgba(0, 128, 0, 0.7)',
                    'rgba(0, 0, 0, 0.7)'
                    ],
                    borderColor: [
                    'rgba(255, 0, 0, 0.7)',
                    'rgba(0, 0, 255, 0.7)',
                    'rgba(255, 255, 0, 0.7)',
                    'rgba(256, 165, 0, 0.7)',
                    'rgba(0, 128, 0, 0.7)',
                    'rgba(0, 0, 0, 0.7)'
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
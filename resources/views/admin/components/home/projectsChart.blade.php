<div style="display: none;">
    @php
    $ProjectTypesList = [];
    $TotalProjects = [];
    $ApprovedProjects = [];

    $ProjectDeptList = [];
    $TotalDeptProjects = [];
    $ApprovedDeptProjects = [];

    $ProjectDeptPerList = [];
    $TotalDeptPerProjects = [];
@endphp
@foreach ($projects_chart as $item)
    {{ $ProjectTypesList[] = $item->name }}
    {{ $TotalProjects[] = $item->projects_count }}
    {{ $ApprovedProjects[] = $item->approved_projects_count }}
@endforeach

@foreach ($projects_dept_chart as $item)
    {{ $ProjectDeptList[] = $item->name }}
    {{ $TotalDeptProjects[] = $item->projects_count }}
    {{ $ApprovedDeptProjects[] = $item->approved_projects_count }}
    @if ($item->projects_count > 0)
        {{ $ProjectDeptPerList[] = $item->name }}
        {{ $TotalDeptPerProjects[] = $item->projects_count }}
    @endif
@endforeach
</div>
<script type="text/javascript">
'use strict';
$(document).ready(function() {
	function generateData(baseval, count, yrange) {
		var i = 0;
		var series = [];
		while (i < count) {
			var x = Math.floor(Math.random() * (750 - 1 + 1)) + 1;;
			var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
			var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;

			series.push([x, y, z]);
			baseval += 86400000;
			i++;
		}
		return series;
	}

  // Simple Column
  if ($('#projects-chart').length > 0) {
    var sCol = {
      chart: {
        height: 350,
        type: 'bar',
        toolbar: {
          show: false,
        }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '55%',
          endingShape: 'rounded'
        },
      },
      colors: ['#FF9F43', '#4361ee'],
      dataLabels: {
        enabled: true
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      series: [{
        name: 'Yuklangan loyihalar',
        data: <?php echo json_encode($TotalProjects); ?>
      }, {
        name: 'Tasdiqlangan',
        data: <?php echo json_encode($ApprovedProjects); ?>
      }],
      xaxis: {
        categories: <?php echo json_encode($ProjectTypesList); ?>,
        labels: {
          show: false,
          maxHeight: 200
        }
      },
      yaxis: {
        title: {
          text: 'SONLARDA'
        }
      },
      fill: {
        opacity: 1

      },
      tooltip: {
        y: {
          formatter: function (val) {
            return ": " + val + " ta"
          }
        }
      }
    }

    var chart = new ApexCharts(
      document.querySelector("#projects-chart"),
      sCol
    );

    chart.render();
  }

  //Boshqarmalar kesimida loyuihalar
  if ($('#projects-dept-chart').length > 0) {
    var sCol = {
      chart: {
        height: 400,
        type: 'bar',
        toolbar: {
          show: false,
        }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '55%',
          endingShape: 'rounded'
        },
      },
      colors: ['#FF9F43', '#4361ee'],
      dataLabels: {
        enabled: true
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      series: [{
        name: 'Yuklangan loyihalar',
        data: <?php echo json_encode($TotalDeptProjects); ?>
      }, {
        name: 'Tasdiqlangan',
        data: <?php echo json_encode($ApprovedDeptProjects); ?>
      }],
      xaxis: {
        categories: <?php echo json_encode($ProjectDeptList); ?>,
        labels: {
          //show: false,
          maxHeight: 200
        },
      },
      yaxis: {
        title: {
          text: 'SONLARDA'
        }
      },
      fill: {
        opacity: 1
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return ": " + val + " ta"
          }
        }
      }
    }

    var chart = new ApexCharts(
      document.querySelector("#projects-dept-chart"),
      sCol
    );

    chart.render();
  }

// Project Departments
if($('#project-dept-per-chart').length > 0 ){
  var donutChart = {
    chart: {
      height: 350,
      type: 'donut',
      toolbar: {
        show: false,
      }
    },
    colors: [
    "rgb(255, 99, 132)", // Qizil
    "rgb(54, 162, 235)", // Ko‘k
    "rgb(75, 192, 192)", // Suv rang
    "rgb(255, 206, 86)", // Sariq
    "rgb(153, 102, 255)", // Moviy-binafsha
    "rgb(255, 159, 64)", // To‘q sariq
    "rgb(46, 204, 113)", // Yashil
    "rgb(231, 76, 60)", // Qizil-tosh rang
    "rgb(52, 73, 94)" // Qoramtir ko‘k
    ],
    series: <?php echo json_encode($TotalDeptPerProjects); ?>,
    labels: <?php echo json_encode($ProjectDeptPerList); ?>,
    legend:false,
    responsive: [{
      breakpoint: 480,
      options: {
        chart: {
          width: 200
        },
        legend: {
          show: false,
          position: 'bottom'
        },
      }
    }]
  }

  var donut = new ApexCharts(document.querySelector("#project-dept-per-chart"), donutChart);
  donut.render();
}

// Donut Chart
if($('#project-per-chart').length > 0 ){
  var donutChart = {
    chart: {
      height: 350,
      type: 'donut',
      toolbar: {
        show: false,
      }
    },
    colors: [
    "rgb(255, 87, 51)", // To'q qizil
    "rgb(0, 150, 136)", // Sarg‘ish yashil
    "rgb(103, 58, 183)", // Binafsha
    "rgb(255, 193, 7)", // Oltin sariq
    "rgb(156, 39, 176)", // Yorqin binafsha
    "rgb(33, 150, 243)", // Moviy
    "rgb(244, 67, 54)", // Och qizil
    "rgb(76, 175, 80)", // Yashil
    "rgb(121, 85, 72)" // Qoramtir jigar rang
    ],
    series: <?php echo json_encode($TotalProjects); ?>,
    labels: <?php echo json_encode($ProjectTypesList); ?>,
    responsive: [{
      breakpoint: 480,
      options: {
        chart: {
          width: 200
        },
        legend: {
          position: 'bottom'
        }
      }
    }]
  }

  var donut = new ApexCharts(document.querySelector("#project-per-chart"), donutChart);
  donut.render();
}

});
</script>
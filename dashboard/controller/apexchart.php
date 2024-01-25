<script>
  // ApexCharts options and config
  window.addEventListener("load", function() {
    let options = {
      chart: {
        height: "100%",
        maxWidth: "100%",
        type: "area",
        fontFamily: "Inter, sans-serif",
        dropShadow: {
          enabled: false,
        },
        toolbar: {
          show: false,
        },
      },
      tooltip: {
        enabled: true,
        x: {
          show: false,
        },
      },
      fill: {
        type: "gradient",
        gradient: {
          opacityFrom: 0.55,
          opacityTo: 0,
          shade: "#1C64F2",
          gradientToColors: ["#1C64F2"],
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        width: 6,
      },
      grid: {
        show: false,
        strokeDashArray: 4,
        padding: {
          left: 2,
          right: 2,
          top: 0
        },
      },
      series: [
        {
          name: "New users",
          data: [], // Leave this empty for now
          color: "#1A56DB",
        },
      ],
      xaxis: {
        categories: [], // Leave this empty for now
        labels: {
          show: true,
        },
        axisBorder: {
          show: false,
        },
        axisTicks: {
          show: true,
        },
      },
      yaxis: {
        show: true,
      },
    };

    // Define the chart variable outside the if block
    let chart;

    if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
      chart = new ApexCharts(document.getElementById("area-chart"), options);
      chart.render();
    }

    fetch('controller/chartcalculator.php')
    .then(response => response.json())
    .then(data => {
      const newData = processData(data);
      updateChart(newData);
    })
    .catch(error => console.error('Error fetching data:', error));

    function processData(data) {
      const newData = [];
      const dateMap = {};

      data.forEach(item => {
        const date = item.date;
        if (!dateMap[date]) {
          dateMap[date] = { date, entryCount: 0 };
        }
        dateMap[date].entryCount += parseInt(item.entry_count);
      });

      for (const date in dateMap) {
        newData.push(dateMap[date]);
      }

      return newData;
    }

    function updateChart(newData) {
      if (chart) { // Check if chart is defined
        // Update the series data with newData
        chart.updateSeries([
          {
            name: "New users",
            data: newData.map(item => item.entryCount),
            color: "#1A56DB",
          },
        ]);

        // Update x-axis categories
        const categories = newData.map(item => item.date);
        chart.updateOptions({
          xaxis: {
            categories: categories,
          }
        });
      }
    }
  });
</script>

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

const pieChartData = function() {
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.open('get', 'utils/getCounts.php', true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          const response = JSON.parse(xhr.responseText);
          if (!response.error) {
            resolve([response.student_count, response.gatepass_count]);
          } else {
            reject("Error: " + response.error);
          }
        } else {
          reject("Error: " + xhr.statusText);
        }
      }
    }
    xhr.send();
  });
}

// Usage
pieChartData()
  .then(data => {
    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ["Students", "GatePasses"],
        datasets: [{
          data: data,
          backgroundColor: ['#4e73df', '#1cc88a'],
          hoverBackgroundColor: ['#2e59d9', '#17a673'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 80,
      },
    });
  })
  .catch(error => {
    console.error(error);
  });

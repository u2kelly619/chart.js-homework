<!DOCTYPE html>
<html lang="en">
  <head>
    <title>台灣博士人口</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.0.2 -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <h1 class="text-center mt-3 p-3">台灣博士人口</h1>
    <h3 class="text-center text-muted">總數：97683人</h3>

    <!-- HORIZONTAL_BAR -->
    <h2 class="text-center mt-5 p-3">一、各縣市博士人口</h2>
    <div class="container">
      <canvas id="myChart4"></canvas>
    </div>

    <!-- PIE -->
    <h2 class="text-center mt-5 p-3">二、各縣市佔比</h2>
    <h5 class="text-center text-muted">縣市博士人口數/總博士人口數</h5>
    <div class="container">
      <canvas id="myChart3"></canvas>
    </div>

    <!-- BAR -->
    <h2 class="text-center mt-5 p-3">三、各縣市男女博士人口</h2>
    <div class="container">
      <canvas id="myChart"></canvas>
    </div>

    <!-- DOUGHNUT -->
    <h2 class="text-center mt-5 p-3">四、縣市博士人口比例</h2>
    <h5 class="text-center text-muted">縣市博士人口數/縣市總人口數</h5>
    <div class="container">
      <canvas id="myChart2"></canvas>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script>
      $.ajax({
        url: "http://localhost/chart-js-homework/chart-api.php",
        method: "GET",
        dataType: "json",
        })
        .done(function( data ) {
                // console.log(data);
                let city=[];
                let male=[];
                let female=[];
                let sum=[];
                let city_doctor_ratio=[];
                let city_population=[];
                let city_population_ratio=[]; 

                //用for迴圈把資料塞進空陣列
                for(i=0; i<data.length; i++){
                    city.push(data[i].city);
                    male.push(data[i].male);
                    female.push(data[i].female);
                    sum.push(data[i].sum);
                    city_doctor_ratio.push(data[i].city_doctor_ratio);
                    city_population.push(data[i].city_population);
                    city_population_ratio.push(data[i].city_population_ratio);
                }

                //HORIZONTAL_BAR
                let ctx4 = document.getElementById("myChart4");
                const data4 = {
                    labels: city,
                    datasets: [
                    {
                        label: "博士人口數",
                        data: sum,
                        backgroundColor: [
                        "#264653",
                        "#2a9d8f",
                        "#e9c46a",
                        "#f4a261",
                        "#e76f51",
                        ],
                        borderColor: ["#ffffff"],
                        borderWidth: 1,
                    },
                    ],
                };
                const config4 = {
                    type: "bar",
                    data: data4,
                    options: {
                    indexAxis: 'y',
                    scales: {
                        y: {
                        stacked: true,
                        beginAtZero: true,
                        },
                    },
                    plugins: {
                        legend: {
                        display: false,
                        },
                    },
                    },
                };
                const myChart4 = new Chart(ctx4, config4); 

                //PIE
                let ctx3 = document.getElementById("myChart3");
                const data3 = {
                  labels: city,
                  datasets: [
                    {
                      label: "City",
                      data: city_doctor_ratio,
                      backgroundColor: [
                        "#264653",
                        "#2a9d8f",
                        "#e9c46a",
                        "#f4a261",
                        "#e76f51",
                      ],
                      borderColor: ["#ffffff"],
                      borderWidth: 1,
                    },
                  ],
                };
                const config3 = {
                  type: "pie",
                  data: data3,
                  options: {
                    aspectRatio: 2,
                    scales: {
                      y: {
                        stacked: true,
                        beginAtZero: true,
                      },
                    },
                    plugins: {
                      legend: {
                        display: false,
                      },
                    },
                  },
                };
                const myChart3 = new Chart(ctx3, config3); 

                //BAR
                let ctx1 = document.getElementById("myChart");
                const data1 = {
                  labels: city,
                  datasets: [
                    {
                      label: "Male",
                      data: male,
                      backgroundColor: ["#2a9d8f"],
                      // borderColor: ["rgb(255, 99, 132)"],
                      borderWidth: 1,
                    },
                    {
                      label: "Female",
                      data: female,
                      backgroundColor: ["#e9c46a"],
                      // borderColor: ["rgb(255, 159, 132)"],
                      borderWidth: 1,
                    },
                  ],
                };
                const config1 = {
                  type: "bar",
                  data: data1,
                  options: {
                    scales: {
                      x: {
                        stacked: true,
                      },
                      y: {
                        stacked: true,
                        beginAtZero: true,
                      },
                    },
                  },
                };
                const myChart = new Chart(ctx1, config1);

                //DOUGHNUT，比例
                let ctx2 = document.getElementById("myChart2");
                const data2 = {
                  labels: city,
                  datasets: [
                    {
                      label: "City Population Ratio",
                      data: city_population_ratio,
                      backgroundColor: [
                        "#264653",
                        "#2a9d8f",
                        "#e9c46a",
                        "#f4a261",
                        "#e76f51",
                      ],
                      borderColor: ["#ffffff"],
                      borderWidth: 1,
                    },
                  ],
                };
                const config2 = {
                  type: "doughnut",
                  data: data2,
                  options: {
                    aspectRatio: 2,
                    cutout: "70%",
                    scales: {
                      y: {
                        stacked: true,
                        beginAtZero: true,
                      },
                    },
                    plugins: {
                      legend: {
                        display: false,
                      },
                    },
                  },
                };
                const myChart2 = new Chart(ctx2, config2);


        }).fail(function( jqXHR, textStatus ) {
            console.log( "Request failed: " + textStatus );
        });

    </script>
  </body>
</html>

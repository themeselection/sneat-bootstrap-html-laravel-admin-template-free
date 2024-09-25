/**
 * Dashboard Analytics
 */

'use strict';

(function() {
    let cardColor, headingColor, legendColor, labelColor, shadeColor, borderColor;

    cardColor = config.colors.cardColor;
    headingColor = config.colors.headingColor;
    legendColor = config.colors.bodyColor;
    labelColor = config.colors.textMuted;
    borderColor = config.colors.borderColor;

    // Total Revenue Report Chart - Bar Chart
    // --------------------------------------------------------------------
    const totalRevenueChartEl = document.querySelector('#totalRevenueChart'),
        totalRevenueChartOptions = {
            series: [{
                    name: new Date().getFullYear() - 1,

                    data: [18, 7, 15, 29, 18, 12, 9]
                },
                {
                    name: new Date().getFullYear() - 2,
                    data: [-13, -18, -9, -14, -5, -17, -15]
                }
            ],
            chart: {
                height: 317,
                stacked: true,
                type: 'bar',
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '30%',
                    borderRadius: 8,
                    startingShape: 'rounded',
                    endingShape: 'rounded'
                }
            },
            colors: [config.colors.primary, config.colors.info],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 6,
                lineCap: 'round',
                colors: [cardColor]
            },
            legend: {
                show: true,
                horizontalAlign: 'left',
                position: 'top',
                markers: {
                    height: 8,
                    width: 8,
                    radius: 12,
                    offsetX: -5
                },
                fontSize: '13px',
                fontFamily: 'Public Sans',
                fontWeight: 400,
                labels: {
                    colors: legendColor,
                    useSeriesColors: false
                },
                itemMargin: {
                    horizontal: 10
                }
            },
            grid: {
                strokeDashArray: 7,
                borderColor: borderColor,
                padding: {
                    top: 0,
                    bottom: -8,
                    left: 20,
                    right: 20
                }
            },
            fill: {
                opacity: [1, 1]
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                labels: {
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Public Sans',
                        colors: labelColor
                    }
                },
                axisTicks: {
                    show: false
                },
                axisBorder: {
                    show: false
                }
            },
            yaxis: {
                labels: {
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Public Sans',
                        colors: labelColor
                    }
                }
            },
            responsive: [{
                    breakpoint: 1700,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: '35%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 1440,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 12,
                                columnWidth: '43%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 1300,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 11,
                                columnWidth: '45%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 1200,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 11,
                                columnWidth: '37%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 1040,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 12,
                                columnWidth: '45%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 991,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 12,
                                columnWidth: '33%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 768,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 11,
                                columnWidth: '28%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 640,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 11,
                                columnWidth: '30%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 576,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: '38%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 440,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: '50%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 380,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 9,
                                columnWidth: '60%'
                            }
                        }
                    }
                }
            ],
            states: {
                hover: {
                    filter: {
                        type: 'none'
                    }
                },
                active: {
                    filter: {
                        type: 'none'
                    }
                }
            }
        };
    if (typeof totalRevenueChartEl !== undefined && totalRevenueChartEl !== null) {
        const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
        totalRevenueChart.render();
    }

    // Growth Chart - Radial Bar Chart
    // --------------------------------------------------------------------
    const growthChartEl = document.querySelector('#growthChart'),
        growthChartOptions = {
            series: [92],
            labels: ['Bibit'],
            chart: {
                height: 240,
                type: 'radialBar'
            },
            plotOptions: {
                radialBar: {
                    size: 150,
                    offsetY: 10,
                    startAngle: -150,
                    endAngle: 150,
                    hollow: {
                        size: '55%'
                    },
                    track: {
                        background: cardColor,
                        strokeWidth: '100%'
                    },
                    dataLabels: {
                        name: {
                            offsetY: 15,
                            color: legendColor,
                            fontSize: '15px',
                            fontWeight: '500',
                            fontFamily: 'Public Sans'
                        },
                        value: {
                            offsetY: -25,
                            color: headingColor,
                            fontSize: '22px',
                            fontWeight: '500',
                            fontFamily: 'Public Sans'
                        }
                    }
                }
            },
            colors: [config.colors.primary],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    shadeIntensity: 0.5,
                    gradientToColors: [config.colors.primary],
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 0.6,
                    stops: [30, 70, 100]
                }
            },
            stroke: {
                dashArray: 5
            },
            grid: {
                padding: {
                    top: -35,
                    bottom: -10
                }
            },
            states: {
                hover: {
                    filter: {
                        type: 'none'
                    }
                },
                active: {
                    filter: {
                        type: 'none'
                    }
                }
            }
        };
    if (typeof growthChartEl !== undefined && growthChartEl !== null) {
        const growthChart = new ApexCharts(growthChartEl, growthChartOptions);
        growthChart.render();
    }

    // Profit Report Line Chart
    // --------------------------------------------------------------------
    const profileReportChartEl = document.querySelector('#profileReportChart'),
        profileReportChartConfig = {
            chart: {
                height: 75,
                // width: 175,
                type: 'line',
                toolbar: {
                    show: false
                },
                dropShadow: {
                    enabled: true,
                    top: 10,
                    left: 5,
                    blur: 3,
                    color: config.colors.warning,
                    opacity: 0.15
                },
                sparkline: {
                    enabled: true
                }
            },
            grid: {
                show: false,
                padding: {
                    right: 8
                }
            },
            colors: [config.colors.warning],
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 5,
                curve: 'smooth'
            },
            series: [{
                data: [110, 270, 145, 245, 205, 285]
            }],
            xaxis: {
                show: false,
                lines: {
                    show: false
                },
                labels: {
                    show: false
                },
                axisBorder: {
                    show: false
                }
            },
            yaxis: {
                show: false
            }
        };
    if (typeof profileReportChartEl !== undefined && profileReportChartEl !== null) {
        const profileReportChart = new ApexCharts(profileReportChartEl, profileReportChartConfig);
        profileReportChart.render();
    }

    // Order Statistics Chart
    // --------------------------------------------------------------------
    const chartOrderStatistics = document.querySelector('#orderStatisticsChart'),
        orderChartConfig = {
            chart: {
                height: 180,
                width: 210,
                type: 'donut'
            },
            labels: ['JTDB', 'JTAB', 'Pencapaian Kualitas Tanam', 'Kedalaman'],
            series: [50, 85, 25, 40],
            colors: [config.colors.success, config.colors.primary, config.colors.secondary, config.colors.info],
            stroke: {
                width: 5,
                colors: [cardColor]
            },
            dataLabels: {
                enabled: false,
                formatter: function(val, opt) {
                    return parseInt(val) + '%';
                }
            },
            legend: {
                show: false
            },
            grid: {
                padding: {
                    top: 0,
                    bottom: 0,
                    right: 15
                }
            },
            states: {
                hover: {
                    filter: { type: 'none' }
                },
                active: {
                    filter: { type: 'none' }
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '75%',
                        labels: {
                            show: true,
                            value: {
                                fontSize: '18px',
                                fontFamily: 'Public Sans',
                                fontWeight: 500,
                                color: headingColor,
                                offsetY: -17,
                                formatter: function(val) {
                                    return parseInt(val) + '%';
                                }
                            },
                            name: {
                                offsetY: 17,
                                fontFamily: 'Public Sans'
                            },
                            total: {
                                show: true,
                                fontSize: '13px',
                                color: legendColor,
                                label: 'Capaian Kualitas',
                                formatter: function(w) {
                                    return '96.74%';
                                }
                            }
                        }
                    }
                }
            }
        };
    if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
        const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
        statisticsChart.render();
    }

    // Income Chart - Area chart
    // --------------------------------------------------------------------
    const gudangmixer = [21, 30, 22, 42, 26, 35, 29];
    const dataAdukanBahan = [25, 28, 20, 38, 22, 32, 25];
    const dataBoomSpray = [18, 25, 19, 35, 20, 28, 23];

    const incomeChartEl = document.querySelector('#incomeChart'),
        incomeChartConfig = {
            series: [{
                    name: "Gudang Mixer",
                    data: gudangmixer
                },
                {
                    name: "Adukan Bahan",
                    data: dataAdukanBahan
                },
                {
                    name: "Boom Spary Dan Cameco",
                    data: dataBoomSpray
                }
            ],
            chart: {
                height: 232,
                parentHeightOffset: 0,
                parentWidthOffset: 0,
                toolbar: {
                    show: false
                },
                type: 'area'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 3,
                curve: 'smooth'
            },
            legend: {
                show: true,
                position: 'top',
                horizontalAlign: 'right',
                floating: true,
                offsetY: -25,
                offsetX: -5
            },
            markers: {
                size: 6,
                colors: 'transparent',
                strokeColors: 'transparent',
                strokeWidth: 4,
                discrete: [{
                    fillColor: config.colors.white,
                    seriesIndex: 0,
                    dataPointIndex: 6,
                    strokeColor: config.colors.primary,
                    strokeWidth: 2,
                    size: 6,
                    radius: 8
                }],
                hover: {
                    size: 7
                }
            },
            colors: [config.colors.primary],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: shadeColor,
                    shadeIntensity: 0.6,
                    opacityFrom: 0.5,
                    opacityTo: 0.25,
                    stops: [0, 95, 100]
                }
            },
            grid: {
                borderColor: borderColor,
                strokeDashArray: 8,
                padding: {
                    top: -20,
                    bottom: -8,
                    left: 0,
                    right: 8
                }
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    show: true,
                    style: {
                        fontSize: '13px',
                        colors: labelColor
                    }
                }
            },
            yaxis: {
                labels: {
                    show: false
                },
                min: 10,
                max: 50,
                tickAmount: 4
            }
        };
    if (typeof incomeChartEl !== undefined && incomeChartEl !== null) {
        const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
        incomeChart.render();
    }

    // Expenses Mini Chart - Radial Chart
    // --------------------------------------------------------------------
    const weeklyExpensesEl = document.querySelector('#expensesOfWeek'),
        weeklyExpensesConfig = {
            series: [100],
            chart: {
                width: 60,
                height: 60,
                type: 'radialBar'
            },
            plotOptions: {
                radialBar: {
                    startAngle: 0,
                    endAngle: 360,
                    strokeWidth: '8',
                    hollow: {
                        margin: 2,
                        size: '40%'
                    },
                    track: {
                        background: borderColor
                    },
                    dataLabels: {
                        show: true,
                        name: {
                            show: false
                        },
                        value: {
                            formatter: function(val) {
                                return parseInt(val) + '%';
                            },
                            offsetY: 5,
                            color: legendColor,
                            fontSize: '12px',
                            fontFamily: 'Public Sans',
                            show: true
                        }
                    }
                }
            },
            fill: {
                type: 'solid',
                colors: config.colors.primary
            },
            stroke: {
                lineCap: 'round'
            },
            grid: {
                padding: {
                    top: -10,
                    bottom: -15,
                    left: -10,
                    right: -10
                }
            },
            states: {
                hover: {
                    filter: {
                        type: 'none'
                    }
                },
                active: {
                    filter: {
                        type: 'none'
                    }
                }
            }
        };
    if (typeof weeklyExpensesEl !== undefined && weeklyExpensesEl !== null) {
        const weeklyExpenses = new ApexCharts(weeklyExpensesEl, weeklyExpensesConfig);
        weeklyExpenses.render();
    }

    const volumeair = [75, 95, 85, 97, 100, 70];
    const incomeChartEl1 = document.querySelector('#incomeChart1'),
        incomeChartConfig1 = {
            series: [{
                name: "Volume Air Per Aktivitas",
                data: volumeair
            }],
            chart: {
                height: 232,
                type: 'bar',
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            plotOptions: {
                bar: {
                    horizontal: false, // Jika Anda ingin horizontal bar, ubah menjadi true
                    columnWidth: '50%', // Sesuaikan lebar kolom
                    endingShape: 'rounded' // Bentuk ujung bar (pilihan: flat, rounded)
                }
            },
            legend: {
                show: true,
                position: 'top',
                horizontalAlign: 'right'
            },
            colors: [config.colors.primary],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                padding: {
                    top: -20,
                    bottom: 0,
                    left: 0,
                    right: 0
                }
            },
            xaxis: {
                categories: ['BDF 1', 'BDF 2', 'BDF 3', 'BDF 4', 'BDF 5', 'BDF 6'], // Nama kategori (misalnya lokasi)
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        fontSize: '13px',
                        colors: labelColor
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: labelColor
                    }
                },
                min: 0,
                max: 150, // Sesuaikan dengan range data Anda
                tickAmount: 5
            }
        };

    if (typeof incomeChartEl1 !== undefined && incomeChartEl1 !== null) {
        const incomeChart1 = new ApexCharts(incomeChartEl1, incomeChartConfig1);
        incomeChart1.render();
    }


    const dataKMinus = [96.70, 96.98, 97.93]; // K-
    const dataK = [98.22, 98.01, 96.74]; // K
    const dataS = [97.73, 96.78, 96.75]; // S
    const dataB = [97.83, 96.16, 95.97]; // B
    const dataOsize = [0, 96.16, 95.97]; // Osize

    const incomeChartEl2 = document.querySelector('#incomeChart2');
    const incomeChartConfig2 = {
        series: [{
                name: "K-",
                data: dataKMinus
            },
            {
                name: "K",
                data: dataK
            },
            {
                name: "S",
                data: dataS
            },
            {
                name: "B",
                data: dataB
            },
            {
                name: "Osize",
                data: dataOsize
            }
        ],
        chart: {
            height: 350,
            type: 'bar',
            stacked: true, // Enable stacking
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '50%',
                endingShape: 'rounded'
            }
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            position: 'top',
            horizontalAlign: 'center'
        },
        fill: {
            opacity: 1
        },
        colors: ['#7B68EE', '#48D1CC', '#C71585', '#DB7093', '#DDA0DD'], // Colors for each data series
        xaxis: {
            categories: ['PG1', 'PG2', 'PG3'], // X-axis labels (locations)
            labels: {
                style: {
                    fontSize: '13px',
                    colors: '#333' // Customize x-axis label color
                }
            }
        },
        yaxis: {
            labels: {
                formatter: function(value) {
                    return value + "%"; // Format y-axis labels as percentages
                }
            },
            min: 90, // Minimum value for y-axis
            max: 100 // Maximum value for y-axis
        },
        tooltip: {
            y: {
                formatter: function(value) {
                    return value + "%"; // Format tooltip values as percentages
                }
            }
        }
    };

    if (typeof incomeChartEl2 !== undefined && incomeChartEl2 !== null) {
        const incomeChart2 = new ApexCharts(incomeChartEl2, incomeChartConfig2);
        incomeChart2.render();
    }

    const dataSampah = [93.72, 86.75, 56.90]; // Ketinggian Sampah (std 100%)
    const dataKupasan = [96.38, 94.99, 95.52]; // Kebersihan Kupasan (std 95%)
    const dataPotongan = [91.13, 94.69, 91.38]; // Potongan Bonggol (std 95%)
    const dataKondisiBonggol = [100.00, 100.00, 100.00]; // Kondisi Bonggol (std 100%)
    const dataKondisiBin = [96.97, 100.00, 0.00]; // Kondisi Bin (std 100%)

    const bonggolChartEl = document.querySelector('#bonggolChart');
    const bonggolChartConfig = {
        series: [{
                name: "Ketinggian Sampah (std 100%)",
                data: dataSampah
            },
            {
                name: "Kebersihan Kupasan (std 95%)",
                data: dataKupasan
            },
            {
                name: "Potongan Bonggol (std 95%)",
                data: dataPotongan
            },
            {
                name: "Kondisi Bonggol (std 100%)",
                data: dataKondisiBonggol
            },
            {
                name: "Kondisi Bin (std 100%)",
                data: dataKondisiBin
            }
        ],
        chart: {
            type: 'bar',
            height: 350,
            stacked: false,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '50%',
                endingShape: 'flat',
                dataLabels: {
                    position: 'top' // Show data labels above bars
                }
            }
        },
        dataLabels: {
            enabled: false,
            formatter: function(val) {
                return val + "%";
            },
            offsetY: 3,
            style: {
                fontSize: '12px',
                colors: ["#304758"]
            }
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'left'
        },
        colors: ['#E9967A', '#8FBC8F', '#00BFFF', '#008B8B', '#7B68EE'], // Colors matching each dataset
        xaxis: {
            categories: ['PG1', 'PG2', 'PG3'], // X-axis labels for the locations
            labels: {
                style: {
                    fontSize: '13px',
                    colors: '#333' // Customize x-axis label color
                }
            }
        },
        yaxis: {
            labels: {
                formatter: function(value) {
                    return value + "%";
                }
            },
            min: 50, // Adjust the minimum y-axis value
            max: 100, // Set max value to 100 for percentages
            tickAmount: 5
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + "%";
                }
            }
        }
    };

    if (typeof bonggolChartEl !== undefined && bonggolChartEl !== null) {
        const bonggolChart = new ApexCharts(bonggolChartEl, bonggolChartConfig);
        bonggolChart.render();
    }


})();

document.addEventListener('DOMContentLoaded', () => {
    const applyButton = document.getElementById('apply');
    const clearButton = document.getElementById('clear');
    const websiteCount = document.getElementById('website-count');
    let trafficChartInstance = null;
    let categoryChartInstance = null;
    let approvalChartInstance = null;
    let daChartInstance = null;


    // Helper function to get all checked checkbox values for a given group
    function getCheckedValues(groupClass) {
        const checkboxes = document.querySelectorAll(`.${groupClass}:checked`);
        return Array.from(checkboxes).map(cb => cb.value);
    }

    // Create a filters object from all groups
    function getSelectedFilters() {
        const filters = {
            category: getCheckedValues('category-filter'),
            traffic: getCheckedValues('traffic-filter'),
            location: getCheckedValues('location-filter'),
            da: getCheckedValues('da-filter'),
            dr: getCheckedValues('dr-filter'),
            price: getCheckedValues('price-filter'),
            spam: getCheckedValues('spam-filter'),
            status: getCheckedValues('status-filter'),
            addedby: getCheckedValues('addedby-filter'),
            timeline: getCheckedValues('timeline-filter')
        };

        // Include custom date range if "custom" is selected
        if (filters.timeline.includes('custom')) {
            const fromDate = document.querySelector('.custom-from-date')?.value;
            const toDate = document.querySelector('.custom-to-date')?.value;
            console.log(fromDate);
            console.log(toDate);

            if (fromDate && toDate) {
                filters.custom_from = fromDate;
                filters.custom_to = toDate;
            }
        }

        return filters;
    }


    // Function to Redraw all charts
    function updateAllCharts(data) {
        Chart.register(ChartDataLabels);
        // 1. Traffic Chart
        if (data.traffic) {
            const trafficValues = Object.values(data.traffic);
            const maxValue = Math.max(...trafficValues);
            const bufferedMax = Math.ceil((maxValue * 1.2) / 5) * 5; // 20% buffer, rounded to nearest 5

            if (trafficChartInstance) trafficChartInstance.destroy();

            trafficChartInstance = new Chart(document.getElementById('trafficChart'), {
                type: 'bar',
                data: {
                    labels: Object.keys(data.traffic),
                    datasets: [{
                        label: 'Websites by Traffic Range',
                        data: trafficValues,
                        backgroundColor: 'rgba(72, 231, 231, 0.7)'
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: bufferedMax,
                            grid: {
                                display: false
                            },
                            ticks: {
                                precision: 0,
                                stepSize: 5
                            },
                            title: {
                                display: true,
                                text: 'No of Websites'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Range in Thousands'
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        datalabels: {
                            // color: function (context) {
                            //     const value = context.dataset.data[context.dataIndex];
                            //     If value is less than 25% of max, use black label on top
                            //     return value < (bufferedMax * 0.25) ? '#008383' : '#008383';
                            // },
                            color: 'rgb(0, 131, 131)',
                            anchor: function (context) {
                                const value = context.dataset.data[context.dataIndex];
                                return value < (bufferedMax * 0.25) ? 'end' : 'center';
                            },
                            align: function (context) {
                                const value = context.dataset.data[context.dataIndex];
                                return value < (bufferedMax * 0.25) ? 'top' : 'center';
                            },
                            font: {
                                weight: 'bold',
                                size: 14,
                            },
                            formatter: Math.round
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });

        }

        // 2. Category Chart
        if (data.category) {
            if (categoryChartInstance) categoryChartInstance.destroy();
            categoryChartInstance = new Chart(document.getElementById('categoryChart'), {
                type: 'doughnut',
                data: {
                    labels: Object.keys(data.category),
                    datasets: [{
                        label: 'Websites by Category',
                        data: Object.values(data.category),
                        backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56', '#4BC0C0', '#9966FF']
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            top: 0,
                            right: 20 // spacing between chart and legend
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Category Distribution',
                            font: {
                                size: 14,
                                // weight: 'bold'
                            },
                            padding: {
                                top: 0,
                                bottom: 30 // space between title and chart+legend
                            }
                        },
                        legend: {
                            position: 'right',
                            labels: {
                                boxWidth: 20,
                                padding: 10
                            }
                        },
                        datalabels: {
                            color: '#fff',
                            font: {
                                weight: 'bold',
                                size: 14
                            },
                            formatter: Math.round
                        },
                    }
                }
            });

        }

        // 4. DA Chart
        if (data.da) {
            const daValues = Object.values(data.da);
            const maxValue = Math.max(...daValues);
            const bufferedMax = Math.ceil((maxValue * 1.1) / 5) * 5; // 20% buffer, rounded to nearest 5

            if (daChartInstance) daChartInstance.destroy();
            daChartInstance = new Chart(document.getElementById('daChart'), {
                type: 'bar',
                data: {
                    labels: Object.keys(data.da),
                    datasets: [{
                        label: 'Websites by DA Range',
                        data: Object.values(data.da),
                        backgroundColor: 'rgba(255, 159, 64, 0.7)'
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: bufferedMax,
                            grid: {
                                display: false
                            },
                            ticks: {
                                precision: 0,
                                // stepSize: 5,
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'DA Range'
                            }
                        }
                    },
                    plugins: {
                        datalabels: {
                            color: 'rgb(194, 97, 0)',
                            anchor: function (context) {
                                const value = context.dataset.data[context.dataIndex];
                                return value < (bufferedMax * 0.25) ? 'end' : 'center';
                            },
                            align: function (context) {
                                const value = context.dataset.data[context.dataIndex];
                                return value < (bufferedMax * 0.25) ? 'top' : 'center';
                            },
                            font: {
                                weight: 'bold',
                                size: 14,
                            },
                            formatter: Math.round
                        }
                    }
                },
            });
        }

        // 3. Approval Chart
        if (data.approval) {
            const approvalValues = Object.values(data.approval);
            const maxValue = Math.max(...approvalValues);
            const bufferedMax = Math.ceil((maxValue * 1.1) / 5) * 5; // 20% buffer, rounded to nearest 5

            if (approvalChartInstance) approvalChartInstance.destroy();
            approvalChartInstance = new Chart(document.getElementById('approvalChart'), {
                type: 'bar',
                data: {
                    labels: Object.keys(data.approval),
                    datasets: [{
                        label: 'Approved Websites',
                        data: Object.values(data.approval),
                        backgroundColor: 'rgba(153, 102, 255, 0.7)'
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: bufferedMax,
                            ticks: {
                                precision: 0,
                                // stepSize: 5
                            },
                            title: {
                                display: true,
                                text: 'No of Websites'
                            }
                        }
                    },
                    plugins: {
                        datalabels: {
                            color: 'rgb(77, 23, 185)',
                            anchor: function (context) {
                                const value = context.dataset.data[context.dataIndex];
                                return value < (bufferedMax * 0.25) ? 'end' : 'center';
                            },
                            align: function (context) {
                                const value = context.dataset.data[context.dataIndex];
                                return value < (bufferedMax * 0.25) ? 'top' : 'center';
                            },
                            font: {
                                weight: 'bold',
                                size: 12,
                            },
                            formatter: Math.round
                        }
                    }
                }
            });
        }

    }

    // Function to send filters to server and get chart data
    function applyFilters() {
        const filters = getSelectedFilters();
        // console.log(filters);

        fetch('api/chart-data.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(filters)
        })
            .then(res => res.json())
            .then(response => {
                if (response.status !== 'success') {
                    throw new Error(response.message || 'Unknown error from server');
                }
                const data = response.data;
                if (websiteCount) {
                    websiteCount.textContent = data.count;
                }
                updateAllCharts(data);

            })
            .catch(err => {
                console.error('Error fetching chart data:', err);
                alert("Failed to load chart data: " + err.message);
            });
    }

    // Event: Apply button clicked
    applyButton.addEventListener('click', applyFilters);

    // Event: Clear button clicked
    clearButton.addEventListener('click', () => {
        // Clear all checkboxes
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        applyFilters();
    });

    // Optional: Fetch all data initially
    applyFilters();

    // const filters = getSelectedFilters();
    // fetch('api/chart-data.php', {
    //     method: 'POST',
    //     headers: { 'Content-type': 'application/json' },
    //     body: JSON.stringify()
    // })
    // .then(res => res.json())
    // .then(response => {
    //     if (response.status !== 'success') {
    //         throw new Error(response.message || 'Unknown error from server');
    //     }

    //     const data = response.data;

});
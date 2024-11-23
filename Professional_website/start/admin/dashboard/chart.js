
// BAR CHART


//günlük ziyaretçi bar chart
var ctxDaily = document.getElementById('dailyChart').getContext('2d');

fetch('./dashboard/gunlukziyaret.php')
    .then(response => response.json())
    .then(data => {
        new Chart(ctxDaily, {
            type: 'bar',
            data: {
                labels: data.dates,
                datasets: [{
                    label: 'Günlük Ziyaretçi Sayısı',
                    data: data.totals,
                    backgroundColor: '#4e73df',
                    borderColor: '#2e59d9',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: 'white'
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' ziyaretçi';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Hata:', error);
    });


//HAFTALİK ZİYARETÇİ BAR CHART

var ctxWeekly = document.getElementById('weeklyChart').getContext('2d');

fetch('./dashboard/haftalikziyaret.php')
    .then(response => response.json())
    .then(data => {
        new Chart(ctxWeekly, {
            type: 'bar',
            data: {
                labels: data.weeks,
                datasets: [{
                    label: 'Haftalık Ziyaretçi Sayısı',
                    data: data.totals,
                    backgroundColor: '#1cc88a',
                    borderColor: '#17a673',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: 'white'
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' ziyaretçi';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Hata:', error);
    });






//AYLIK ZİYARETÇİ BAR CHART

var ctxMonthly = document.getElementById('monthlyChart').getContext('2d');

fetch('./dashboard/aylikziyaret.php')
    .then(response => response.json())
    .then(data => {
        new Chart(ctxMonthly, {
            type: 'bar',
            data: {
                labels: data.months,
                datasets: [{
                    label: 'Aylık Ziyaretçi Sayısı',
                    data: data.totals,
                    backgroundColor: '#36b9cc',
                    borderColor: '#2c9faf',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: 'white'
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' ziyaretçi';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Hata:', error);
    });




//YILLIK ZİYARETÇİ BAR CHART

var ctxYearly = document.getElementById('yearlyChart').getContext('2d');

fetch('./dashboard/yillikziyaret.php')

    .then(response => response.json())
    .then(data => {
        new Chart(ctxYearly, {
            type: 'bar',
            data: {
                labels: data.years,
                datasets: [{
                    label: 'Yıllık Ziyaretçi Sayısı',
                    data: data.totals,
                    backgroundColor: '#ffb74d',
                    borderColor: '#ffa726',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: 'white'
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' ziyaretçi';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Hata:', error);
    });
var ctxDonut1 = document.getElementById('donutChart1').getContext('2d');


// Donut grafik 1
fetch('./dashboard/totalkullanici.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Ağ hatası: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        const totalUsers = parseInt(data.total, 10); // String'i integer'a dönüştür
        new Chart(ctxDonut1, {
            type: 'doughnut',
            data: {
                labels: ['Toplam Kullanıcılar'],
                datasets: [{
                    label: 'Kategori Dağılımı',
                    data: [totalUsers],
                    backgroundColor: ['#36A2EB'],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: 'white'
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' Kullanıcı';
                            }
                        }
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Hata:', error);
    });



var ctxDonut2 = document.getElementById('donutChart2').getContext('2d');

// Donut grafik 2
fetch('./dashboard/totalmesaj.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Ağ hatası: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        const totalMessage = parseInt(data.total, 10); // String'i integer'a dönüştür
        new Chart(ctxDonut2, {
            type: 'doughnut',
            data: {
                labels: ['Toplam Mesajlar'],
                datasets: [{
                    label: 'Kategori Dağılımı',
                    data: [totalMessage],
                    backgroundColor: ['#a98c48'],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: 'white'
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' Mesaj';
                            }
                        }
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Hata:', error);
    });



var ctxDonut3 = document.getElementById('donutChart3').getContext('2d');

// Donut grafik 3
fetch('./dashboard/totalziyaret.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Ağ hatası: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        const totalGuest = parseInt(data.total, 10); // String'i integer'a dönüştür
        new Chart(ctxDonut3, {
            type: 'doughnut',
            data: {
                labels: ['Toplam Misafir'],
                datasets: [{
                    label: 'Kategori Dağılımı',
                    data: [totalGuest],
                    backgroundColor: ['#a94b63'],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: 'white'
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' Misafir';
                            }
                        }
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Hata:', error);
    }); 
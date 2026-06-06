<script src="{{ asset('js/Chart.min.js') }}"></script>
<script>
    // Statistik Peminjaman Bulanan
    fetch('/api/statistik-peminjaman')
        .then(response => response.json())
        .then(data => {
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
            const borrowedBooksData = new Array(12).fill(0);
            data.forEach(item => borrowedBooksData[item.bulan - 1] = item.jumlah);
            new Chart(document.getElementById('borrowedBooksChart'), {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Jumlah Peminjaman',
                        data: borrowedBooksData,
                        backgroundColor: 'rgba(78, 115, 223, 0.7)',
                        borderColor: 'rgba(78, 115, 223, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

// Top Buku Paling Banyak Dipinjam
fetch('/api/statistik-top-books')
    .then(response => response.json())
    .then(data => {
        // Ambil 5 buku teratas
        const top5 = data.slice(0, 5);

        const labels = top5.map(item => {
            // Potong judul jika terlalu panjang
            return item.judul.length > 30 ? item.judul.substring(0, 27) + '...' : item.judul;
        });
        const jumlah = top5.map(item => item.jumlah);

        new Chart(document.getElementById('topBooksChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Dipinjam',
                    data: jumlah,
                    backgroundColor: 'rgba(54, 185, 204, 0.7)',
                    borderColor: 'rgba(54, 185, 204, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', // horizontal bar
                responsive: true,
                maintainAspectRatio: false, // supaya chart muat di container
                scales: {
                    x: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false // legend opsional
                    },
                    tooltip: {
                        callbacks: {
                            // tampilkan judul penuh di tooltip
                            label: function(context) {
                                return top5[context.dataIndex].judul + ': ' + context.raw;
                            }
                        }
                    }
                }
            }
        });
    });


    // Top Buku Rating Tertinggi
  fetch('/api/statistik-top-rating')
    .then(response => response.json())
    .then(data => {
        // Ambil 5 item teratas saja
        const top5 = data.slice(0, 5);

        const labels = top5.map(item => item.judul);
        const ratings = top5.map(item => parseFloat(item.rata_rata_rating).toFixed(2));

        new Chart(document.getElementById('topRatingChart'), {
            type: 'bar', // chart bar
            data: {
                labels: labels,
                datasets: [{
                    label: 'Rating Rata-rata',
                    data: ratings,
                    backgroundColor: 'rgba(255, 206, 86, 0.7)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', // horizontal
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true,
                        max: 5 // max rating 5
                    }
                },
                plugins: {
                    legend: {
                        display: false // hilangkan legend jika tidak perlu
                    }
                }
            }
        });
    });


    // Statistik Kunjungan Bulanan
    // Statistik Kunjungan Bulanan
    fetch('/api/statistik-kunjungan')
        .then(response => response.json())
        .then(data => {
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
            const visitorsData = new Array(12).fill(0);

            // mapping data ke array sesuai bulan
            data.forEach(item => {
                visitorsData[item.bulan - 1] = item.jumlah;
            });

            new Chart(document.getElementById('visitorsChart'), {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Jumlah Kunjungan',
                        data: visitorsData,
                        backgroundColor: 'rgba(40, 167, 69, 0.4)',
                        borderColor: 'rgba(40, 167, 69, 1)',
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
</script>

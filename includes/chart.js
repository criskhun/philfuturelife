
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar', // Change the type to 'line', 'pie', etc. as needed
    data: {
        labels: ['Cebu', 'Davao', 'Gensan', 'Ilo-ilo', 'Metro Manila', 'Dumaguete'],
        datasets: [{
            label: 'City Performance',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    },
});

const ctx2 = document.getElementById('mySales').getContext('2d');
const mySales = new Chart(ctx2, {
    type: 'line', // Change the type to 'line', 'pie', etc. as needed
    data: {
        labels: ['Cebu', 'Davao', 'Gensan', 'Ilo-ilo', 'Metro Manila', 'Dumaguete'],
        datasets: [{
            label: 'City Performance',
            data: [12000, 19000, 30000, 50000, 20000, 30000],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

document.addEventListener("DOMContentLoaded", function() {
    const ctx3 = document.getElementById('myPolarChart').getContext('2d');
    const myPolarChart = new Chart(ctx3, {
        type: 'polarArea',
        data: {
            labels: ['Red', 'Green', 'Yellow', 'Grey', 'Blue'],
            datasets: [{
                label: 'My Dataset',
                data: [11, 16, 7, 3, 14],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(255, 205, 86, 0.5)',
                    'rgba(201, 203, 207, 0.5)',
                    'rgba(54, 162, 235, 0.5)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                r: {
                    angleLines: {
                        display: true,
                    },
                    suggestedMin: 0, // Minimum value for radial scale
                    suggestedMax: 20 // Maximum value for radial scale
                }
            }
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const ctx4 = document.getElementById('myBubbleChart').getContext('2d');
    const myBubbleChart = new Chart(ctx4, {
        type: 'bubble',
        data: {
            datasets: [{
                label: 'City',
                data: [
                    { x: 10, y: 20, r: 15, city: 'Manila', population: 1780148 },
                    { x: 15, y: 10, r: 20, city: 'Quezon City', population: 2955330 },
                    { x: 20, y: 25, r: 25, city: 'Davao City', population: 1632991 },
                    { x: 25, y: 15, r: 10, city: 'Cebu City', population: 922611 },
                    { x: 18, y: 12, r: 18, city: 'General Santos City', population: 560499 },
                    { x: 13, y: 13, r: 13, city: 'Makati City', population: 564789 },
                    { x: 19, y: 22, r: 23, city: 'Cotabato City', population: 124587 },
                    { x: 14, y: 14, r: 13, city: 'Tacurong City', population: 361547 },
                    { x: 17, y: 11, r: 21, city: 'Cagayan City', population: 854269 },
                    { x: 24, y: 23, r: 17, city: 'Iloilo City', population: 245876 },
                    { x: 11, y: 20, r: 24, city: 'PPS City', population: 356489 },
                    { x: 12, y: 13, r: 14, city: 'Bukidnon City', population: 124789 },
                    { x: 22, y: 24, r: 16, city: 'Siargao City', population: 145789 },
                    { x: 19, y: 16, r: 14, city: 'Taguig City', population: 654789 },
                    // Add more cities as needed
                ],
                backgroundColor: 'rgba(0, 123, 255, 0.5)'
            },
            {
                
                    label: 'Province',
                    data: [
                        // Example data - replace with actual province data
                        { x: 5, y: 10, r: 10, province: 'Palawan', population: 430000 },
                        { x: 7, y: 15, r: 14, province: 'Cebu', population: 920000 },
                        { x: 6, y: 12, r: 12, province: 'Iloilo', population: 500000 },
                        // Add more provinces as needed
                    ],
                    backgroundColor: 'rgba(255, 99, 132, 0.5)' // Red background color
                
            }
        ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var data = context.raw;
                            return `${data.city || data.province}: ${data.population.toLocaleString()}`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Active'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Renew'
                    }
                }
            }
        }
    });
});

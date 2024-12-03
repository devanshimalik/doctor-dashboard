document.addEventListener('DOMContentLoaded', function () {
    // Data for charts (example)
    const doctorData = [10, 20, 30]; // Replace with actual data from PHP or Ajax
    const patientData = [5, 15, 25]; // Replace with actual data from PHP or Ajax

    // Doctor Chart
    const doctorCtx = document.getElementById('doctor-chart').getContext('2d');
    new Chart(doctorCtx, {
        type: 'bar',
        data: {
            labels: ['Category 1', 'Category 2', 'Category 3'],
            datasets: [{
                label: 'Doctors',
                data: doctorData,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
            }]
        }
    });

    // Patient Chart
    const patientCtx = document.getElementById('patient-chart').getContext('2d');
    new Chart(patientCtx, {
        type: 'pie',
        data: {
            labels: ['Category A', 'Category B', 'Category C'],
            datasets: [{
                label: 'Patients',
                data: patientData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)'
                ]
            }]
        }
    });
});


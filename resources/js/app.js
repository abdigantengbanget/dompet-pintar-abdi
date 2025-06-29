import './bootstrap';
// Di resources/js/app.js
import Chart from 'chart.js/auto';

const chartElement = document.getElementById('financialPieChart');
if (chartElement) {
    const chartData = JSON.parse(chartElement.dataset.chartData); // Data dilempar dari view via data-attribute
    new Chart(chartElement, {
        type: 'doughnut', // atau 'pie'
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'Alokasi Dana',
                data: chartData.data,
                backgroundColor: [
                    'rgb(79, 70, 229)', // Indigo (Tabungan)
                    'rgb(245, 158, 11)', // Amber (Pengeluaran)
                    'rgb(34, 197, 94)'  // Green (Sisa)
                ],
            }]
        }
    });
}
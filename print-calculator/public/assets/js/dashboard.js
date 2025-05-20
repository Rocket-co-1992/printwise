// dashboard.js
document.addEventListener('DOMContentLoaded', () => {
    // Fetch dashboard statistics
    fetchDashboardStatistics();

    // Event listener for history filter
    const historyFilter = document.getElementById('history-filter');
    if (historyFilter) {
        historyFilter.addEventListener('change', fetchHistory);
    }
});

function fetchDashboardStatistics() {
    fetch('/api/dashboard/statistics')
        .then(response => response.json())
        .then(data => {
            // Update dashboard with statistics
            document.getElementById('total-quotes').innerText = data.totalQuotes;
            document.getElementById('total-revenue').innerText = data.totalRevenue;
            // Add more statistics as needed
        })
        .catch(error => console.error('Error fetching statistics:', error));
}

function fetchHistory() {
    const filterValue = document.getElementById('history-filter').value;
    fetch(`/api/dashboard/history?filter=${filterValue}`)
        .then(response => response.json())
        .then(data => {
            // Update history table with fetched data
            const historyTable = document.getElementById('history-table');
            historyTable.innerHTML = ''; // Clear existing rows
            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.date}</td>
                    <td>${item.client}</td>
                    <td>${item.amount}</td>
                    <td>${item.status}</td>
                `;
                historyTable.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching history:', error));
}
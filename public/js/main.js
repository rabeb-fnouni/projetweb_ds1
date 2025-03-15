/**
 * ESSECT Clubs - Main Javascript
 * Main functionality for the club management system
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize Bootstrap popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        var alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(function(alert) {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    // Confirmation dialogs for important actions
    document.querySelectorAll('.confirm-action').forEach(function(button) {
        button.addEventListener('click', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir effectuer cette action ?')) {
                e.preventDefault();
            }
        });
    });

    // Handle club search if search form exists
    const searchForm = document.getElementById('clubSearchForm');
    if (searchForm) {
        const searchInput = document.getElementById('clubSearch');
        const clubCards = document.querySelectorAll('.club-card');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            clubCards.forEach(function(card) {
                const clubName = card.querySelector('.card-title').textContent.toLowerCase();
                const clubDesc = card.querySelector('.card-text').textContent.toLowerCase();
                
                if (clubName.includes(searchTerm) || clubDesc.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // Toggle password visibility if password fields exist
    const togglePasswordButtons = document.querySelectorAll('.toggle-password');
    togglePasswordButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const passwordField = document.querySelector(this.getAttribute('data-target'));
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                this.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                passwordField.type = 'password';
                this.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });
    });

    // Initialize charts if chart containers exist
    initializeCharts();
});

/**
 * Initialize charts on admin stats page
 */
function initializeCharts() {
    // Only run if Chart.js is loaded and we have chart containers
    if (typeof Chart === 'undefined' || 
        !document.getElementById('statusChart') || 
        !document.getElementById('clubMembersChart')) {
        return;
    }

    // Status chart
    const statusLabels = [];
    const statusData = [];
    const statusColors = ['#ffc107', '#198754', '#dc3545'];

    // Get data from hidden input fields or use dummy data
    document.querySelectorAll('[data-status-label]').forEach(function(el) {
        statusLabels.push(el.dataset.statusLabel);
        statusData.push(parseInt(el.dataset.statusValue));
    });

    // If no data, use placeholder data
    if (statusLabels.length === 0) {
        statusLabels.push('Pending', 'Approved', 'Rejected');
        statusData.push(8, 15, 3);
    }

    const statusChart = new Chart(document.getElementById('statusChart'), {
        type: 'pie',
        data: {
            labels: statusLabels,
            datasets: [{
                data: statusData,
                backgroundColor: statusColors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Club members chart
    const clubLabels = [];
    const clubData = [];

    // Get data from hidden input fields or use dummy data
    document.querySelectorAll('[data-club-name]').forEach(function(el) {
        clubLabels.push(el.dataset.clubName);
        clubData.push(parseInt(el.dataset.clubMembers));
    });

    // If no data, use placeholder data
    if (clubLabels.length === 0) {
        clubLabels.push('Club A', 'Club B', 'Club C', 'Club D');
        clubData.push(12, 19, 8, 5);
    }

    const clubMembersChart = new Chart(document.getElementById('clubMembersChart'), {
        type: 'bar',
        data: {
            labels: clubLabels,
            datasets: [{
                label: 'Nombre de membres',
                data: clubData,
                backgroundColor: '#0d6efd',
                borderWidth: 0,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
}
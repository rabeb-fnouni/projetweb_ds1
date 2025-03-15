// admin.js

document.addEventListener('DOMContentLoaded', function() {
    // Example: Confirm before deleting a club or member
    const deleteLinks = document.querySelectorAll('a[href*="delete"]');
    deleteLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const confirmation = confirm("Are you sure you want to delete this item?");
            if (!confirmation) {
                e.preventDefault();
            }
        });
    });

    // Example: Handle application approval/rejection
    const approveLinks = document.querySelectorAll('.approve-application');
    approveLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const confirmation = confirm("Are you sure you want to approve this application?");
            if (!confirmation) {
                e.preventDefault();
            }
        });
    });

    const rejectLinks = document.querySelectorAll('.reject-application');
    rejectLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const confirmation = confirm("Are you sure you want to reject this application?");
            if (!confirmation) {
                e.preventDefault();
            }
        });
    });
});
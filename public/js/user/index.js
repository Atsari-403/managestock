// Alert notifications handler
function setupAlertNotifications() {
    if (typeof sessionErrors !== "undefined" && sessionErrors) {
        Swal.fire({
            title: "Gagal!",
            text: sessionErrors,
            icon: "error",
            confirmButtonText: "OK",
            customClass: {
                confirmButton: "btn btn-danger px-4",
                popup: "animated fadeInDown faster rounded-lg",
            },
            buttonsStyling: false,
        });
    }

    if (typeof sessionSuccess !== "undefined" && sessionSuccess) {
        Swal.fire({
            title: "Berhasil!",
            text: sessionSuccess,
            icon: "success",
            confirmButtonText: "OK",
            customClass: {
                confirmButton: "btn btn-success px-4",
                popup: "animated fadeInDown faster rounded-lg",
            },
            buttonsStyling: false,
        });
    }
}

// Initialize tooltips
function initTooltips() {
    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

// Delete confirmation with SweetAlert2
function setupDeleteConfirmation() {
    const deleteButtons = document.querySelectorAll(".delete-confirm");
    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const form = this.closest("form");
            Swal.fire({
                title: "Hapus user ini?",
                text: "Tindakan ini tidak dapat dibatalkan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
                customClass: {
                    confirmButton: "btn btn-danger me-2",
                    cancelButton: "btn btn-secondary",
                    popup: "animated fadeInDown faster rounded-lg",
                },
                buttonsStyling: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
}

// Execute when document is ready
document.addEventListener("DOMContentLoaded", function () {
    setupAlertNotifications();
    initTooltips();
    setupDeleteConfirmation();
});

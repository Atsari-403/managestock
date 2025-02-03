document.addEventListener("DOMContentLoaded", function () {
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebar = document.querySelector(".sidebar");
    const hamburgerIcon = document.querySelector(".hamburger-icon");

    if (sidebarToggle) {
        sidebarToggle.addEventListener("click", function (e) {
            e.stopPropagation();
            sidebar.classList.toggle("show");
            hamburgerIcon.classList.toggle("active");
        });

        // Menutup sidebar ketika mengklik di luar sidebar pada mobile
        document.addEventListener("click", function (event) {
            if (window.innerWidth <= 768) {
                if (
                    !sidebar.contains(event.target) &&
                    !sidebarToggle.contains(event.target) &&
                    sidebar.classList.contains("show")
                ) {
                    sidebar.classList.remove("show");
                    hamburgerIcon.classList.remove("active");
                }
            }
        });

        // Mencegah penutupan dropdown ketika mengklik di dalam dropdown
        sidebar.addEventListener("click", function (e) {
            if (
                e.target.classList.contains("dropdown-toggle") ||
                e.target.closest(".dropdown-toggle")
            ) {
                e.stopPropagation();
            }
        });
    }

    // Toggle dropdown icon rotation
    const dropdowns = document.querySelectorAll(".dropdown-toggle");
    dropdowns.forEach((dropdown) => {
        dropdown.addEventListener("click", function () {
            const icon = this.querySelector(".dropdown-icon");
            const isExpanded = this.getAttribute("aria-expanded") === "true";

            // Rotate icon based on dropdown state
            if (isExpanded) {
                icon.style.transform = "rotate(0deg)";
            } else {
                icon.style.transform = "rotate(180deg)";
            }
        });
    });
});

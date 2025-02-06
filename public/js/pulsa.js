document.addEventListener("DOMContentLoaded", function () {
    const modalPulsa = document.getElementById("modalPulsa");
    const priceInput = document.getElementById("userPrice");
    const totalPriceElement = document.getElementById("totalPrice");
    const ADMIN_FEE = 2000;
    let currentProvider = "";

    // Update modal title and store provider when modal is opened
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach((button) => {
        button.addEventListener("click", function () {
            const provider = this.getAttribute("data-provider");
            currentProvider = provider;
            document.getElementById(
                "modalPulsaLabel"
            ).textContent = `Beli Pulsa ${provider}`;
        });
    });

    // Calculate total price with admin fee
    priceInput?.addEventListener("input", function () {
        const userInput = this.value.replace(/[^\d]/g, "");
        const amount = parseInt(userInput) || 0;
        const total = amount + ADMIN_FEE;

        totalPriceElement.innerHTML = `
            <div class="mt-3">
                <p class="mb-1">Nominal Pulsa: Rp ${amount.toLocaleString()}</p>
                <p class="mb-1">Biaya Admin: Rp ${ADMIN_FEE.toLocaleString()}</p>
                <p class="fw-bold">Total Bayar: Rp ${total.toLocaleString()}</p>
            </div>
        `;
    });

    // Reset form when modal is closed
    modalPulsa?.addEventListener("hidden.bs.modal", function () {
        const form = this.querySelector("form");
        form?.reset();
        totalPriceElement.innerHTML = "Total Bayar: Rp 0";
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const amountInput = document.getElementById("amount");
    const totalAmountElement = document.getElementById("totalAmount");
    const formTopupModal = document.getElementById("formTopupModal");
    let currentEwalletType = "";

    // Fee structure functions
    const getDanaShopeeAdminFee = (amount) => {
        if (amount < 1000) return 0;
        if (amount <= 100000) return 1000;
        if (amount <= 499999) return 1500;
        if (amount <= 999999) return 2000;
        if (amount <= 1999999) return 3000;
        if (amount <= 2999999) return 4000;
        if (amount <= 4999999) return 5000;
        return 7000;
    };

    const getGopayGrabLinkAjaAdminFee = (amount) => {
        if (amount < 10000) return 0;
        if (amount <= 499999) return 1500;
        if (amount <= 999000) return 2000;
        if (amount <= 2999999) return 3000;
        return 5000;
    };

    const getOvoSakukuAdminFee = (amount) => {
        if (amount < 10000) return 0;
        if (amount <= 499999) return 2000;
        if (amount <= 999999) return 2500;
        if (amount <= 1999999) return 3000;
        return 4000;
    };

    const getAdminFee = (amount, type) => {
        switch (type) {
            case "DANA":
            case "ShopeePay":
                return getDanaShopeeAdminFee(amount);
            case "GoPay Customer":
            case "GoPay Driver":
            case "Grab Customer":
            case "Grab Driver":
            case "LinkAja":
                return getGopayGrabLinkAjaAdminFee(amount);
            case "OVO":
            case "Sakuku":
                return getOvoSakukuAdminFee(amount);
            default:
                return 0;
        }
    };

    // Update modal title and store e-wallet type when modal is opened
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach((button) => {
        button.addEventListener("click", function () {
            const cardTitle =
                this.closest(".card-body").querySelector(
                    ".card-title"
                ).textContent;
            currentEwalletType = cardTitle;
            document.getElementById(
                "formTopupModalLabel"
            ).textContent = `Top Up ${cardTitle}`;
        });
    });

    // Calculate total amount with admin fee
    amountInput.addEventListener("input", function () {
        const userInput = this.value.replace(/[^\d.,]/g, "");
        const amount = parseInt(userInput.replace(/[.,]/g, ""), 10) || 0;
        const adminFee = getAdminFee(amount, currentEwalletType);

        // Display breakdown of costs
        totalAmountElement.innerHTML = `
            <div class="mt-3">
                <p class="mb-1">Nominal Top Up: Rp ${amount.toLocaleString()}</p>
                <p class="mb-1">Biaya Admin: Rp ${adminFee.toLocaleString()}</p>
                <p class="fw-bold">Total: Rp ${(
                    amount + adminFee
                ).toLocaleString()}</p>
            </div>
        `;
    });

    // Reset form when modal is closed
    formTopupModal.addEventListener("hidden.bs.modal", function () {
        document.querySelector("form").reset();
        totalAmountElement.innerHTML = "Total: Rp 0";
    });
});

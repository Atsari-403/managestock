// Transaction fee calculator
document.addEventListener("DOMContentLoaded", function () {
    // Elements for Transfer
    const transferAmountInput = document.getElementById("transferAmount");
    const totalTransferElement = document.getElementById("totalTransfer");
    const modalTransferBank = document.getElementById("modalTransferBank");

    // Elements for Withdrawal
    const withdrawalAmountInput = document.getElementById("amountTarik");
    const totalWithdrawalElement = document.getElementById("totalTarik");
    const modalTarikUang = document.getElementById("modalTarikUang");

    // Calculate transfer fee based on amount
    const getTransferFee = (amount) => {
        if (amount <= 50000) return 2000;
        if (amount <= 499999) return 3000;
        if (amount <= 999000) return 4000;
        if (amount <= 2999999) return 5000;
        if (amount <= 3999999) return 7000;
        if (amount <= 5000000) return 10000;
        if (amount <= 7000000) return 12000;
        return 15000;
    };

    // Calculate withdrawal fee based on amount
    const getWithdrawalFee = (amount) => {
        if (amount < 1000) return 0;
        if (amount <= 999999) return 2000;
        if (amount <= 2999999) return 3000;
        return 4000;
    };

    // Handle transfer amount changes
    transferAmountInput?.addEventListener("input", function () {
        const amount = parseInt(this.value.replace(/[^\d]/g, "")) || 0;
        const fee = getTransferFee(amount);
        const total = amount + fee;

        totalTransferElement.innerHTML = `
            <div class="mt-3">
                <p class="mb-1">Jumlah Transfer: Rp ${amount.toLocaleString()}</p>
                <p class="mb-1">Biaya Admin: Rp ${fee.toLocaleString()}</p>
                <p class="fw-bold">Total Bayar: Rp ${total.toLocaleString()}</p>
            </div>
        `;
    });

    // Handle withdrawal amount changes
    withdrawalAmountInput?.addEventListener("input", function () {
        const amount = parseInt(this.value.replace(/[^\d]/g, "")) || 0;
        const fee = getWithdrawalFee(amount);
        const total = amount + fee;

        totalWithdrawalElement.innerHTML = `
            <div class="mt-3">
                <p class="mb-1">Jumlah Tarik: Rp ${amount.toLocaleString()}</p>
                <p class="mb-1">Biaya Admin: Rp ${fee.toLocaleString()}</p>
                <p class="fw-bold">Total Bayar: Rp ${total.toLocaleString()}</p>
            </div>
        `;
    });

    // Reset transfer form when modal is closed
    modalTransferBank?.addEventListener("hidden.bs.modal", function () {
        const form = this.querySelector("form");
        form?.reset();
        totalTransferElement.innerHTML = "Total Bayar: Rp 0";
    });

    // Reset withdrawal form when modal is closed
    modalTarikUang?.addEventListener("hidden.bs.modal", function () {
        const form = this.querySelector("form");
        form?.reset();
        totalWithdrawalElement.innerHTML = "Total Bayar: Rp 0";
    });
});

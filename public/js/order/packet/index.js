document.addEventListener("DOMContentLoaded", function () {
    // Inisialisasi SweetAlert jika ada pesan sukses
    if (document.querySelector(".alert-success")) {
        Swal.fire({
            title: "Berhasil!",
            text: document.querySelector(".alert-success").innerText,
            icon: "success",
            confirmButtonText: "OK",
        });
    }

    // Fungsi untuk menangani tambah stok
    const addStockButtons = document.querySelectorAll(".add-stock");
    const modalStockForm = document.getElementById("tambahStockForm");

    addStockButtons.forEach((button) => {
        button.addEventListener("click", function () {
            // Ambil data dari tombol yang diklik
            const id = this.getAttribute("data-id");
            const name = this.getAttribute("data-name");

            // Isi modal dengan data paket yang dipilih
            document.getElementById("packet_id").value = id;
            document.getElementById("paketNameDisplay").value = name;

            // Ubah action form sesuai dengan ID paket
            modalStockForm.setAttribute(
                "action",
                `/product/category/paket/add-stock/${id}`
            );
        });
    });

    // Fungsi untuk menangani edit paket
    const editButtons = document.querySelectorAll(".edit-paket");
    const modalForm = document.getElementById("paketForm");
    const kategoriPakaiStok = ["Aksesoris", "Kartu", "Voucher"];
    const kategoriPakaiMargin = ["E-Wallet", "Transaksi"];

    editButtons.forEach((button) => {
        button.addEventListener("click", function () {
            // Ambil data dari tombol yang diklik
            const id = this.getAttribute("data-id");
            const name = this.getAttribute("data-name");
            const stock = this.getAttribute("data-stock");
            const price = this.getAttribute("data-price");
            const margin = this.getAttribute("data-margin");
            const productName = this.getAttribute("data-nameProduct");

            // Tampilkan/sembunyikan input stok berdasarkan kategori produk
            const stockInput = document.getElementById("StockInput");
            const paketStock = document.getElementById("paketStock");

            if (!kategoriPakaiStok.includes(productName)) {
                stockInput.style.display = "none";
                paketStock.removeAttribute("required");
            } else {
                stockInput.style.display = "block";
                paketStock.setAttribute("required", "required");
            }

            // Tampilkan/sembunyikan input margin berdasarkan kategori produk
            const marginInput = document.getElementById("InputMargin");
            const paketMargin = document.getElementById("paketMargin");

            if (!kategoriPakaiMargin.includes(productName)) {
                marginInput.style.display = "none";
                paketMargin.removeAttribute("required");
            } else {
                marginInput.style.display = "block";
                paketMargin.setAttribute("required", "required");
            }

            // Isi modal dengan data paket yang dipilih
            document.getElementById("id").value = id;
            document.getElementById("paketName").value = name;
            document.getElementById("paketStock").value = stock;
            document.getElementById("paketPrice").value = price;
            document.getElementById("paketMargin").value = margin;

            // Ubah action form sesuai dengan ID paket
            modalForm.setAttribute(
                "action",
                `/product/category/paket/update/${id}`
            );
        });
    });
});

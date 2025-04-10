document.addEventListener("DOMContentLoaded", function () {
    // Tambah Paket - isi data kategori & produk
    const addPackageButtons = document.querySelectorAll(".add-category-btn");
    const modalCategoryInput = document.getElementById(
        "modalCategoryProductId"
    );
    const modalProductInput = document.getElementById("modalProductId");

    addPackageButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const categoryId = this.getAttribute("data-category-id");
            const productId = this.getAttribute("data-productId");
            modalCategoryInput.value = categoryId;
            modalProductInput.value = productId;
        });
    });

    // Edit Kategori
    const editButtons = document.querySelectorAll(".edit-category-btn");
    const modalForm = document.getElementById("editCategoryForm");

    editButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            const name = this.getAttribute("data-name");
            document.getElementById("editCategoryId").value = id;
            document.getElementById("editCategoryName").value = name;
            modalForm.setAttribute("action", `/product/category/update/${id}`);
        });
    });

    // Hapus Kategori dengan SweetAlert
    const deleteCategoryButtons = document.querySelectorAll(
        ".delete-category-btn"
    );
    deleteCategoryButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            const name = this.getAttribute("data-name");
            const form = this.closest("form");

            Swal.fire({
                title: "Hapus kategori ini?",
                text: `Anda akan menghapus kategori "${name}"`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});

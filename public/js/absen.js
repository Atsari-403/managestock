document.addEventListener("DOMContentLoaded", function () {
    function getLocationAndSubmit(action) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    let latitude = position.coords.latitude;
                    let longitude = position.coords.longitude;

                    Swal.fire({
                        title: "Konfirmasi Absen",
                        text: `Lokasi Anda: ${latitude}, ${longitude}. Lanjutkan?`,
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Lanjutkan",
                        cancelButtonText: "Batal",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/attendance/${action}`, {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": document
                                        .querySelector(
                                            'meta[name="csrf-token"]'
                                        )
                                        .getAttribute("content"),
                                },
                                body: JSON.stringify({
                                    lat: latitude,
                                    long: longitude,
                                }),
                            })
                                .then((response) => response.json())
                                .then((data) => {
                                    Swal.fire(
                                        "Berhasil!",
                                        `Absen ${action} berhasil dicatat.`,
                                        "success"
                                    ).then(() => location.reload()); // Reload halaman setelah absen
                                })
                                .catch((error) => {
                                    Swal.fire(
                                        "Gagal!",
                                        "Terjadi kesalahan saat melakukan absen.",
                                        "error"
                                    );
                                });
                        }
                    });
                },
                function () {
                    Swal.fire(
                        "Gagal!",
                        "Tidak dapat mengakses lokasi Anda. Pastikan GPS aktif!",
                        "error"
                    );
                }
            );
        } else {
            Swal.fire("Error", "Peramban tidak mendukung geolokasi!", "error");
        }
    }

    function izinAbsen() {
        Swal.fire({
            title: "Ajukan Izin",
            input: "text",
            inputLabel: "Masukkan alasan izin atau sakit",
            inputValidator: (value) => {
                if (!value) return "Alasan harus diisi!";
            },
            showCancelButton: true,
            confirmButtonText: "Kirim",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("/izin", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                    body: JSON.stringify({ reason: result.value }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            Swal.fire(
                                "Berhasil!",
                                data.message,
                                "success"
                            ).then(() => location.reload());
                        } else {
                            Swal.fire("Gagal!", data.message, "error");
                        }
                    })
                    .catch(() => {
                        Swal.fire(
                            "Gagal!",
                            "Terjadi kesalahan saat mengajukan izin.",
                            "error"
                        );
                    });
            }
        });
    }

    window.getLocationAndSubmit = getLocationAndSubmit;
    window.izinAbsen = izinAbsen;
});

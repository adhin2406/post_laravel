$("#showPass").on("input", function () {
    let pass = $("#password");
    if ($("#showPass").is(":checked")) {
        pass.prop("type", "text");
    } else {
        pass.prop("type", "password");
    }
});

$("#logout_button").on("click", function (e) {
    e.preventDefault();
    const linkAja = $(this).attr("href");
    Swal.fire({
        title: "kamu yakin",
        text: "kamu mau logout",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Logout",
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = linkAja;
        }
    });
});

$(function () {
    $("#tanggal").datepicker();
});

$(function () {
    $("#harga_barang").on("keyup", function () {
        $("#harga_barang").val(formatRupiah(this.value, "Rp. "));
    });

    $("#edit_harga_barang").on("keyup", function () {
        $("#edit_harga_barang").val(formatRupiah(this.value, "Rp. "));
    });

    $("#input_ongkir").on("keyup", function () {
        $("#input_ongkir").val(formatRupiah(this.value, ""));
    });
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }

    $("#input_ongkir").on("keyup", function () {
        $("#input_ongkir").val(format_rupiah(this.value, ""));
    });

    function format_rupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
    }
});

function delete_databarang() {
    event.preventDefault();
    const form = event.target.form;
    Swal.fire({
        title: "",
        text: "kamu mau hapus barang  ini??",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, hapus",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}

$("#chekout").on("click", function () {
    event.preventDefault();
    const form = event.target.form;
    Swal.fire({
        title: "yakin mau lanjut??",
        text: "data yang diinput tidak bisa di ubah lagi",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, lanjut",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});

$(document).on("click", "#hapus", function () {
    event.preventDefault();
    const form = event.target.form;
    Swal.fire({
        title: "yakin mau lanjut??",
        text: "data akan dihapus",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, hapus",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});

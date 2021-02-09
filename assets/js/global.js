$(document).ready(function () {
  const flashdata = $(".flashdata").data("flashdata");
  if (flashdata == "simpan") {
    $.toast({
      heading: "Berhasil",
      text: "Data berhasil disimpan.",
      position: "top-right",
      loaderBg: "#5ba035",
      icon: "success",
      hideAfter: 3000,
      stack: 1,
    });
  } else if (flashdata == "gagal") {
    $.toast({
      heading: "Gagal",
      text: "Maaf. anda gagal melakukan aksi ini!",
      position: "top-right",
      loaderBg: "#bf441d",
      icon: "error",
      hideAfter: 3000,
      stack: 1,
    });
  } else if (flashdata == "gambarNull") {
    $.toast({
      heading: "Gagal",
      text: "Silahkan masukkan thumbnail dan video",
      position: "top-right",
      loaderBg: "#bf441d",
      icon: "error",
      hideAfter: 3000,
      stack: 1,
    });
  } else if (flashdata == "delete") {
    $.toast({
      heading: "Berhasil",
      text: "Data anda berhasil di hapus.",
      position: "top-right",
      loaderBg: "#5ba035",
      icon: "success",
      hideAfter: 3000,
      stack: 1,
    });
  } else if (flashdata == "update") {
    $.toast({
      heading: "Berhasil",
      text: "Data anda berhasil di update.",
      position: "top-right",
      loaderBg: "#5ba035",
      icon: "success",
      hideAfter: 3000,
      stack: 1,
    });
  } else if (flashdata == "musikNull") {
    $.toast({
      heading: "Gagal",
      text: "Silahkan masukkan audio.",
      position: "top-right",
      loaderBg: "#bf441d",
      icon: "error",
      hideAfter: 3000,
      stack: 1,
    });
  } else if (flashdata == "send") {
    $.toast({
      heading: "Berhasil",
      text: "Berhasil di kirim.",
      position: "top-right",
      loaderBg: "#5ba035",
      icon: "success",
      hideAfter: 3000,
      stack: 1,
    });
  } else if (flashdata == "format") {
    $.toast({
      heading: "Gagal",
      text: "Format harus JPG|PNG|JPEG.",
      position: "top-right",
      loaderBg: "#bf441d",
      icon: "error",
      hideAfter: 3000,
      stack: 1,
    });
  } else if (flashdata == "kosong") {
    $.toast({
      heading: "Gagal",
      text: "Gambar tidak boleh kosong.",
      position: "top-right",
      loaderBg: "#bf441d",
      icon: "error",
      hideAfter: 3000,
      stack: 1,
    });
  } else if (flashdata == "import_excel") {
    $.toast({
      heading: "Berhasil",
      text: "Berhasil import data.",
      position: "top-right",
      loaderBg: "#5ba035",
      icon: "success",
      hideAfter: 3000,
      stack: 1,
    });
  }
});

const flashData = $('.flash-data').data('flashdata');
const flashError = $('.flash-error').data('flasherror');
const pesan = $('.flash-data').data('pesan');

if (flashData) {
  Swal.fire({
    title: 'Data ' + pesan,
    text: 'Berhasil ' + flashData,
    type: 'success',
    icon: 'success',
  });
} else if (flashError) {
  Swal.fire({
    title: 'Data ' + pesan,
    text: flashError,
    type: 'error',
    icon: 'error',
  });
}

// tombol hapus
$('.tombol-hapus').on('click', function (e) {

  e.preventDefault();
  const href = $(this).attr('href');

  Swal.fire({
    title: 'Apakah Anda Yakin?',
    text: 'Data ' + pesan + ' akan dihapus!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Hapus Data'
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    }
  });

});

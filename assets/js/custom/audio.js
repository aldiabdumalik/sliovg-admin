const baseurl = $('.baseurl').data('baseurl');
$('.musik').dropify({
    messages: {
        default: 'Drag atau drop untuk memilih thumb',
        replace: 'Ganti',
        remove:  'Hapus',
        error:   'error'
    }
});

$('#datatable-audio').on('click','.btn-hapus', function(){
    var id = $(this).data('id');
    $('.id').val(id);
    $('#title-audio').html('Apakah anda yakin ingin menghapus data ini <span class="text-danger namabank">'+id+'</span> ???');
    $('#delete').modal({
      show:true,
      backdrop: 'static',
      keyboard: false  // to prevent closing with Esc button (if you want this too)
    });
  });
//datatables
$('#datatable-audio').DataTable({ 

    "processing": true, 
    "serverSide": true, 
    "order": [], 
     
    "ajax": {
        "url": `${baseurl}audio/getAudio`,
        "type": "POST"
    },

     
    "columnDefs": [
    { 
        "targets": [ 0 ], 
        "orderable": false, 
    },
    ],

});
const baseurl = $('.baseurl').data('baseurl');

$(document).ready(function() {

    $('.thumb').dropify({
        messages: {
            default: 'Drag atau drop untuk memilih thumb',
            replace: 'Ganti',
            remove:  'Hapus',
            error:   'error'
        }
    });
    
    $('.closing').dropify({
        messages: {
            default: 'Drag atau drop untuk memilih closing',
            replace: 'Ganti',
            remove:  'Hapus',
            error:   'error'
        }
    });

    $('#video').dropify({
        messages: {
            default: 'Drag atau drop untuk memilih video',
            replace: 'Ganti',
            remove:  'Hapus',
            error:   'error'
        }
    });

    $('#datatable-video').on('click','.btn-hapus', function(){
        var id = $(this).data('id');
        var idkategori = $(this).data('idkategori');
        $('.id').val(id);
        $('.kategori').val(idkategori);
        $('#title-vid').html('Apakah anda yakin ingin menghapus data ini <span class="text-danger namabank">'+id+'</span> ???');
        $('#delete').modal({
          show:true,
          backdrop: 'static',
          keyboard: false  // to prevent closing with Esc button (if you want this too)
        });
      });

});
//datatables
$('#datatable-video').DataTable({ 

    "processing": true, 
    "serverSide": true, 
    "order": [], 
     
    "ajax": {
        "url": `${baseurl}video/getVideo`,
        "type": "POST"
    },

     
    "columnDefs": [
    { 
        "targets": [ 0 ], 
        "orderable": false, 
    },
    ],

});


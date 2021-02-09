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

    $('#video').dropify({
        messages: {
            default: 'Drag atau drop untuk memilih video',
            replace: 'Ganti',
            remove:  'Hapus',
            error:   'error'
        }
    });

    $('#datatable-footage').on('click','.btn-hapus', function(){
        var id = $(this).data('id');
        $('.id').val(id);
        $('#title-foot').html('Apakah anda yakin ingin menghapus data ini <span class="text-danger">'+id+'</span> ???');
        $('#delete').modal({
          show:true,
          backdrop: 'static',
          keyboard: false  // to prevent closing with Esc button (if you want this too)
        });
      });

});

//datatables
$('#datatable-footage').DataTable({ 

    "processing": true, 
    "serverSide": true, 
    "order": [], 
     
    "ajax": {
        "url": `${baseurl}footage/getFootage`,
        "type": "POST"
    },

     
    "columnDefs": [
    { 
        "targets": [ 0 ], 
        "orderable": false, 
    },
    ],

});
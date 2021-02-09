const baseurl = $('.baseurl').data('baseurl');

$('.image').dropify({
    messages: {
        default: 'Drag atau drop untuk memilih thumb',
        replace: 'Ganti',
        remove:  'Hapus',
        error:   'error'
    }
});

$('.dropify').dropify({
    messages: {
        default: 'Drag atau drop untuk import excel',
        replace: 'Ganti',
        remove:  'Hapus',
        error:   'error'
    }
});

//datatables
$('#datatable-user').DataTable({ 

    "processing": true, 
    "serverSide": true, 
    "order": [], 
     
    "ajax": {
        "url": `${baseurl}users/getUser`,
        "type": "POST"
    },

     
    "columnDefs": [
    { 
        "targets": [ 0 ], 
        "orderable": false, 
    },
    ],

});
const baseurl = $('.baseurl').data('baseurl');

//datatables
$('#datatable-render').DataTable({ 

    "processing": true, 
    "serverSide": true, 
    "order": [], 
     
    "ajax": {
        "url": `${baseurl}render/getRender`,
        "type": "POST"
    },

     
    "columnDefs": [
    { 
        "targets": [ 0 ], 
        "orderable": false, 
    },
    ],

});


$('#datatable-render').on('click','.btn-send', function(){
    var id = $(this).data('id');
    $('.id').val(id);
    $('#title-render').html('Yakin ingin mengirim ?');
    $('#send').modal({
      show:true,
      backdrop: 'static',
      keyboard: false  // to prevent closing with Esc button (if you want this too)
    });
});
const baseurl = $('.baseurl').data('baseurl');

$('#datepicker-autoclose').datepicker({
    format: "yyyy-mm-dd",
    autoclose: true
});

$('#update-tanggal').datepicker({
    format: "yyyy-mm-dd",
    autoclose: true
});

//datatables
$('#datatable-calendar').DataTable({ 

    "processing": true, 
    "serverSide": true, 
    "order": [], 
     
    "ajax": {
        "url": `${baseurl}calendar/getCalendar`,
        "type": "POST"
    },

     
    "columnDefs": [
    { 
        "targets": [ 0 ], 
        "orderable": false, 
    },
    ],

});

 $('#datatable-calendar').on('click','.btn-hapus', function(){
        var id = $(this).data('id');
        $('.id').val(id);
        $('#title-cal').html('Apakah anda yakin ingin menghapus data ini <span class="text-danger">'+id+'</span> ???');
        $('#delete').modal({
          show:true,
          backdrop: 'static',
          keyboard: false  // to prevent closing with Esc button (if you want this too)
        });
      });

/** Editing */
$('#datatable-calendar').on('click','.btn-edit', function(){
    var idcalendar = $(this).data('idcalendar');
    $('.form')[0].reset(); // reset form
    $('#update').modal({
      show:true,
      backdrop: 'static',
      keyboard: false  // to prevent closing with Esc button (if you want this too)
    });

    $.ajax({
      url : `${baseurl}calendar/updateCalendar/${idcalendar}`,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
       if(data.status == 'true'){
        $('#idUpdate').val(idcalendar);
        $('#titleUpdate').val(data.dataCalendar['title']);
        $('#deskripsiUpdate').val(data.dataCalendar['deskripsi']);
        $('.tanggalUpdate').val(data.dataCalendar['tanggal']);
       }else{
        alert('Error pengambilan ajax detail persentasi ');
       }
      },
      error: function (jqXHR, textStatus, errorThrown)
      {

        alert('Error pengambilan ajax detail persentasi ');
      }
    });    
});
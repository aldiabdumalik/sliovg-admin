<div class="row">
    <div class="col-12">
          <button class="btn mb-2" data-toggle="modal" data-target="#modal"><i class="fa fa-plus"></i> Add Calendar</button>
        <div class="card-box">
        	<h4 class="m-t-0 header-title">Data Calendar</h4>
        	<table id="datatable-calendar" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              	<thead>
	              	<tr>
	                  	<th>#</th>
	                  	<th>Title</th>
                      <th>Deskripsi</th>
                      <th>Tanggal</th>
                      <th>Action</th>
	              	</tr>
              	</thead>
              	<tbody></tbody>
          	</table>
        </div>
    </div>
</div>

<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Add Calendar</h4>
            </div>
            <form method="POST" action="<?= base_url('calendar/simpan') ?>" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control title">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                  <label>Tanggal</label>
                  <div>
                      <div class="input-group">
                          <input type="text" class="form-control" name="tanggal" placeholder="mm/dd/yyyy" id="datepicker-autoclose">
                          <div class="input-group-append">
                              <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="update" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Update Calendar</h4>
            </div>
            <form method="POST" action="<?= base_url('calendar/update') ?>" class="form" enctype="multipart/form-data">
            <input type="hidden" name="idUpdate" id="idUpdate">
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="titleUpdate" class="form-control title" id="titleUpdate">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="deskripsiUpdate" class="form-control" id="deskripsiUpdate" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                  <label>Tanggal</label>
                  <div>
                      <div class="input-group">
                          <input type="text" class="form-control tanggalUpdate" name="tanggalUpdate" placeholder="mm/dd/yyyy" id="update-tanggal">
                          <div class="input-group-append">
                              <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="delete" class="modal fade custom-modal-tabs">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header has-border">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h5 class="modal-title">Hapus Data</h5>
      </div>
      <form action="<?= base_url('calendar/delete') ?>" method="POST">
        <div class="modal-body">
            <input type="hidden" name="id" class="id">
          <h5 id="title-cal"></h5>
        </div>
        <div class="modal-footer modal-footer--center">
          <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cancel</button>
          <button class="btn btn-danger" type="submit">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
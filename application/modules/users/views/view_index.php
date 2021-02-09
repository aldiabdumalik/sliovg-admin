<div class="row">
  	<div class="col-12">
      <div class="float-right">
        <a href="#" class="btn btn-warning mb-3" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Add user</a>
      </div>
      <div class="float-left">
        <a href="#" class="btn btn-custom mb-3" data-toggle="modal" data-target="#import"><i class="fa fa-plus"></i> Import Excel</a>
      </div>
      	<div class="card-box table-responsive">
      	    <?php if ( $this->session->flashdata('msg') == "serial_number_null"): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              Data yang anda masukkan kosong.
            </div>
          <?php elseif($this->session->flashdata('msg') == "duplikasi"): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              Data yang anda import ada yang sama.
            </div>
          <?php endif ?>
          	<h4 class="m-t-0 header-title">Agen List</h4>
          	<table id="datatable-user" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              	<thead>
	              	<tr>
                  	<th>#</th>
                  	<th>Name</th>
                  	<th>Username</th>
                  	<th>Serial Number</th>
                 	  <th>Status</th>
                 	  <th>Action</th>
	              	</tr>
              	</thead>
              	<tbody>
              	</tbody>
          	</table>
      	</div>
  	</div>
</div>

<div id="add" class="modal fade custom-modal-tabs">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header has-border">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h5 class="modal-title">Add User</h5>
      </div>
      <form method="post" action="<?= base_url("users/add") ?>" id="upload_form" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" autocomplete="off" id="username">
          </div>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" autocomplete="off" id="name">
          </div>
          <div class="form-group">
            <label for="kode">Kode agent</label>
            <input type="text" name="kode" class="form-control" autocomplete="off" id="kode">
          </div>
          <div class="form-group">
            <label for="kode">Status</label>
            <select name="status" id="status" class="form-control">
              <option value="" disabled selected>- Select -</option>
              <option value="1">Active</option>
              <option value="0">Non Active</option>
            </select>
          </div>
        </div>
        <div class="modal-footer modal-footer--center">
          <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-custom">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="import" class="modal fade custom-modal-tabs">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header has-border">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h5 class="modal-title">Import</h5>
      </div>
      <form method="post" action="<?= base_url("users/import") ?>" id="upload_form" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
          <input type="file" name="excel" class="dropify" accept=".xls, .xlsx" required />
          </div>
        </div>
        <div class="modal-footer modal-footer--center">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-custom">Import</button>
        </div>
      </form>
    </div>
  </div>
</div>
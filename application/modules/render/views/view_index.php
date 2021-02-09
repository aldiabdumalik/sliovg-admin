<div class="row">
    <div class="col-12">
        <div class="card-box">
        	<h4 class="m-t-0 header-title">Data Render</h4>
        	<table id="datatable-render" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              	<thead>
	              	<tr>
	                  	<th>#</th>
	                  	<th>Nama User</th>
                      <th>Template</th>
                      <th>Nama Video</th>
                      <th>Tanggal Rendering</th>
                      <th>Status</th>
	              	</tr>
              	</thead>
              	<tbody></tbody>
          	</table>
        </div>
    </div>
</div>

<div id="send" class="modal fade custom-modal-tabs">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header has-border">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h5 class="modal-title">Kirim Video</h5>
      </div>
      <form action="<?= base_url('render/send') ?>" method="POST">
        <div class="modal-body">
            <input type="hidden" name="id" class="id">
          <h5 id="title-render"></h5>
        </div>
        <div class="modal-footer modal-footer--center">
          <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cancel</button>
          <button class="btn btn-success" type="submit">Kirim</button>
        </div>
      </form>
    </div>
  </div>
</div>
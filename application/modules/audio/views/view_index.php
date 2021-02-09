<div class="row">
    <div class="col-lg-8 col-sm-12">
        <div class="card-box">
        	<h4 class="m-t-0 header-title">All Audio</h4>

        	<table id="datatable-audio" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              	<thead>
	              	<tr>
	                  	<th>#</th>
	                  	<th>Nama</th>
	                  	<th>Kategori</th>
	                 	<th>Action</th>
	              	</tr>
              	</thead>
              	<tbody></tbody>
          	</table>
        </div>
    </div>
    <div class="col-lg-4 col-sm-12">
    	<div class="card-box">
    		<h4 class="m-t-0 header-title">Upload Audio</h4>
    		<button class="btn" data-toggle="modal" data-target="#modal"><i class="fa fa-upload"></i> Upload Audio</button>

    		<h4 class="mt-3 header-title">Categories</h4>
	       <div class="card-box ribbon-box" style="box-shadow: 0px 1px 3px -1px rgba(0,0,0,0.5)">
            <div class="template-video-text ribbon-purple text-center">Categories</div>
            <ul style="list-style: none;">
            	<li class="list-categories">
            		<div class="list">
            			<span class="list-categories-p">All Audio</span>
            			<span class="list-categories-p"><?= $all ?></span>
            		</div>
            	</li>
            	<?php foreach ($total as $v): ?>
                    <li class="list-categories">
                        <div class="list">
                            <span class="list-categories-p"><?= $v['kategori_musik'] ?></span>
                            <span class="list-categories-p"><?= $v['jumlah'] ?></span>
                        </div>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    	</div>
    </div>
</div>

<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Upload Audio</h4>
            </div>
            <form method="POST" action="<?= base_url('audio/simpan') ?>" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" class="form-control" id="kategori">
                        <option value="" selected disabled>- Pilih -</option>
                        <?php foreach ($kategori as $v): ?>
                            <option value="<?= $v['kategori_musik'] ?>"><?= $v['kategori_musik'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Musik</label>
                    <input type="file" name="musik" class="musik" data-height="150">
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

<div id="delete" class="modal fade custom-modal-tabs">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header has-border">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h5 class="modal-title">Hapus Data</h5>
      </div>
      <form action="<?= base_url('audio/delete') ?>" method="POST">
        <div class="modal-body">
            <input type="hidden" name="id" class="id">
          <h5 id="title-audio"></h5>
        </div>
        <div class="modal-footer modal-footer--center">
          <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cancel</button>
          <button class="btn btn-danger" type="submit">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
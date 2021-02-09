<div class="row">
    <div class="col-lg-8 col-sm-12">
        <div class="card-box">
        	<h4 class="m-t-0 header-title">All Template</h4>

        	<table id="datatable-video" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              	<thead>
	              	<tr>
	                  	<th>#</th>
                        <th>Thumbnail</th>
	                  	<th>Templates</th>
                        <th>Category Name</th>
	                 	<th>Action</th>
	              	</tr>
              	</thead>
              	<tbody> 
                </tbody>
          	</table>
        </div>
    </div>
    <div class="col-lg-4 col-sm-12">
    	<div class="card-box">
    		<h4 class="m-t-0 header-title">Request Template Video</h4>
            <button class="btn" data-toggle="modal" data-target="#modalvideo"><i class="fa fa-upload"></i> Upload Video</button>
    		<h4 class="mt-3 header-title">Categories</h4>
	        <div class="card-box ribbon-box" style="box-shadow: 0px 1px 3px -1px rgba(0,0,0,0.5)">
            <div class="template-video-text ribbon-purple text-center">Template Video</div>
            <ul style="list-style: none;">
            	<li class="list-categories">
            		<div class="list">
            			<span class="list-categories-p">All Template</span>
            			<span class="list-categories-p"><?= $all ?></span>
            		</div>
            	</li>
                <?php foreach ($total as $v): ?>
                	<li class="list-categories">
                		<div class="list">
                			<span class="list-categories-p"><?= $v['nama_kategori'] ?></span>
                			<span class="list-categories-p"><?= $v['jumlah'] ?></span>
                		</div>
                	</li>
                <?php endforeach ?>
            </ul>
        </div>
    	</div>
    </div>
</div>

<div id="modalvideo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Upload Template Video</h4>
            </div>
            <form method="POST" action="<?= base_url('video/simpan') ?>" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" class="form-control" id="kategori" required>
                        <option value="" selected disabled>- Pilih -</option>
                        <?php foreach ($kategori as $v): ?>
                            <option value="<?= $v['id_kategori'] ?>"><?= $v['nama_kategori'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Thumbnail</label>
                    <input type="file" name="thumb" class="thumb" data-height="150" required>
                </div>
                <div class="form-group">
                    <label for="">Closing</label>
                    <input type="file" name="closing" class="closing" data-height="150" required>
                </div>
                <div class="form-group">
                    <label for="">Video</label>
                    <input type="file" name="video" class="video" id="video" data-height="150" required>
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10" required></textarea>
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
      <form action="<?= base_url('video/delete') ?>" method="POST">
        <div class="modal-body">
            <input type="hidden" name="id" class="id">
            <input type="hidden" name="kategori" class="kategori">
          <h5 id="title-vid"></h5>
        </div>
        <div class="modal-footer modal-footer--center">
          <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cancel</button>
          <button class="btn btn-danger" type="submit">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
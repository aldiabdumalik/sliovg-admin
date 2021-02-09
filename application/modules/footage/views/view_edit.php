<div class="row">
    <div class="col-8">
        <div class="card-box">
			<form method="POST" action="<?= base_url('footage/update') ?>" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?= $footage->id_footage ?>">
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" class="form-control" id="kategori">
                        <option value="" selected disabled>- Pilih -</option>
                        <?php foreach ($kategori as $v): ?>
                        	<?php if ($v['id_kategori'] == $footage->id_kategori): ?>
                            <option selected value="<?= $v['id_kategori'] ?>"><?= $v['nama_kategori'] ?></option>
                            <?php else: ?>
                            <option value="<?= $v['id_kategori'] ?>"><?= $v['nama_kategori'] ?></option>
                        	<?php endif ?>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Thumbnail</label>
                    <input type="file" name="thumb" class="thumb" data-height="150" data-default-file="<?= base_url('assets/images/footage/thumb/'.$footage->thumb) ?>">
                </div>
                <div class="form-group">
                    <label for="">Video</label>
                    <input type="file" name="video" class="video" id="video" data-height="150" data-default-file="<?= base_url('assets/images/footage/'.$footage->footage) ?>">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"><?= $footage->deskripsi_footage ?></textarea>
                </div>
                <button class="btn btn-custom" type="submit">Update</button>
                <a href="<?= base_url("footage") ?>" class="btn btn-light">Kembali</a>
            </form>
        </div>
    </div>
</div>
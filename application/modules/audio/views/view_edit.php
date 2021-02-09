<div class="row">
    <div class="col-8">
        <div class="card-box">
			<form method="POST" action="<?= base_url('audio/update') ?>" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?= $audio->id_musik ?>">
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" class="form-control" id="kategori">
                        <option value="" selected disabled>- Pilih -</option>
                        <?php foreach ($kategori as $v): ?>
                        	<?php if ($v['kategori_musik'] == $audio->kategori_musik): ?>
                            <option selected value="<?= $v['kategori_musik'] ?>"><?= $v['kategori_musik'] ?></option>
                            <?php else: ?>
                            <option value="<?= $v['kategori_musik'] ?>"><?= $v['kategori_musik'] ?></option>
                        	<?php endif ?>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Thumbnail</label>
                    <input type="file" name="musik" class="musik" data-height="150" data-default-file="<?= base_url('file/musik'.$audio->kategori_musik.'/'.$audio->nama_musik) ?>">
                </div>
                <button class="btn btn-custom" type="submit">Update</button>
                <a href="<?= base_url("audio") ?>" class="btn btn-light">Kembali</a>
            </form>
        </div>
    </div>
</div>
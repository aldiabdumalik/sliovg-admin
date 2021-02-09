<div class="row">
    <div class="col-8">
        <div class="card-box">
			<form method="POST" action="<?= base_url('video/update') ?>" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?= $video->id_video ?>">
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" class="form-control" id="kategori" required>
                        <option value="" selected disabled>- Pilih -</option>
                        <?php foreach ($kategori as $v): ?>
                        	<?php if ($v['id_kategori'] == $video->id_kategori): ?>
                            <option selected value="<?= $v['id_kategori'] ?>"><?= $v['nama_kategori'] ?></option>
                            <?php else: ?>
                            <option value="<?= $v['id_kategori'] ?>"><?= $v['nama_kategori'] ?></option>
                        	<?php endif ?>
                        <?php endforeach ?>
                    </select>
                </div>
                <?php foreach ($kategori as $k): ?>
                    <?php if ($k['id_kategori'] == 4): ?>
                        <?php $folder = "Product Template"; ?>
                    <?php elseif($k['id_kategori'] == 5): ?>
                        <?php $folder = "Video Greeting Template"; ?>
                    <?php elseif($k['id_kategori'] == 6): ?>
                        <?php $folder = "Video Quotes Template"; ?>
                    <?php elseif($k['id_kategori'] == 7): ?>
                        <?php $folder = "Special Event Template"; ?>
                    <?php endif ?>
                <?php endforeach ?>
                <div class="form-group">
                    <label for="">Thumbnail</label>
                    <input type="file" name="thumb" class="thumb" data-height="150" data-default-file="<?= base_url('file/video/'.$folder.'/Thumb/'.$video->thumb) ?>" required>
                </div>
                <div class="form-group">
                    <label for="">Video</label>
                    <input type="file" name="video" class="video" id="video" data-height="150" data-default-file="<?= base_url('assets/images/video/'.$video->video) ?>" required>
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10" required><?= $video->deskripsi_video ?></textarea>
                </div>
                <button class="btn btn-custom" type="submit">Update</button>
                <a href="<?= base_url("video") ?>" class="btn btn-light">Kembali</a>
            </form>
        </div>
    </div>
</div>
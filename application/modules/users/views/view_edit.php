<div class="row">
  	<div class="col-12">
  		<div class="card-box table-responsive">
  			<form action="<?= base_url('users/edit') ?>" method="post" enctype="multipart/form-data">
  				<input type="hidden" name="id" value="<?= $user->id_user ?>">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="username" class="form-control" autocomplete="off" value="<?= $user->username ?>" id="username">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="text" name="password" class="form-control" autocomplete="off" value="<?= $user->password ?>" id="password">
				</div>
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" class="form-control" autocomplete="off" value="<?= $user->name ?>" id="name">
				</div>
				<div class="form-group">
					<label for="kode">Kode agent</label>
					<input type="text" name="kode" class="form-control" autocomplete="off" value="<?= $user->serial_number ?>" id="kode">
				</div>
				<div class="form-group">
					<label for="image">Image</label>
					<input type="file" name="image" class="image" id="image" data-height="150" data-default-file="<?= base_url('assets/images/users/'.$user->foto_profil) ?>">
				</div>
				<div class="form-group">
					<label for="kode">Status</label>
					<select name="status" id="status" class="form-control">
						<option value="" disabled selected>- Select -</option>
						<?php if ($user->status == 1): ?>
							<option value="1" selected>Active</option>
							<option value="0">Non Active</option>
						<?php else: ?>
							<option value="1">Active</option>
							<option value="0" selected>Non Active</option>
						<?php endif ?>
					</select>
				</div>
				<button type="submit" class="btn btn-default"><i class="fa fa-edit"></i> Update</button>
				<a href="<?= base_url('users') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
			</form>
  		</div>
  	</div>
</div>
<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>
<?php
if(session()->getFlashData('success')){
?> 
<div class="alert alert-info alert-dismissible fade show" role="alert">
	<?= session()->getFlashData('success') ?>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>
<?php
if(session()->getFlashData('failed')){
?> 
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<?= session()->getFlashData('failed') ?>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
Tambah Data
</button>
<!-- Table with stripped rows -->
<table class="table datatable">
<thead>
	<tr>
	<th scope="col">#</th>
	<th scope="col">Nama</th>
	<th scope="col">password</th>
    <th scope="col">role</th>
	<th scope="col">email</th>
	<th scope='col'>Status</th> 
	<th scope="col">Aksi</th> 
	</tr>
</thead>
<tbody>
	<?php foreach($users as $index=>$user): ?>
	<tr>
	<th scope="row"><?php echo $index+1?></th>
	<td><?php echo $user['username'] ?></td> 
	<td><?php echo $user['password'] ?></td> 
    <td><?php echo $user['role'] ?></td> 
	<td><?php echo $user['email'] ?></td> 
	<td>
	<form method="post" action="<?=base_url('admin/edit/'.$user['id'])?>">
	<?php
	if($user['status']== true){
		echo form_hidden('id',$user['id']);
		echo form_hidden('status',0);
		echo form_hidden('rolekey',false);
		?>
		<button type="submit" class="btn btn-primary">Active</button>
		<?php
		}else{
		echo form_hidden('id',$user['id']);
		echo form_hidden('status',1);
		echo form_hidden('rolekey',false);
		?>
		<button type="submit" class="btn btn-danger">Inactive</button>
		<?php
	}
	?>
	</form>
	</td>
	<td>
		<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-<?= $user['id'] ?>">
			Ubah
		</button>
		<a href="<?= base_url('admin/delete/'.$user['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini ?')">
			Hapus
		</a>
	</td>
	</tr>
	<!-- Edit Modal Begin -->
	<div class="modal fade" id="editModal-<?= $user['id'] ?>" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Data</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?= base_url('admin/edit/'.$user['id']) ?>" method="post" enctype="multipart/form-data">
			<?= csrf_field(); ?>
			<div class="modal-body">
				<div class="form-group">
					<label for="name">Nama</label>
					<input type="text" name="username" class="form-control" id="username" value="<?= $user['username'] ?>" placeholder="username" required>
				</div>
				<div class="form-group">
					<label for="name">password</label>
					<input type="text" name="password" class="form-control" id="password" value="<?= $user['password'] ?>" placeholder="password" required>
				</div>
                <div class="form-group">
					<label for="name">Role</label>
					<input type="text" name="role" class="form-control" id="role" value="<?= $user['role'] ?>" placeholder="role" required>
				</div>
				<div class="form-group">
					<label for="name">email</label>
					<input type="text" name="email" class="form-control" id="email" value="<?= $user['email'] ?>" placeholder="email" required>
				</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
			</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal End -->
	<?php endforeach ?>   
</tbody>
</table>
<!-- End Table with stripped rows -->
<!-- Add Modal Begin -->
<div class="modal fade" id="addModal" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Tambah Data</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<form action="<?= base_url('admin') ?>" method="post">
		<?= csrf_field(); ?>
		<div class="modal-body">
			<div class="form-group">
				<label for="name">username</label>
				<input type="text" name="username" class="form-control" id="username" placeholder="Nama" required>
			</div>
			<div class="form-group">
				<label for="name">password</label>
				<input type="password" name="password" class="form-control" id="password" placeholder="masukan password" required>
			</div>
			<div class="form-group">
				<label for="name">role</label>
				<input type="text" name="role" class="form-control" id="role" placeholder="masukan role" required>
			</div>
			<div class="form-group">
				<label for="name">email</label>
				<input type="email" name="email" class="form-control" id="email" placeholder="masukan email" required>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
		</form>
		</div>
	</div>
</div>
<!-- Add Modal End -->
<?= $this->endSection() ?>
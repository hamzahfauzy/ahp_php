<?php set_page("Alternatif"); $this->load("partial.header") ?>
<div class="container">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-sm-12">
				<h2>Alternatif</h2>
				<a href="<?= base_url() ?>/admin/alternatif/create" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah Alternatif</a>
				<a href="<?= base_url() ?>/admin/alternatif/perhitungan" class="btn btn-info">Matriks Perhitungan Alternatif</a>
				<p></p>
				<?php if (isset($_GET['error']) && $_GET['error'] == 'not_valid') { ?>
				<div class="alert alert-danger" role="alert">
					Data Matriks Alternatif belum lengkap
				</div>						
				<?php } ?>
			</div>
			<div class="col-sm-12">
				<table class="table table-bordered">
					<tr>
						<td>No</td>
						<td>Nama</td>
						<td>Aksi</td>
					</tr>
					<?php if(empty($alternatif)){ ?>
					<tr>
						<td colspan="3"><i>Tidak ada data</i></td>
					</tr>
					<?php } ?>

					<?php $no=1; foreach($alternatif as $rs): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $rs->nama ?></td>
						<td>
							<a href="<?= base_url() ?>/admin/alternatif/edit/<?=$rs->id?>" class="btn btn-sm btn-success"><i class="fa fa-pencil-alt"></i></a>
							<a href="<?= base_url() ?>/admin/alternatif/delete/<?=$rs->id?>" class="btn btn-sm btn-warning"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
					<?php endforeach ?>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $this->load("partial.footer") ?>

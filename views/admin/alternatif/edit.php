<?php set_page("Alternatif"); $this->load("partial.header") ?>
<div class="container">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-sm-12">
				<h2>Edit Alternatif</h2>
				<?php if ($error) { ?>
				<div class="alert alert-danger" role="alert">
					Alternatif sudah ada.
				</div>						
				<?php } ?>
			</div>
			<div class="col-sm-12">
				<form method="post" action="<?= base_url() ?>/admin/alternatif/update">
					<input type="hidden" name="id" value="<?= $alternatif->id ?>">
					<div class="form-group">
						<label for="nama">Nama Alternatif</label>
						<input type="text" name="nama" class="form-control" placeholder="Nama Alternatif" required="" value="<?= $alternatif->nama ?>">
						<span class="form-error nama">Nama Alternatif tidak boleh kosong</span>
					</div>
					<button class="btn btn-danger"><i class="fa fa-save"></i> Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php $this->load("partial.footer") ?>

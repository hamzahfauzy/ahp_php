<?php set_page("Alternatif"); $this->load("partial.header") ?>
<div class="container">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-sm-12">
				<h2 align="center">Matriks Perhitugan Alternatif</h2>
				<p></p>
			</div>
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-12 col-md-4 m-auto">
						<form method="post" action="<?= base_url() ?>/admin/alternatif/perhitungan/save" onsubmit="return formSubmit();">
							<div class="form-group">
								<label for="kriteria">Kriteria</label>
								<select name="kriteria" required="" class="form-control">
									<option value="">- Kriteria -</option>
									<?php foreach ($kriteria as $key => $value): ?>
									<option value="<?= $value->id ?>"><?= $value->nama ?></option>
									<?php endforeach ?>
								</select>
								<span class="form-error kriteria">Kriteria tidak boleh kosong</span>
							</div>

							<div class="form-group">
								<label for="alternatif1">Alternatif</label>
								<select name="alternatif1" required="" class="form-control">
									<option value="">- Alternatif -</option>
									<?php foreach ($alternatif as $key => $value): ?>
									<option value="<?= $value->id ?>"><?= $value->nama ?></option>
									<?php endforeach ?>
								</select>
								<span class="form-error alternatif1">Alternatif tidak boleh kosong</span>
							</div>

							<div class="form-group">
								<label for="alternatif2">Alternatif Pembanding</label>
								<select name="alternatif2" required="" class="form-control">
									<option value="">- Alternatif Pembanding -</option>
									<?php foreach ($alternatif as $key => $value): ?>
									<option value="<?= $value->id ?>"><?= $value->nama ?></option>
									<?php endforeach ?>
								</select>
								<span class="form-error alternatif2">Alternatif Pembanding tidak boleh kosong</span>
							</div>

							<div class="form-group">
								<label for="nilai">Nilai</label>
								<input type="tel" name="nilai" class="form-control" placeholder="Nilai" required="">
								<span class="form-error nilai">Nilai tidak boleh kosong</span>
							</div>
							<center>
							<button class="btn btn-danger"><i class="fa fa-save"></i> Simpan</button>
							<a href="<?= base_url() ?>/admin/kriteria" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
							</center>
							<p></p>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<table class="table table-bordered">
					<tr>
						<td>No</td>
						<td>Kriteria</td>
						<td>Alternatif</td>
						<td>Alternatif Pembanding</td>
						<td>Nilai</td>
					</tr>
					<?php if(empty($perhitungan_alternatif)){ ?>
					<tr>
						<td colspan="5"><i>Tidak ada data</i></td>
					</tr>
					<?php } ?>

					<?php $no=1; foreach($perhitungan_alternatif as $rs): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $rs->kriteria()->nama; ?></td>
						<td><?= $rs->alternatif1()->nama; ?></td>
						<td><?= $rs->alternatif2()->nama ?></td>
						<td><?= $rs->nilai ?></td>
					</tr>
					<?php endforeach ?>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $this->load("partial.footer") ?>
<script type="text/javascript">
function formSubmit()
{
	var kriteria1 = $("select[name=alternatif1]").val();
	var kriteria2 = $("select[name=alternatif2]").val();
	if(kriteria1 == kriteria2)
	{
		alert("Alternatif tidak boleh sama");
		return false;
	}
	return true;
}
</script>
<?php 
set_page("Hasil");
$this->load("partial.header"); 
?>
<div class="container">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-sm-12">
				<h2 align="center">Hasil SPK</h2>
				<br>
				<h3>1. Matriks Kriteria</h3>
				<?= $matriks_kriteria ?>
				<br>

				<h3>2. Penjumlahan Baris Kriteria</h3>
				<?= $tabel_baris_kriteria ?>
				<br>

				<h3>3. Total Baris Kriteria : <?= $total_baris_kriteria ?></h3>
				<br>
				<h3>4. Normalisasi Kriteria</h3>
				<?= $normalisasi_kriteria ?>
				<br>

				<h3>5. Matriks Alternatif</h3>
				<?php foreach ($matriks_alternatif as $key => $value): ?>
					<?= $value['table'] ?>
				<?php endforeach ?>
				<br>

				<h3>6. Penjumlahan Baris Alternatif untuk setiap Kriteria</h3>
				<?php foreach ($baris_alternatif as $key => $value): ?>
					<?= $value['table'] ?>
					<h4>Total Baris <?= $value['kriteria']->nama ?> : <?= $value['total_baris'] ?></h4>
				<?php endforeach ?>
				<br>

				<h3>7. Normalisasi Alternatif untuk setiap Kriteria</h3>
				<?php foreach ($normalisasi_alternatif as $key => $value): ?>
					<?= $value['table'] ?>
				<?php endforeach ?>
				<br>

				<h3>8. Hasil</h3>
				<table class="table table-bordered">
				<?php foreach ($hasil as $value): ?>
				<tr>
					<td><?= $value['alternatif'] ?></td>
					<td><?= $value['nilai'] ?></td>
				</tr>
				<?php endforeach ?>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $this->load("partial.footer") ?>

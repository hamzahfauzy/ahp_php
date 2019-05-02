<?php
namespace app;
use vendor\zframework\Model;

class MatriksAlternatif extends Model
{
	static $table = "perhitungan_alternatif";
	static $fields = ["id","kriteria_id", "alternatif_1_id", "alternatif_2_id", "nilai"];

	function kriteria()
	{
		return $this->hasOne(Kriteria::class, ['id'=>'kriteria_id']);
	}

	function alternatif1()
	{
		return $this->hasOne(Alternatif::class, ['id'=>'alternatif_1_id']);
	}

	function alternatif2()
	{
		return $this->hasOne(Alternatif::class, ['id'=>'alternatif_2_id']);
	}
}

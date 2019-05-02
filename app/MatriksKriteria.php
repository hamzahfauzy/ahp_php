<?php
namespace app;
use vendor\zframework\Model;

class MatriksKriteria extends Model
{
	static $table = "perhitungan_kriteria";
	static $fields = ["id", "kriteria_1_id", "kriteria_2_id", "nilai"];

	function kriteria1()
	{
		return $this->hasOne(Kriteria::class, ['id'=>'kriteria_1_id']);
	}

	function kriteria2()
	{
		return $this->hasOne(Kriteria::class, ['id'=>'kriteria_2_id']);
	}
}

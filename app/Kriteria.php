<?php
namespace app;
use vendor\zframework\Model;

class Kriteria extends Model
{
	static $table = "kriteria";
	static $fields = ["id","nama"];

	function matriksAlternatif()
	{
		return $this->hasMany(matriksAlternatif::class,['kriteria_id'=>'id']);
	}
}

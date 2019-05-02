<?php
namespace app\controllers\Admin;
use vendor\zframework\Controller;
use vendor\zframework\Session;
use vendor\zframework\util\Request;
use app\User;
use app\Kriteria;
use app\Alternatif;
use app\MatriksKriteria;
use app\MatriksAlternatif;

class IndexController extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		return $this->view->render("admin.dashboard");
	}

	function tentang()
	{
		return $this->view->render("admin.tentang");
	}

	function hasil()
	{
		$perbandingan_kriteria = MatriksKriteria::get();
		$kriteria = Kriteria::get();

		$perbandingan_alternatif = MatriksAlternatif::get();
		$alternatif = Alternatif::get();

		if(count($perbandingan_kriteria) != $this->fact(count($kriteria)-1))
		{
			$this->redirect()->url('/admin/kriteria?error=not_valid');
			return;
		}

		if(count($perbandingan_alternatif) != ($this->fact(count($alternatif)-1) * count($alternatif)))
		{
			$this->redirect()->url('/admin/alternatif?error=not_valid');
			return;
		}

		$table = "<table class='table table-bordered'>";
		$matriks_kriteria_head = "<tr><td>Kriteria</td>";
		$matriks_kriteria_body = "";
		$tabel_baris_kriteria = "";
		$normalisasi_kriteria = "";
		$baris_kriteria = [];
		$total_baris_kriteria = 0;
		$normalisasi_kriteria_arr = [];

		foreach ($kriteria as $key => $value) 
		{
			$matriks_kriteria_head .= "<th>".$value->nama."</th>";
			$matriks_kriteria_body .= "<tr><td>".$value->nama."</td>";
			$baris_kriteria[$key] = 0;
			foreach ($kriteria as $k => $val) 
			{
				if($key == $k)
				{
					$matriks_kriteria_body .= "<td>1</td>";
					$baris_kriteria[$key] += 1;
				}
				else
				{
					$_perbanding_kriteria = MatriksKriteria::where('kriteria_1_id',$value->id)
															->where('kriteria_2_id',$val->id)
															->first();
					if(!empty($_perbanding_kriteria))
					{
						$matriks_kriteria_body .= "<td>".$_perbanding_kriteria->nilai."</td>";
						$baris_kriteria[$key] += $_perbanding_kriteria->nilai;
					}
					else
					{
						$_perbanding_kriteria = MatriksKriteria::where('kriteria_1_id',$val->id)
															->where('kriteria_2_id',$value->id)
															->first();
						if(!empty($_perbanding_kriteria))
						{
							$matriks_kriteria_body .= "<td>".(1/$_perbanding_kriteria->nilai)."</td>";
							$baris_kriteria[$key] += (1/$_perbanding_kriteria->nilai);
						}
					}

				}
			}
			$matriks_kriteria_body .= "</tr>";
			$tabel_baris_kriteria .= "<tr><td>".$value->nama."</td><td>".$baris_kriteria[$key]."</td></tr>";
			$total_baris_kriteria += $baris_kriteria[$key];
		}

		foreach ($kriteria as $key => $value) 
		{
			$normalisasi_kriteria .= "<tr><td>".$value->nama."</td><td>".$baris_kriteria[$key]/$total_baris_kriteria."</td></tr>";
			$normalisasi_kriteria_arr[$value->id] = $baris_kriteria[$key]/$total_baris_kriteria;
		}

		$matriks_kriteria_head .= "</tr>";
		$tabel_baris_kriteria = $table.$tabel_baris_kriteria."</table>";
		$normalisasi_kriteria = $table.$normalisasi_kriteria."</table>";
		$matriks_kriteria = $table.$matriks_kriteria_head.$matriks_kriteria_body."</table>";


		$matriks_alternatif = [];
		$baris_alternatif = [];
		$normalisasi_alternatif = [];
		$normalisasi_alternatif_arr = [];
		foreach ($kriteria as $key => $value) 
		{
			$normalisasi_body = "";
			$matriks_alternatif[$key]["kriteria"] = $value;
			$baris_alternatif[$key]["kriteria"] = $value;
			$baris_alternatif[$key]["total_baris"] = 0;
			$matriks_head = "<tr><th>".$value->nama."</th>";
			$normalisasi_head = "<tr><th colspan='2'>".$value->nama."</th></tr>";
			$baris_head = "<tr><th colspan='2'>".$value->nama."</th></tr>";
			$matriks_body = "";
			$baris_body = "";
			$baris[$key] = 0;
			foreach ($alternatif as $k => $val) 
			{
				$matriks_head .= "<th>".$val->nama."</th>";
				$matriks_body .= "<tr><td>".$val->nama."</td>";
				$baris_body .= "<tr><td>".$val->nama."</td>";
				$total_baris = 0;
				foreach($alternatif as $kk => $v)
				{
					if($k == $kk)
					{
						$matriks_body .= "<td>1</td>";
						$total_baris += 1;
					}
					else
					{
						$_perbanding_alternatif = MatriksAlternatif::where('alternatif_1_id',$val->id)
															->where('alternatif_2_id',$v->id)
															->where('kriteria_id',$value->id)
															->first();
						if(!empty($_perbanding_alternatif))
						{
							$matriks_body .= "<td>".$_perbanding_alternatif->nilai."</td>";
							$total_baris += $_perbanding_alternatif->nilai;
						}
						else
						{
							$_perbanding_alternatif = MatriksAlternatif::where('alternatif_1_id',$v->id)
																->where('alternatif_2_id',$val->id)
																->where('kriteria_id',$value->id)
																->first();
							if(!empty($_perbanding_alternatif))
							{
								$matriks_body .= "<td>".(1/$_perbanding_alternatif->nilai)."</td>";
								$total_baris += (1/$_perbanding_alternatif->nilai);
							}
						}
					}
				}

				$matriks_body .= "</tr>";
				$baris_body .= "<td>".$total_baris."</td></tr>";
				$baris[$k] = $total_baris;
				$baris_alternatif[$key]["total_baris"] += $total_baris;

			}

			// $normalisasi_alternatif_arr[$key]["kriteria"] = $value;
			foreach ($alternatif as $k => $val) 
			{
				$normalisasi_body .= "<tr><td>".$val->nama."</td>";
				$normalisasi_body .= "<td>".$baris[$k]/$baris_alternatif[$key]["total_baris"]."</td></tr>";
				$normalisasi_alternatif_arr[$val->id][$value->id] = $baris[$k]/$baris_alternatif[$key]["total_baris"];
			}
			$matriks_head .= "</tr>";

			$matriks_alternatif[$key]["table"] = $table.$matriks_head.$matriks_body."</table>";
			$baris_alternatif[$key]["table"] = $table.$baris_head.$baris_body."</table>";
			$normalisasi_alternatif[$key]["table"] = $table.$normalisasi_head.$normalisasi_body."</table>";
		}

		$hasil = [];

		foreach ($normalisasi_alternatif_arr as $key => $value) {
			$hasil[$key]["alternatif"] = Alternatif::find($key)->nama;
			$hasil[$key]["nilai"] = 0;
			foreach ($value as $k => $val) {
				$hasil[$key]["nilai"] += ($val * $normalisasi_kriteria_arr[$k]);
			}
		}

		usort($hasil, function($a, $b) {
			return $a['nilai'] < $b['nilai'];
		});

		// echo "<pre>";
		// print_r($normalisasi_kriteria_arr);
		// print_r($normalisasi_alternatif_arr);
		// print_r($hasil);
		// return;

		return $this->view->render("admin.hasil")->with([
			"matriks_kriteria" => $matriks_kriteria,
			"tabel_baris_kriteria" => $tabel_baris_kriteria,
			"total_baris_kriteria" => $total_baris_kriteria,
			"normalisasi_kriteria" => $normalisasi_kriteria,
			"matriks_alternatif" => $matriks_alternatif,
			"baris_alternatif" => $baris_alternatif,
			"normalisasi_alternatif" => $normalisasi_alternatif,
			"hasil" => $hasil,
		]);
	}

	

	function fact($n)
	{
		if($n==0)
			return 0;
		return $n + $this->fact($n-1);
	}

}

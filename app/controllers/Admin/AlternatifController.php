<?php
namespace app\controllers\Admin;
use vendor\zframework\Controller;
use vendor\zframework\Session;
use vendor\zframework\util\Request;
use app\Alternatif;
use app\Kriteria;
use app\MatriksAlternatif;

class AlternatifController extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->alternatif = new Alternatif;
	}

	function index()
	{
		$alternatif = $this->alternatif->get();
		return $this->view->render("admin.alternatif.index")->with('alternatif',$alternatif);
	}

	function create()
	{
		$error = isset($_GET['error']) ? $_GET['error'] : false;
		return $this->view->render('admin.alternatif.create')->with('error',$error);
	}

	function edit($alternatif)
	{
		$error = isset($_GET['error']) ? $_GET['error'] : false;
		$data["error"] = $error;
		$data["alternatif"] = $this->alternatif->where('id',$alternatif)->first();
		return $this->view->render('admin.alternatif.edit')->with($data);
	}

	function insert(Request $request)
	{
		$alternatif = $this->alternatif->where('nama',$request->nama)->first();
		if(!empty($alternatif))
		{
			$this->redirect()->url("/admin/alternatif/create?error=exists");
			return;
		}

		$alternatif = new Alternatif;
		$alternatif->nama = $request->nama;
		$alternatif->save();

		$this->redirect()->url('/admin/alternatif');
		return;
	}

	function update(Request $request)
	{
		$alternatif = Alternatif::where("nama",$request->nama)->first();
		if(!empty($alternatif) && $alternatif->id != $request->id)
		{
			$this->redirect()->url("/admin/alternatif/edit/".$request->id."?error=exists");
			return;
		}

		$alternatif = Alternatif::where("id",$request->id)->first();
		$param = (array) $request;
		if($alternatif->save($param))
			$this->redirect()->url("/admin/alternatif");
		return;
	}

	function delete($alternatif)
	{
		Alternatif::delete($alternatif);
		$this->redirect()->url("/admin/alternatif");
		return;
	}

	function perhitungan()
	{
		$perhitungan_alternatif = MatriksAlternatif::orderby('kriteria_id')->get();
		$alternatif = Alternatif::get();
		$kriteria = Kriteria::get();
		return $this->view->render('admin.alternatif.perhitungan')->with([
			'perhitungan_alternatif' => $perhitungan_alternatif,
			'alternatif' => $alternatif,
			'kriteria' => $kriteria,
		]);
	}

	function savePerhitungan(Request $request)
	{
		$perhitungan = MatriksAlternatif::where('kriteria_id',$request->kriteria)
										->where('alternatif_1_id',$request->alternatif1)
										->where('alternatif_2_id',$request->alternatif2)
										->orwhere('kriteria_id',$request->kriteria)
										->where('alternatif_1_id',$request->alternatif2)
										->where('alternatif_2_id',$request->alternatif1)
										->first();
		if(empty($perhitungan))
		{
			$perhitungan = new MatriksAlternatif;
			$perhitungan->kriteria_id = $request->kriteria;
		}
		$perhitungan->alternatif_1_id = $request->alternatif1;
		$perhitungan->alternatif_2_id = $request->alternatif2;
		$perhitungan->nilai = $request->nilai;
		$perhitungan->save();

		$this->redirect()->url("/admin/alternatif/perhitungan");
		return;
	}

}

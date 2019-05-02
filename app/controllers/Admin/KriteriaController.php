<?php
namespace app\controllers\Admin;
use vendor\zframework\Controller;
use vendor\zframework\Session;
use vendor\zframework\util\Request;
use app\Kriteria;
use app\MatriksKriteria;

class KriteriaController extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->kriteria = new Kriteria;
	}

	function index()
	{
		$kriteria = $this->kriteria->get();
		return $this->view->render("admin.kriteria.index")->with('kriteria',$kriteria);
	}

	function create()
	{
		$error = isset($_GET['error']) ? $_GET['error'] : false;
		return $this->view->render('admin.kriteria.create')->with('error',$error);
	}

	function edit($kriteria)
	{
		$error = isset($_GET['error']) ? $_GET['error'] : false;
		$data["error"] = $error;
		$data["kriteria"] = $this->kriteria->where('id',$kriteria)->first();
		return $this->view->render('admin.kriteria.edit')->with($data);
	}

	function insert(Request $request)
	{
		$kriteria = $this->kriteria->where('nama',$request->nama)->first();
		if(!empty($kriteria))
		{
			$this->redirect()->url("/admin/kriteria/create?error=exists");
			return;
		}

		$kriteria = new Kriteria;
		$kriteria->nama = $request->nama;
		$kriteria->save();

		$this->redirect()->url('/admin/kriteria');
		return;
	}

	function update(Request $request)
	{
		$kriteria = Kriteria::where("nama",$request->nama)->first();
		if(!empty($kriteria) && $kriteria->id != $request->id)
		{
			$this->redirect()->url("/admin/kriteria/edit/".$request->id."?error=exists");
			return;
		}

		$kriteria = Kriteria::where("id",$request->id)->first();
		$param = (array) $request;
		if($kriteria->save($param))
			$this->redirect()->url("/admin/kriteria");
		return;
	}

	function delete($kriteria)
	{
		Kriteria::delete($kriteria);
		$this->redirect()->url("/admin/kriteria");
		return;
	}

	function perhitungan()
	{
		$perhitungan_kriteria = MatriksKriteria::get();
		$kriteria = Kriteria::get();
		return $this->view->render('admin.kriteria.perhitungan')->with([
			'perhitungan_kriteria' => $perhitungan_kriteria,
			'kriteria' => $kriteria,
		]);
	}

	function savePerhitungan(Request $request)
	{
		$perhitungan = MatriksKriteria::where('kriteria_1_id',$request->kriteria1)
										->where('kriteria_2_id',$request->kriteria2)
										->orwhere('kriteria_1_id',$request->kriteria2)
										->where('kriteria_2_id',$request->kriteria1)
										->first();
		if(empty($perhitungan))
		{
			$perhitungan = new MatriksKriteria;
		}
		$perhitungan->kriteria_1_id = $request->kriteria1;
		$perhitungan->kriteria_2_id = $request->kriteria2;
		$perhitungan->nilai = $request->nilai;
		$perhitungan->save();

		$this->redirect()->url("/admin/kriteria/perhitungan");
		return;
	}

}

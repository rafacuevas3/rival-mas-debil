<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Resultado as Resultado;


class JuegoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('game.index');
	}

	public function ronda_final(){
		$resultados = Resultado::all();
		$acum = 0;
		foreach ($resultados as $resultado) {
			$acum += $resultado->puntos;
		}
		return view('game.final', compact('acum'));
	}

}

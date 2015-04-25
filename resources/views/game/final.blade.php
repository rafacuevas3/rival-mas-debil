@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<h4 class="text-center">Puntos acumulados:</h4>
							<h4 class="text-warning text-center"><strong>{{ $acum }}</strong></h4>
							<img src="{{ asset('/images/background.jpg') }}" alt="FLISoL" class="img-responsive">
						</div>
					</div>
					<div class="row">
						<h3 class="text-center text-success">Respuestas correctas:</h3>
						<div class="col-md-8 col-md-offset-2">
							<h2 class="text-info">Jugador 1: <strong id="respuestas_jugador1" class="text-success">0</strong></h2>
							<h2 class="text-info">Jugador 2: <strong id="respuestas_jugador2" class="text-success">0</strong></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<h2 id="titulo_ronda" class="text-center">Ronda Final</h2>
			<br><br>
			<div class="row">
				<div class="col-md-2">
					<h4 class="text-info text-center">Jugador 1:</h4>
				</div>
				<div class="col-md-2">
					<a href="#" id="j1_1" class="pregunta btn btn-block btn-warning">1</a>
				</div>
				<div class="col-md-2">
					<a href="#" id="j1_2" class="pregunta btn btn-block btn-default disabled">2</a>
				</div>
				<div class="col-md-2">
					<a href="#" id="j1_3" class="pregunta btn btn-block btn-default disabled">3</a>
				</div>
				<div class="col-md-2">
					<a href="#" id="j1_4" class="pregunta btn btn-block btn-default disabled">4</a>
				</div>
				<div class="col-md-2">
					<a href="#" id="j1_5" class="pregunta btn btn-block btn-default disabled">5</a>
				</div>
			</div>
			<br><br>
			<div class="row">
				<div class="col-md-2">
					<h4 class="text-info text-center">Jugador 2:</h4>
				</div>
				<div class="col-md-2">
					<a href="#" id="j2_1" class="pregunta btn btn-block btn-default disabled">1</a>
				</div>
				<div class="col-md-2">
					<a href="#" id="j2_2" class="pregunta btn btn-block btn-default disabled">2</a>
				</div>
				<div class="col-md-2">
					<a href="#" id="j2_3" class="pregunta btn btn-block btn-default disabled">3</a>
				</div>
				<div class="col-md-2">
					<a href="#" id="j2_4" class="pregunta btn btn-block btn-default disabled">4</a>
				</div>
				<div class="col-md-2">
					<a href="#" id="j2_5" class="pregunta btn btn-block btn-default disabled">5</a>
				</div>
			</div>
			<br><br>
			<div class="row">
				<div class="col-md-12 text-center">
					<a href="#" id="correcto" class="btn btn-success">Correcto</a>
					<a href="#" id="incorrecto" class="btn btn-danger">Incorrecto</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
	var jugador = 1;
	var pregunta = 1;

	var correcto_j1 = 0;
	var correcto_j2 = 0;

	var muerte_subita = false;
	
	$(document).on('click', '#correcto', function(){
		x_s(true);
	});

	$(document).on('click', '#incorrecto', function(){
		x_s(false);
	});

	function x_s(band){
		if( !muerte_subita ){
			siguiente(band);
		}
		else{
			compara(band);
		}
	}

	function siguiente(band){
		if( band )
			$('#j'+jugador+'_'+pregunta).removeClass('btn-warning').addClass('btn-success');
		else
			$('#j'+jugador+'_'+pregunta).removeClass('btn-warning').addClass('btn-danger');
		jugador++;
		if( jugador == 3 ){
			jugador = 1;
			pregunta++;
			if( band ){
				correcto_j2++;
				$('#respuestas_jugador2').html( correcto_j2 );
			}
		}
		else
			if( band ){
				correcto_j1++;
				$('#respuestas_jugador1').html( correcto_j1 );
			}
		$('#j'+jugador+'_'+pregunta).removeClass('btn-default disabled').addClass('btn-warning');

		if( pregunta == 6 ){
			if( correcto_j1 > correcto_j2 ){
				alert('El ganador es: El jugador 1');
				$('.pregunta').addClass('disabled');
			}
			if( correcto_j2 > correcto_j1 ){
				alert('El ganador es: El jugador 2');
				$('.pregunta').addClass('disabled');
			}
			if( correcto_j1 == correcto_j2 ){
				alert('Empate');
				$('#titulo_ronda').html('Muerte subita');
				$('#titulo_ronda').addClass('text-danger');
				$('.pregunta.btn-success').each(function(){
					$(this).removeClass('btn-success').addClass('btn-default disabled');
				});
				$('.pregunta.btn-danger').each(function(){
					$(this).removeClass('btn-danger').addClass('btn-default disabled');
				});
				jugador = 1;
				pregunta = 1;
				$('#j'+jugador+'_'+pregunta).removeClass('btn-default disabled').addClass('btn-warning');
				muerte_subita = true;
			}
		}
	}
	function compara(band){
		siguiente(band);
		console.log(jugador);
		console.log('J1: '+correcto_j1);
		console.log('J2: '+correcto_j2);

		if( jugador == 1 && correcto_j1 != correcto_j2 ){
			if( correcto_j1 > correcto_j2 )
				alert('Gano el jugador 1!!');
			if( correcto_j1 < correcto_j2 )
				alert('Gano el jugador 2!!');
			$('.pregunta').addClass('disabled');
		}
	}
</script>
@endsection
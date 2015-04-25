@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-9">
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
		if( !muerte_subita )
			siguiente(true);
		else
			compara(true);
	});

	$(document).on('click', '#incorrecto', function(){
		if( !muerte_subita )
			siguiente(false);
		else
			compara(false);
	});

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
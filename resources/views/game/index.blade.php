@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-body">
					<div id="values" class="row">
						<div class="col-md-8 col-md-offset-2">
						<h4 class="text-center">Puntos</h4>
							<ul id="rest" class="list-unstyled text-center">
								<li id="0"></li>
								<li id="1" class="points"><a href="#" class="btn btn-block btn-default">25 000</a></li>
								<li id="2" class="points"><a href="#" class="btn btn-block btn-default">20 000</a></li>
								<li id="3" class="points"><a href="#" class="btn btn-block btn-default">15 000</a></li>
								<li id="4" class="points"><a href="#" class="btn btn-block btn-default">10 000</a></li>
								<li id="5" class="points"><a href="#" class="btn btn-block btn-default">5 000</a></li>
								<li id="6" class="points"><a href="#" class="btn btn-block btn-default">2 000</a></li>
								<li id="7" class="points"><a href="#" class="btn btn-block btn-default">1 000</a></li>
								<li id="8" class="points"><a href="#" class="btn btn-block btn-danger">500</a></li>
							</ul>
						</div>
					</div>
					<div id="stack" class="row">
						<div class="col-md-8 col-md-offset-2">
							<br>
							<ul id="win" class="list-unstyled text-center" >
								<li id="li-before"></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="panel-footer panel-success text-center">
					Banco: <strong id="banco" class="text-warning" value="0">0</strong>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<a href="#" id="correcto" class="btn btn-info disabled">Correcto</a>
					<a href="#" id="incorrecto" class="btn btn-danger disabled">Incorrecto</a>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-12">
					<a href="#" id="push_banco" class="btn btn-warning btn-block disabled">BANCO</a>
				</div>
			</div>
		</div>
		<div class="col-md-9 background-rival">
			<div class="row">
				<div class="col-md-4 col-md-offset-8">
					<ul class="countdown">
						<div class="input-group">
							<span class="input-group-btn">
								<a id="mas" href="#" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
							</span>
							<input type="text" id="input_timer" name="input_timer" placeholder="Ingresa el tiempo" class="text-center form-control" value="03:00">
							<span class="input-group-btn">
								<a id="menos" href="#" class="btn btn-danger"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
							</span>
						</div><!-- /input-group -->
						<li> <span class="minutes">00</span>
							<p class="minutes_ref">minutos</p>
						</li>
						<li class="seperator">:</li>
						<li> <span class="seconds">00</span>
							<p class="seconds_ref">segundos</p>
						</li>
						<a href="#" id="init_timer" class="btn btn-block btn-success">Iniciar</a>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
	var id = 8;
	var countdown = null;
	var acumulado = 0;
	var ronda = 1;
	$(document).ready(function(){
		
	});
	$(document).on('click', '#correcto', function(){
		if( id >= 1 && acumulado<=25000 ){
			var li = $('#'+id);
			$('#'+id).remove();
			$('#li-before').after(li);
			$('#'+id+'>a').addClass('btn-success').removeClass('btn-danger');
			id--;
			$('#'+id+'>a').addClass('btn-danger').removeClass('btn-default');
		}
	});

	$.fn.countdown = function (minutes, seconds) {
	    // Get reference to container, and set initial content
	    if( minutes < 10 )
    		$('.minutes').html("0"+minutes);
    	else
    		$('.minutes').html(minutes);
	    if( seconds < 10 )
    		$('.seconds').html("0"+seconds);
	    else
    		$('.seconds').html(seconds);

    	// Get reference to the interval doing the countdown
	    countdown = setInterval(function () {
	        if (seconds > 1 || minutes > 0) {
	        	seconds--;
	        	if( seconds < 0 ){
		            minutes--;
		            seconds = 59;
	        	}
		        if( minutes < 10 )
	    			$('.minutes').html("0"+minutes);
		    	else
		    		$('.minutes').html(minutes);
			    if( seconds < 10 )
		    		$('.seconds').html("0"+seconds);
			    else
		    		$('.seconds').html(seconds);
	        } 
	        else {
		    	$('.seconds').html("00");
	        	alert('¡Se termino el tiempo!');
	        	clearInterval(countdown);
	        	almacenar();
	        }
	    // Run interval every 1000ms (1 second)
	    }, 1000);

	};

	$(document).on('click', '#init_timer', function(){
		if( $('#input_timer').val() != '' && countdown == null ){
			acumulado = 0;
			$('#banco').html("0");
			$('#correcto').removeClass('disabled');
			$('#incorrecto').removeClass('disabled');
			$('#push_banco').removeClass('disabled');
			var time = $('#input_timer').val().split(":");
			$(".countdown").countdown( parseInt(time[0]), parseInt(time[1]) );
		}
	});

	$(document).on('click', '#push_banco', function(){
		if( id != 8 ){
			var temp_id = id+1;
			acumulado+= parseInt( $('#'+temp_id+'>a').html().replace(" ", "") );
			if( acumulado >= 25000 ){
				acumulado = 25000;
				alert('¡Felicidades!, Alcanzaron el maximo puntaje')
	        	window.clearInterval(countdown);
				almacenar();
			}
			$('#banco').html( acumulado );
			limpiar();
		}
	});
	$(document).on('click', '#incorrecto', function(){
		if( id != 8 ){
			limpiar();
		}
	});
	$(document).on('click', '#mas', function(){
		var data = $('#input_timer').val().split(':');
		var minutes = parseInt(data[0]);
		var seconds = parseInt(data[1]);
		if( seconds+10 <= 59 ){
			seconds+=10;
			if( minutes < 9 )
				if( seconds < 9 )
					$('#input_timer').val('0'+minutes+':'+'0'+seconds);
				else
					$('#input_timer').val('0'+minutes+':'+seconds);
			else
				if( seconds < 9 )
					$('#input_timer').val(minutes+':'+'0'+seconds);
				else
					$('#input_timer').val(minutes+':'+seconds);
		}
		else{
			seconds+=10;
			seconds-=60;
			minutes++;
			if( minutes < 9 )
				if( seconds < 9 )
					$('#input_timer').val('0'+minutes+':'+'0'+seconds);
				else
					$('#input_timer').val('0'+minutes+':'+seconds);
			else
				if( seconds < 9 )
					$('#input_timer').val(minutes+':'+'0'+seconds);
				else
					$('#input_timer').val(minutes+':'+seconds);
		}
	});$(document).on('click', '#menos', function(){
		var data = $('#input_timer').val().split(':');
		var minutes = parseInt(data[0]);
		var seconds = parseInt(data[1]);
		if( seconds-10 >= 0 ){
			seconds-=10;
			if( minutes < 9 )
				if( seconds < 9 )
					$('#input_timer').val('0'+minutes+':'+'0'+seconds);
				else
					$('#input_timer').val('0'+minutes+':'+seconds);
			else
				if( seconds < 9 )
					$('#input_timer').val(minutes+':'+'0'+seconds);
				else
					$('#input_timer').val(minutes+':'+seconds);
		}
		else{
			seconds-=10;
			seconds+=60;
			minutes--;
			if( minutes < 9 )
				if( seconds < 9 )
					$('#input_timer').val('0'+minutes+':'+'0'+seconds);
				else
					$('#input_timer').val('0'+minutes+':'+seconds);
			else
				if( seconds < 9 )
					$('#input_timer').val(minutes+':'+'0'+seconds);
				else
					$('#input_timer').val(minutes+':'+seconds);
		}
	});
	function almacenar(){
		$('#banco').html( acumulado );
		$('#correcto').addClass('disabled');
		$('#incorrecto').addClass('disabled');
		$('#push_banco').addClass('disabled');
		countdown = null;
        var url  = '{!! url("json_puntaje/' + acumulado +'/'+ ronda +'")!!}';
        $.get(url, function(result){
            console.log(result);
            ronda++;
        }).fail(function(){
            alert('Error');
        });
	}
	function limpiar(){
		$('#'+id+'>a').removeClass('btn-danger').addClass('btn-default');
		var temp_id = id;
		for (var i = id+1; i <= 8; i++) {
			$('#'+i+'>a').removeClass('btn-success').addClass('btn-default');
			var li = $('#'+i);
			$('#'+i).remove();
			$('#'+temp_id).after(li);
			temp_id++;
		};
		$('#8>a').removeClass('btn-default').addClass('btn-danger');
		id=8;
	}
	$(document).on();
	$(document).keyup(function(e){
		e.preventDefault();
	    if( e.keyCode == 32){
	    	if( id != 8 ){
			var temp_id = id+1;
			acumulado+= parseInt( $('#'+temp_id+'>a').html().replace(" ", "") );
			if( acumulado >= 25000 ){
				acumulado = 25000;
				alert('¡Felicidades!, Alcanzaron el maximo puntaje')
	        	window.clearInterval(countdown);
				almacenar();
			}
			$('#banco').html( acumulado );
			limpiar();
		}
	    }
	});
</script>
@endsection
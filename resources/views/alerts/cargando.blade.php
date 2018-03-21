<style type="text/css">

.girar {
  animation-duration: 1.5s;
  animation-name: slidein;
}

@keyframes slidein {
  to {
	-webkit-transition:1.5s;
	-webkit-transform:rotate(360deg);	
  }
}
</style>


<?php /*
<div id='loading' style="display: block" align="center">
	<img class="girar" src='{{asset('images/cargar.png')}}' width="300px" height="300px" style='margin:0 auto; position: absolute; top: 30%; left: 42%; margin: -30px 0 0 -30px; '>
</div>*/ ?>


<div id='loading' align="center">

<img class="girar" src='{{asset('images/cargar.png')}}' width="300px" height="300px" style='margin:0 auto; position: absolute; top: 30%; left: 42%; margin: -30px 0 0 -30px; '>
   <?php //<img src='{{asset('images/loading.gif')}}' style='margin:0 auto; position: absolute; top: 50%; left: 50%; margin: -30px 0 0 -30px; display: block'> ?>
</div>
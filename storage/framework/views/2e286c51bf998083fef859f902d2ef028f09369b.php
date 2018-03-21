<!DOCTYPE html>
<html>
    <head>
        <title>error404</title>


        <style>
            html, body {
                height: 100%;
            }

            body {

                margin: 0;
                padding: 150px;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
                text-align: center;
            }


            .title {
                font-size: 72px;
                margin-bottom: 30px;
            }
        </style>
        <?php echo Html::style('css/bootstrap.css'); ?>


    </head>
    <body>
        <div class="title">ERROR 404 <img src="<?php echo e(asset('images/error.jpg')); ?>" width="100px" height="100px"></div>
        <h3>PAGINA NO ENCONTRADA</h3>
        <?php //<a href="{!!URL::to('pago_empresa')!!}">VOLVER ATRAS</a> ?>
        <a href="javascript:window.history.back();" class="btn btn-info"> Volver Atrás</a>
        
    </body>
</html>

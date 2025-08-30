<!DOCTYPE html>
<html>
    <head>
        <title>Página no encontrada</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                text-align: center;
                margin-top: 50px;
            }
            .error-container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
            }
            h1 {
                color: #e74c3c;
                font-size: 48px;
            }
            p {
                font-size: 18px;
                color: #666;
            }
            a {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #3498db;
                color: white;
                text-decoration: none;
                border-radius: 5px;
            }
            a:hover {
                background-color: #2980b9;
            }
        </style>
    </head>
    <body>
        <div class="error-container">
            <h1>404</h1>
            <h2>Página no encontrada</h2>
            <p>Lo sentimos, el mensaje que estás buscando no existe.</p>
            <a href="{{ route('mensajes.index') }}">Volver a la lista de mensajes</a>
        </div>
    </body>
</html>

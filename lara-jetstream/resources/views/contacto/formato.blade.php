<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body style="background-color: coral">
    <h1>
        <center>Formulario de Contacto</center>
        <p><span style="font-weight: bold">Nombre: </span> {{ $nombre }}</p>
        <p><span style="font-weight: bold">Email: </span> <i>{{ $email }}</i></p>
        <h3>Contenido: </h3>
        <blockquote>
            {{ $contenido }}
        </blockquote>
    </h1>
</body>

</html>

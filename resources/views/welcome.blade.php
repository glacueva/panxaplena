<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panxaplena</title>
    <style>
        /* Tipografía y reset básico */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Comic Sans MS', 'Comic Sans', cursive, sans-serif;
            background-image: url('{{ asset("images/PanxaplenaBackground.jpg") }}');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Contenedor del Logo */
        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
            overflow: none;
        }

        .logo-container img {
            display: block;
            width: min(80vw, 540px);
            max-width: 540px;
            height: auto;
            margin: 40% auto;
        }

        
    </style>
</head>
<body>

    <header class="logo-container">
        <a href="/admin"><img src="{{ asset('images/Panxaplena.png') }}" alt="Panxaplena Logo"></a>
    </header>

</body>
</html>
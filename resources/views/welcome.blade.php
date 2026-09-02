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
            position: relative;
        }

        /* Contenedor del Logo */
        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
            overflow: none;
            margin-top: 10em;
        }

        .logo-container img {
            display: block;
            width: min(80vw, 540px);
            max-width: 540px;
            height: auto;
        }

        /* Enlaces en esquina superior derecha, apilados */
        .top-links {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            z-index: 50;
        }

        .top-links a {
            background: #2f2f2f;
            color: #ffffff;
            text-decoration: none;
            padding: 8px 14px;
            border-right: 4px solid black;
            border-radius: 4px 0 0 4px;
            display: block;
            transition: border-color 150ms ease, border-color 150ms ease, color 150ms ease;
            font-weight: 600;
        }

        .top-links a:hover {
            border-right-color: magenta;
            color: #ffffff;
        }

        
    </style>
</head>
<body>

    <header class="logo-container">
        <img src="{{ asset('images/Panxaplena.png') }}" alt="Panxaplena Logo">
    </header>

    <div class="top-links">
        <a href="/admin">Login</a>
        <a href="/export/menu">Menu</a>
        <a href="/export/shopping-list">Shopping List</a>
    </div>

</body>
</html>
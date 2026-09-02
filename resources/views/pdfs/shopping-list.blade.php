<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping List</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&display=swap');
        body { 
            font-family: 'Comic Neue', "Comic Sans MS", "Comic Sans", cursive; 
            color: #000; 
            background-image: url('{{ asset("images/PanxaplenaBackground.jpg") }}');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
        }
        h1, h2 { text-align: center; margin: 12px 0; }
        .category { text-align: center; font-size: 16px; margin: 18px 0 6px; font-weight: bold; }
        table { 
            width: 90%; 
            border-collapse: collapse; 
            border-spacing: 0; 
            margin: 0 auto;
        }
        #shopping-list {
            background-color: ivory;
            max-width: 500px;
            margin: 0 auto;
            padding: 8px;
        }
        .logo {
            display: block;
            margin: 0 auto;
            max-width: 200px;
            height: auto;
        }
        thead { display: none; }
        td { padding: 8px 4px; }
        .product-row { border-bottom: 1px dotted black; font-size: 12px; }
        .checkbox-cell { width: 32px; text-align: center; }
        .name-cell { width: 70%; }
        .qty-cell { width: 30%; text-align: right; }
        input[type=checkbox] { transform: scale(1.1); }
    </style>
</head>
<body>

    <div id ="shopping-list" oncontextmenu="if (confirm('Print?')) { window.print(); } ">
        <a href="/"><img class="logo" src="{{ asset('images/Panxaplena.png') }}" alt="Panxaplena Logo"></a>
    @foreach($list as $category => $items)
        <div class="category">{{ $category }}</div>
        <table>
            <tbody>
                @foreach($items as $item)
                    @php
                        $name = $item['ingredient'] ?? ($item['product'] ?? '');
                        $qty = $item['qty'] ?? '';
                    @endphp
                    <tr class="product-row">
                        <td class="checkbox-cell"><input type="checkbox"></td>
                        <td class="name-cell">{{ $name }}</td>
                        <td class="qty-cell">{{ $qty }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
    </div>
</body>
</html>

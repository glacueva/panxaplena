<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu</title>
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
        h1 { text-align: center; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; table-layout: auto; background-color: white;}
        th, td { padding: 8px; vertical-align: top; white-space: normal; }
        th { background: #f5f5f5; text-align: center; }
        td { min-height: 60px; }
        .dish { margin-bottom: 6px; font-size: 14px; }
        .dish-qty { font-weight: bold; margin-left: 6px; }
        .logo {
            display: block;
            margin: 0 auto;
            max-width: 200px;
            height: auto;
        }
    </style>
</head>
<body oncontextmenu="if (confirm('Print?')) { window.print(); } ">

    <a href="/"><img class="logo" src="{{ asset('images/Panxaplena.png') }}" alt="Panxaplena Logo"></a>

    <table>
        <thead>
            <tr>
                <th style="width:12%; text-align:left;">&nbsp;</th>
                @foreach($menu->keys() as $day)
                    <th style="text-align:center;">{{ $day }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>

            @foreach ($meal_types as $meal)
                <tr>
                    <th style="text-align:left; vertical-align: top;">{{ $meal }}</th>

                    @foreach($menu->keys() as $day)
                        @php
                            $recipes = $menu[$day][$meal] ?? [];
                        @endphp
                        <td>
                            @if(empty($recipes))
                                &nbsp;
                            @else
                                @foreach($recipes as $dish)
                                    <div class="dish">{{ $dish['recipes'] }}
                                        @if(!empty($dish['quantity']))
                                            <span class="dish-qty">({{ $dish['quantity'] }})</span>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

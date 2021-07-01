<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=ntent="ie=edge">
    <title>Document</title>
</head>
<body>

    <div>
        <p>
            Il ristorante {{ $restaurant ->name }} ha confermato il tuo ordine. <br>
        </p>
    </div>

    <div>
        <p>
            Hai ordinato i seguenti piatti:
        </p>
        <ul>
            @foreach ($order ->dishes as $dish)
                <li>
                    {{ $dish ->name }}
                </li>
            @endforeach
        </ul>
    </div>

    <div>
        Per un totale di {{ $order ->tot_price }} euro.
    </div>

</body>
</html>
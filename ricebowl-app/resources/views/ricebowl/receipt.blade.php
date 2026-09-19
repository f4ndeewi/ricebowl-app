<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Pesanan - Rice Bowl Custom</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,700&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --green-deep: #4F7B52;
            --green-soft: #F1E7D3;
            --mustard: #D2622A;
            --cream: #FBF6EC;
            --charcoal: #2E241C;
            --line: #E6DAC3;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Work Sans', sans-serif;
            background: var(--cream);
            color: var(--charcoal);
            margin: 0;
            padding: 48px 20px;
        }

        .wrap { max-width: 460px; margin: 0 auto; }

        .badge {
            display: inline-block;
            background: var(--green-soft);
            color: var(--green-deep);
            font-size: 13px;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 999px;
            margin-bottom: 16px;
        }

        h1 {
            font-family: 'Fraunces', serif;
            font-size: 32px;
            margin: 0 0 8px;
        }

        .sub { font-size: 15px; color: #7A6A54; margin-bottom: 28px; }

        .card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 24px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--line);
            font-size: 15px;
        }

        .row .label { color: #7A6A54; }
        .row .value { font-weight: 500; }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding-top: 18px;
            font-family: 'Fraunces', serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--green-deep);
        }

        a.btn {
            display: block;
            text-align: center;
            margin-top: 24px;
            padding: 13px;
            background: var(--mustard);
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 15px;
        }

        a.btn:hover { background: #B84F1F; }
    </style>
</head>
<body>
    <div class="wrap">
        <span class="badge">Pesanan diterima</span>
        <h1>Terima kasih, {{ $nama }}!</h1>
        <p class="sub">Rice bowl kamu lagi disiapin. Berikut rinciannya:</p>

        <div class="card">
            <div class="row">
                <span class="label">{{ $base['icon'] }} Base</span>
                <span class="value">{{ $base['nama'] }} · Rp{{ number_format($base['harga']) }}</span>
            </div>
            <div class="row">
                <span class="label">{{ $lauk['icon'] }} Lauk</span>
                <span class="value">{{ $lauk['nama'] }} · Rp{{ number_format($lauk['harga']) }}</span>
            </div>
            <div class="row">
                <span class="label">{{ $level['icon'] }} Level pedas</span>
                <span class="value">{{ $level['nama'] }} · +Rp{{ number_format($level['tambahan']) }}</span>
            </div>
            <div class="total-row">
                <span>Total</span>
                <span>Rp{{ number_format($total) }}</span>
            </div>
        </div>

        <a class="btn" href="{{ route('ricebowl.index') }}">Pesan lagi</a>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rice Bowl Custom - Pesan Menu</title>
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
            background-color: var(--cream);
            background-image: radial-gradient(circle, #E6DAC3 1px, transparent 1px);
            background-size: 22px 22px;
            color: var(--charcoal);
            margin: 0;
            padding: 48px 20px 120px;
        }

        .wrap { max-width: 560px; margin: 0 auto; }

        .eyebrow {
            font-size: 14px;
            color: var(--green-deep);
            font-weight: 600;
            margin-bottom: 4px;
        }

        h1 {
            font-family: 'Fraunces', serif;
            font-size: 42px;
            font-weight: 700;
            margin: 0 0 8px;
            color: var(--charcoal);
        }

        .sub {
            font-size: 15px;
            color: #7A6A54;
            margin-bottom: 32px;
        }

        .card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 20px 40px -12px rgba(46, 36, 28, 0.15);
        }

        .field { margin-bottom: 26px; }

        .field:last-of-type { margin-bottom: 0; }

        .field-label {
            display: block;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 10px;
            color: var(--charcoal);
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--line);
            border-radius: 10px;
            font-family: inherit;
            font-size: 15px;
            background: var(--green-soft);
        }

        input[type="text"]:focus {
            outline: 2px solid var(--green-deep);
            outline-offset: 1px;
        }

        .chip-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .chip-group input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .chip {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border: 1px solid var(--line);
            border-radius: 999px;
            font-size: 14px;
            cursor: pointer;
            background: var(--green-soft);
            color: var(--charcoal);
            position: relative;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .chip:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px -6px rgba(46, 36, 28, 0.25);
        }

        .chip-group input[type="radio"]:checked + .chip {
            background: var(--green-deep);
            border-color: var(--green-deep);
            color: #fff;
            box-shadow: 0 8px 18px -6px rgba(79, 123, 82, 0.5);
        }

        .chip .icon { font-size: 18px; }

        .chip .text { display: flex; flex-direction: column; }

        .chip .price { font-size: 12px; opacity: 0.75; }

        .total-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #fff;
            border-top: 1px solid var(--line);
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 -10px 30px -10px rgba(46, 36, 28, 0.15);
        }

        .total-bar .amount {
            font-family: 'Fraunces', serif;
            font-size: 22px;
            color: var(--green-deep);
        }

        .total-bar button {
            width: auto;
            margin: 0;
            padding: 12px 28px;
        }

        button {
            margin-top: 16px;
            width: 100%;
            padding: 14px;
            background: var(--mustard);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-family: 'Work Sans', sans-serif;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
        }

        button:hover { background: #B84F1F; }
    </style>
</head>
<body>
    <div class="wrap">
        <h1>Yuk Pesan Rice Bowlmu</h1>
        <p class="sub">Tinggal pilih base, lauk, dan level pedas sesuai selera.</p>

        <div class="card">
            <form action="{{ route('ricebowl.order') }}" method="POST" id="orderForm">
                @csrf

                <div class="field">
                    <label class="field-label" for="nama">Nama pemesan</label>
                    <input
                        type="text"
                        name="nama"
                        id="nama"
                        required
                        placeholder="Tulis nama kamu"
                        pattern="[A-Za-z\s]+"
                        title="Nama hanya boleh berisi huruf"
                        oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"
                    >
                </div>

                <div class="field">
                    <span class="field-label">Base</span>
                    <div class="chip-group">
                        @foreach ($bases as $key => $item)
                            <input type="radio" name="base" id="base_{{ $key }}" value="{{ $key }}" required {{ $loop->first ? 'checked' : '' }}>
                            <label class="chip" for="base_{{ $key }}">
                                <span class="icon">{{ $item['icon'] }}</span>
                                <span class="text">
                                    {{ $item['nama'] }}
                                    <span class="price">Rp{{ number_format($item['harga']) }}</span>
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="field">
                    <span class="field-label">Lauk</span>
                    <div class="chip-group">
                        @foreach ($proteins as $key => $item)
                            <input type="radio" name="lauk" id="lauk_{{ $key }}" value="{{ $key }}" required {{ $loop->first ? 'checked' : '' }}>
                            <label class="chip" for="lauk_{{ $key }}">
                                <span class="icon">{{ $item['icon'] }}</span>
                                <span class="text">
                                    {{ $item['nama'] }}
                                    <span class="price">Rp{{ number_format($item['harga']) }}</span>
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="field">
                    <span class="field-label">Level pedas</span>
                    <div class="chip-group">
                        @foreach ($levels as $key => $item)
                            <input type="radio" name="level" id="level_{{ $key }}" value="{{ $key }}" required {{ $loop->first ? 'checked' : '' }}>
                            <label class="chip" for="level_{{ $key }}">
                                <span class="icon">{{ $item['icon'] }}</span>
                                <span class="text">
                                    {{ $item['nama'] }}
                                    <span class="price">+Rp{{ number_format($item['tambahan']) }}</span>
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                           </form>
                    </div>
              </div>

               <div class="total-bar">
                    <span>Total: <span class="amount" id="liveTotal">Rp0</span></span>
                    <button type="submit" form="orderForm">Pesan sekarang</button>
              </div>

            </form>
        </div>
    </div>

    <script>
        const basePrices = {
            @foreach ($bases as $key => $item)
                "{{ $key }}": {{ $item['harga'] }},
            @endforeach
        };
        const proteinPrices = {
            @foreach ($proteins as $key => $item)
                "{{ $key }}": {{ $item['harga'] }},
            @endforeach
        };
        const levelPrices = {
            @foreach ($levels as $key => $item)
                "{{ $key }}": {{ $item['tambahan'] }},
            @endforeach
        };

        function updateTotal() {
            const baseKey = document.querySelector('input[name="base"]:checked')?.value;
            const proteinKey = document.querySelector('input[name="lauk"]:checked')?.value;
            const levelKey = document.querySelector('input[name="level"]:checked')?.value;

            const total = (basePrices[baseKey] || 0) + (proteinPrices[proteinKey] || 0) + (levelPrices[levelKey] || 0);

            document.getElementById('liveTotal').textContent = 'Rp' + total.toLocaleString('id-ID');
        }

        document.querySelectorAll('input[type="radio"]').forEach(function (el) {
            el.addEventListener('change', updateTotal);
        });

        updateTotal();
    </script>
</body>
</html>
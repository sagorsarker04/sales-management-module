<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>itwaybd sales</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                html, body { height: 100%; margin: 0; font-family: ui-sans-serif, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; }
                .center { min-height: 100vh; display: flex; align-items: center; justify-content: center; background: #f8fafc; }
                .card { background: #fff; border-radius: 8px; padding: 2rem; box-shadow: 0 6px 18px rgba(15,23,42,0.08); text-align: center; max-width: 560px; width: 100%; }
                .title { font-size: 1.5rem; margin-bottom: 0.5rem; color: #0f172a; }
                .subtitle { color: #475569; margin-bottom: 1.25rem; }
                .btn { display: inline-block; padding: 0.6rem 1rem; border-radius: 6px; text-decoration: none; font-weight: 600; margin: 0.25rem; }
                .btn-primary { background: #2563eb; color: #fff; }
                .btn-outline { background: transparent; border: 1px solid #cbd5e1; color: #0f172a; }
            </style>
        @endif
    </head>
    <body>
        <div class="center">
            <div class="card">
                <div class="title">itwaybd sales</div>
                <div class="subtitle">Manage products and sales quickly. Use the buttons below to view existing sales or add a new sale.</div>

                <div>
                    <a href="{{ route('sales.index') }}" class="btn btn-outline">View Sales</a>
                    <a href="{{ route('sales.create') }}" class="btn btn-primary">Add Sale</a>
                    <a href="{{ route('products.index') }}" class="btn btn-outline">View Products</a>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
                </div>
            </div>
        </div>
    </body>
</html>

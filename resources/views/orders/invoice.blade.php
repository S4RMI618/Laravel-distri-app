<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura - Software NODO</title>
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
        
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .details,
        .products {
            display: flex;
            flex-direction: column;
        }

        .detail-row,
        .product-row {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #ddd;
            gap: 5px;
            border-style: dotted;
        }

        .detail-row:last-child,
        .product-row:last-child {
            border-bottom: none;
        }

        .product-header {
            font-weight: bold;
            background-color: #f2f2f2;
            padding: 8px;
        }

        .total {
            text-align: right;
            font-weight: bold;
        }

        .btn {
            cursor: pointer;
        }
    </style>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @if (app()->environment('local'))
        <!-- Development -->
        <script src="https://cdn.tailwindcss.com"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Production -->
        <link rel="stylesheet" href="{{ asset('build/assets/app-?.css') }}">
        <script src="{{ asset('build/assets/app-?.js') }}" defer></script>
    @endif
</head>

<body class="p-10 my-6 ">
    <div class="w-full max-w-[360px] mx-auto p-4">
        <div class="header">
            <h1 class="text-xl">{{ $order->company_details->name }}</h1>
            <div class="flex items-center justify-center">
                <span>NIT: {{ $order->company_details->nit }}</span>
            </div>
            <div class="flex items-center justify-center">
                <span>{{ $order->company_details->address }}</span>
            </div>
            <div class="flex items-center justify-center">
                <span class="uppercase">{{$order->company_details->municipality}}</span>
            </div>
        </div>
        <!-- Order Details -->
        <div class="details">
            <div class="detail-row">
                <span>Orden #.</span>
                <span>{{ $order->id }}</span>
            </div>
            <div class="detail-row">
                <span>Cliente:</span>
                <span>{{ $order->customer_details->full_name }}</span>
            </div>
            <div class="detail-row">
                <span>Identificación:</span>
                <span>{{ $order->customer_details->identification }}</span>
            </div>
            <div class="detail-row pt-0">
                <span>Fecha:</span>
                <span>{{ $order->created_at->format('d/m/Y') }}</span>
            </div>
            <div class="detail-row">
                <span>Hora:</span>
                <span>{{ $order->created_at->format('H:i:s') }}</span>
            </div>
            <div class="detail-row">
                <span>Distribuidor:</span>
                <span>{{ $order->user->name }}</span>
            </div>
        </div>
        <!-- Product List -->
        <div class="products my-4">
            <div class="product-row product-header">
                <span class="w-full text-center">Producto</span>
                <span class="w-full text-center">Cantidad</span>
                {{-- <span class="w-full text-center">Impuestos</span> --}}
                <span class="w-full text-center">Total</span>
            </div>
            @foreach ($order->products as $product)
                <div class="product-row pt-1">
                    <span class="w-full text-center overflow-x-clip">{{ $product->name }}</span>
                    <span class="w-full text-center">{{ $product->pivot->quantity }}</span>
                    {{-- <span class="w-full text-center">${{ number_format($product->pivot->total_tax, 2) }}</span> --}}
                    <span class="w-full text-center">${{ number_format($product->pivot->total, 2) }}</span>
                </div>
            @endforeach
        </div>
        <!-- Totals -->
        <div class="text-center border-dotted border-y-4 ">
            Detalle de Valores
        </div>
        <div class="details">
            <div class="detail-row border-none pt-2">
                <span class="w-full font-semibold">Subtotal:</span>
                <span class="w-full text-right">${{ number_format($order->subtotal, 2) }}</span>
            </div>
            <div class="detail-row border-none p-0">
                <span class="w-full font-semibold">Impuestos:</span>
                <span class="w-full text-right">${{ number_format($order->total_tax, 2) }}</span>
            </div>
            <div class="detail-row">
                <span class="w-full font-semibold">Total A Pagar: </span>
                <span class="w-full text-right">${{ number_format($order->total, 2) }}</span>
            </div>
        </div>

            <div class="details">
                <div class="flex flex-col text-center p-3">
                    <span>Fecha y hora de impresión:</span>
                    <span id="print-datetime"></span>
                </div>
            </div>
            <!-- Print Button -->
            <div class="w-full flex items-center justify-center">
                <button class="no-print btn bg-gray-300 p-3 py-1 rounded-md" onclick="window.print()">Imprimir</button>
            </div>
        </div>
        <script>
            function getPrintDate() {
                const date = new Date();
                const dateElement = document.getElementById('print-datetime');
                const formattedDate = date.toLocaleString();
                dateElement.textContent = `${formattedDate}`
            }

            getPrintDate();
            ocument.querySelector("button[onclick='window.print()']").addEventListener('click', updatePrintDateTime);
    </script>
</body>

</html>

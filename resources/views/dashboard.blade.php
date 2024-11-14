<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center text-2xl md:text-3xl">
                    {{ __('Hola, bienvenido ') . $user->name . '!' }}

                    <h1 class="text-xl p-4 md:p-6">Aquí se mostrarán las estadísticas de tu empresa.</h1>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 w-full text-center p-4 md:p-8 m-2 mt-0">

                        {{-- Estadísticas de clientes --}}
                        @if (Auth::user()->role_id === 1)
                            <div class="flex flex-col items-center justify-center space-y-2 bg-slate-100 p-4 shadow-md">
                                <a href="{{ route('customer-details.index') }}">
                                    <div
                                        class="flex items-center justify-center rounded-lg shadow-md bg-slate-50 p-3 hover:scale-110 duration-200 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 11a5 5 0 100-10 5 5 0 000 10zm-7 8a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </a>
                                <p class="text-lg font-semibold">Clientes: {{ $customerCount }}</p>
                            </div>
                        @endif

                        {{-- Estadísticas de productos --}}
                        <div class="flex flex-col items-center justify-center space-y-2 bg-slate-100 p-4 shadow-md">
                            <div class="flex items-center justify-center rounded-lg shadow-md bg-slate-50 p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M3 6l3 1 3-1 3 1 3-1 3 1 3-1v13a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6zm3 4h3v10H6V10zm5 10h3V10h-3v10zm5 0h3V10h-3v10z" />
                                </svg>

                            </div>
                            <p class="text-lg font-semibold">Productos: {{ $productCount }}</p>
                        </div>

                        {{-- Estadísticas de órdenes pendientes --}}
                        <div class="flex flex-col items-center justify-center space-y-2 bg-slate-100 p-4 shadow-md">
                            <a href="{{ route('orders.index') }}">
                                <div
                                    class="flex items-center justify-center rounded-lg shadow-md bg-slate-50 p-3 hover:scale-110 duration-200 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-600"
                                        viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M21 8.5V5a1 1 0 0 0-1-1h-3V3a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v1H4a1 1 0 0 0-1 1v3.5l-1 10A1 1 0 0 0 3 19h18a1 1 0 0 0 1-.5l-1-10zM9 4h6v1H9V4zM5 8h14v1H5V8zm0 2h14v7H5v-7z" />
                                    </svg>
                                </div>
                            </a>
                            <p class="text-lg font-semibold">Órdenes pendientes: {{ $pendingOrdersCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

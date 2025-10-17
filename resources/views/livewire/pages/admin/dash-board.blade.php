<div class="w-full py-10 bg-gray-50">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Dados Estatísticos') }}
        </h2>
    </x-slot>
    {{-- Cards Estatísticos --}}
    <div class="max-w-8xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- Total de Utilizadores --}}
        <div
            class="bg-white rounded-2xl shadow-sm p-6 flex items-center justify-between hover:shadow-lg hover:scale-[1.02] transition-all duration-300">
            <div>
                <h3 class="text-gray-500 text-sm font-medium">Total Utilizadores</h3>
                <p class="text-4xl font-extrabold text-gray-900 mt-2">1,245</p>
            </div>
            <div class="bg-blue-100 text-blue-600 p-4 rounded-full shadow-inner">
                <i class="fa-solid fa-users text-2xl"></i>
            </div>
        </div>

        {{-- Total de Produtos --}}
        <div
            class="bg-white rounded-2xl shadow-sm p-6 flex items-center justify-between hover:shadow-lg hover:scale-[1.02] transition-all duration-300">
            <div>
                <h3 class="text-gray-500 text-sm font-medium">Total Produtos</h3>
                <p class="text-4xl font-extrabold text-gray-900 mt-2">568</p>
            </div>
            <div class="bg-green-100 text-green-600 p-4 rounded-full shadow-inner">
                <i class="fa-solid fa-box-open text-2xl"></i>
            </div>
        </div>

        {{-- Total de Encomendas --}}
        <div
            class="bg-white rounded-2xl shadow-sm p-6 flex items-center justify-between hover:shadow-lg hover:scale-[1.02] transition-all duration-300">
            <div>
                <h3 class="text-gray-500 text-sm font-medium">Total Encomendas</h3>
                <p class="text-4xl font-extrabold text-gray-900 mt-2">312</p>
            </div>
            <div class="bg-yellow-100 text-yellow-600 p-4 rounded-full shadow-inner">
                <i class="fa-solid fa-truck-fast text-2xl"></i>
            </div>
        </div>
    </div>

    {{-- Gráfico --}}
    <div class="w-full p-4 sm:p-6 lg:p-8 bg-gray-50 pb-12">
        <div class="max-w-8xl mx-auto mt-10 bg-white rounded-2xl shadow-sm p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-chart-line"></i> Encomendas Mensais
                </h2>
            </div>
            <div wire:ignore class="relative h-80">
                <canvas id="ordersChart" class="w-full h-full"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@php
    $ordersData = $ordersByMonth ?? [12, 19, 3, 5, 2, 3, 15, 9, 6, 12, 7, 14];
@endphp

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('ordersChart').getContext('2d');
        const ordersData = @json($ordersData);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov',
                    'Dez'
                ],
                datasets: [{
                    label: 'Encomendas',
                    data: ordersData,
                    backgroundColor: 'rgba(37, 99, 235, 0.15)',
                    borderColor: 'rgba(37, 99, 235, 0.9)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointHoverRadius: 8,
                    pointBackgroundColor: 'rgba(37, 99, 235, 1)',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        titleFont: {
                            weight: 'bold'
                        },
                        padding: 10
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 5
                        }
                    }
                }
            }
        });
    });
</script>

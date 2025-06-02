<x-admin-layout>
    <x-slot name="pageTitle">Статистика за последние {{ $days }} дней</x-slot>

    <div class="w-3/4 mx-auto my-10 space-y-12">
        <!-- График пользователей -->
        <div class="bg-front border-tf rounded-lg p-6">
            <h2 class="text-2xl mb-4">Регистрации пользователей</h2>
            <div class="flex gap-4 mb-4">
                <button onclick="updateChart('usersChart', 'count')" class="px-4 py-2 bg-main rounded border-tf hover:text-custom-text-hover">По дням</button>
                <button onclick="updateChart('usersChart', 'cumulative')" class="px-4 py-2 bg-main rounded border-tf hover:text-custom-text-hover">Накопленная</button>
            </div>
            <canvas id="usersChart" height="100"></canvas>
        </div>

        <!-- График ошибок -->
        <div class="bg-front border-tf rounded-lg p-6">
            <h2 class="text-2xl mb-4">Сообщенные ошибки</h2>
            <div class="flex gap-4 mb-4">
                <button onclick="updateChart('mistakesChart', 'count')" class="px-4 py-2 bg-main rounded border-tf hover:text-custom-text-hover">По дням</button>
                <button onclick="updateChart('mistakesChart', 'cumulative')" class="px-4 py-2 bg-main rounded border-tf hover:text-custom-text-hover">Накопленная</button>
            </div>
            <canvas id="mistakesChart" height="100"></canvas>
        </div>

        <!-- График статей -->
        <div class="bg-front border-tf rounded-lg p-6">
            <h2 class="text-2xl mb-4">Добавленные статьи</h2>
            <div class="flex gap-4 mb-4">
                <button onclick="updateChart('articlesChart', 'count')" class="px-4 py-2 bg-main rounded border-tf hover:text-custom-text-hover">По дням</button>
                <button onclick="updateChart('articlesChart', 'cumulative')" class="px-4 py-2 bg-main rounded border-tf hover:text-custom-text-hover">Накопленная</button>
            </div>
            <canvas id="articlesChart" height="100"></canvas>
        </div>
    </div>

    <script>
        // Глобальные переменные для хранения данных
        const chartData = {
            users: @json($usersData),
            mistakes: @json($mistakesData),
            articles: @json($postsData) // Переименовали для согласованности
        };

        const charts = {};

        // Инициализация графиков (добавляем articlesChart)
        document.addEventListener('DOMContentLoaded', function() {
            initChart('usersChart', 'Пользователи', chartData.users);
            initChart('mistakesChart', 'Ошибки', chartData.mistakes);
            initChart('articlesChart', 'Статьи', chartData.articles); // Изменили на articlesChart
        });

        function initChart(chartId, label, data) {
            const ctx = document.getElementById(chartId);
            charts[chartId] = new Chart(ctx, {
                type: 'line',
                data: getChartData(label, data, 'count'),
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        }

        function updateChart(chartId, dataType) {
            const label = charts[chartId].data.datasets[0].label.replace(' (накопленная)', '');
            charts[chartId].data = getChartData(
                label,
                chartData[chartId.replace('Chart', '')],
                dataType
            );
            charts[chartId].update();
        }

        function getChartData(label, data, dataType) {
            return {
                labels: data.map(item => item.date),
                datasets: [{
                    label: dataType === 'cumulative' ? `${label} (накопленная)` : label,
                    data: data.map(item => item[dataType]),
                    borderColor: getBorderColor(label),
                    backgroundColor: getBackgroundColor(label),
                    tension: 0.1,
                    fill: true
                }]
            };
        }

        function getBorderColor(label) {
            const colors = {
                'Пользователи': 'rgb(54, 162, 235)',
                'Ошибки': 'rgb(255, 99, 132)',
                'Статьи': 'rgb(75, 192, 192)' // Цвет для статей
            };
            return colors[label] || 'rgb(201, 203, 207)';
        }

        function getBackgroundColor(label) {
            const colors = {
                'Пользователи': 'rgba(54, 162, 235, 0.2)',
                'Ошибки': 'rgba(255, 99, 132, 0.2)',
                'Статьи': 'rgba(75, 192, 192, 0.2)' // Цвет для статей
            };
            return colors[label] || 'rgba(201, 203, 207, 0.2)';
        }
    </script>
</x-admin-layout>

<x-admin-layout>
    <x-slot name="pageTitle">Статистика</x-slot>

    <div class="w-3/4 mx-auto my-10 space-y-12">
        <!-- График пользователей -->
        <div class="bg-front border-tf rounded-lg p-6">
            <h2 class="text-2xl mb-4">Регистрации пользователей</h2>
            <canvas id="usersChart" height="100"></canvas>
        </div>

        <!-- График ошибок -->
        <div class="bg-front border-tf rounded-lg p-6">
            <h2 class="text-2xl mb-4">Сообщенные ошибки</h2>
            <canvas id="mistakesChart" height="100"></canvas>
        </div>

        <!-- График статей -->
        <div class="bg-front border-tf rounded-lg p-6">
            <h2 class="text-2xl mb-4">Добавленные статьи</h2>
            <canvas id="postsChart" height="100"></canvas>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Подготовка данных
            const usersData = @json($usersData);
            const mistakesData = @json($mistakesData);
            const postsData = @json($postsData);

            // Общая функция создания графиков
            function createChart(elementId, label, data) {
                const labels = data.map(item => item.date);
                const counts = data.map(item => item.count);

                new Chart(document.getElementById(elementId), {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: label,
                            data: counts,
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            }

            // Создание графиков
            createChart('usersChart', 'Пользователи', usersData);
            createChart('mistakesChart', 'Ошибки', mistakesData);
            createChart('postsChart', 'Статьи', postsData);
        });
    </script>
</x-admin-layout>

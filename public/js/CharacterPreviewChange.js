document.addEventListener('DOMContentLoaded', function() {
    // Обработка RED изображения
    setupImageUpload('red_picture');
    // Обработка BLU изображения
    setupImageUpload('blu_picture');

    function setupImageUpload(inputId) {
        const input = document.getElementById(inputId);
        const label = input.closest('label');
        const preview = label.querySelector('div:first-child');

        // Показ превью при выборе файла
        input.addEventListener('change', function(e) {
            if (e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    if (!preview.querySelector('img')) {
                        preview.innerHTML = '';
                        const img = document.createElement('img');
                        img.classList.add('object-cover', 'w-full', 'h-full');
                        preview.appendChild(img);
                    }
                    preview.querySelector('img').src = event.target.result;
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // Эффекты при перетаскивании
        preview.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });

        preview.addEventListener('dragleave', function() {
            this.classList.remove('dragover');
        });

        preview.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            if (e.dataTransfer.files[0]) {
                input.files = e.dataTransfer.files;
                const event = new Event('change');
                input.dispatchEvent(event);
            }
        });
    }
});

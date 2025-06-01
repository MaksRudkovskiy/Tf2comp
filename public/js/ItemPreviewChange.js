document.addEventListener('DOMContentLoaded', function() {
const imageInput = document.getElementById('image');
const imagePreview = document.getElementById('image-preview');

// Обработка выбора файла
imageInput.addEventListener('change', function(e) {
if (e.target.files[0]) {
const reader = new FileReader();
reader.onload = function(event) {
// Очищаем превью и создаем изображение
imagePreview.innerHTML = '';
const img = document.createElement('img');
img.src = event.target.result;
img.classList.add('object-contain', 'w-full', 'h-full');
imagePreview.appendChild(img);

// Добавляем эффекты
imagePreview.classList.add('border-custom-selected');
}
reader.readAsDataURL(e.target.files[0]);
}
});

// Эффекты при перетаскивании
imagePreview.addEventListener('dragover', function(e) {
e.preventDefault();
this.classList.add('border-4', 'border-dashed');
});

imagePreview.addEventListener('dragleave', function() {
this.classList.remove('border-4', 'border-dashed');
});

imagePreview.addEventListener('drop', function(e) {
e.preventDefault();
this.classList.remove('border-4', 'border-dashed');
if (e.dataTransfer.files[0]) {
imageInput.files = e.dataTransfer.files;
const event = new Event('change');
imageInput.dispatchEvent(event);
}
});
});

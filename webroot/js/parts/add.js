const dropArea = document.getElementById('dropArea');
const inputFile = document.getElementById('image');
const imagePreview = document.getElementById('imagePreview');
const icon = document.getElementById('icone');

document.getElementById('image').addEventListener('change', function (event) {

    if (event.target.files && event.target.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            icon.style.display = 'none';
        };

        reader.readAsDataURL(event.target.files[0]);
    }
});

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, () => dropArea.classList.add('dragover'), false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, () => dropArea.classList.remove('dragover'), false);
});

dropArea.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const files = e.dataTransfer.files;
    inputFile.files = files;
    handleFile(files[0]);
}

inputFile.addEventListener('change', function (event) {
    if (event.target.files && event.target.files[0]) {
        handleFile(event.target.files[0]);
    }
});

function handleFile(file) {
    const reader = new FileReader();

    reader.onload = function (e) {
        imagePreview.src = e.target.result;
        imagePreview.hidden = false;
        icon.style.display = 'none';
    };

    reader.readAsDataURL(file);
}
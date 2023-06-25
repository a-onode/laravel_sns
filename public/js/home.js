'use strict';

{
    const fileForm = document.getElementById('image');
    const fileName = document.getElementById('file-name');

    fileForm.addEventListener('change', () => {
        if (window.File) {
            const inputFile = fileForm.files[0];
            console.log(inputFile.name);
            fileName.innerText = inputFile.name;
        }
    });

    const textField = document.getElementById('tweet');
    const submitButton = document.getElementById('submit-button');

    textField.addEventListener('keyup', () => {
        if (textField.value !== '') {
            submitButton.disabled = false;
            submitButton.classList.remove('bg-indigo-200');
            submitButton.classList.add('bg-indigo-600', 'hover:bg-indigo-500');
        } else {
            submitButton.disabled = true;
            submitButton.classList.remove('bg-indigo-600', 'hover:bg-indigo-500');
            submitButton.classList.add('bg-indigo-200');
        }
    });
}

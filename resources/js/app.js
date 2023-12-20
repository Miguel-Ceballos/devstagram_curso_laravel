import {Dropzone} from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Upload here your image',
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Delete file',
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        if (document.querySelector('[name="image"]').value.trim()) {
            const imagePost = {};
            imagePost.size = 1234;
            imagePost.name = document.querySelector('[name="image"]').value;

            this.options.addedfile.call(this, imagePost);
            this.options.thumbnail.call(this, imagePost, `/uploads/${imagePost.name}`);

            imagePost.previewElement.classList.add('dz-success', 'dz-complete')
        }
    }

});

dropzone.on('success', function (file, response) {
    document.querySelector('[name="image"]').value = response.image;
});

dropzone.on('error', function (file, message) {
    console.log(message)
});

dropzone.on('removedfile', function () {
    document.querySelector('[name="image"]').value = "";
});



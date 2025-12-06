<script>
    function openFileInput(id) {
        const fileInput = document.querySelector(id);
        fileInput.click();
    }

    function fillTextarea() {
        const content = document.querySelector(".ql-editor").innerHTML;
        $('#copyright').empty().val(content);
    }

    // Images Types
    const imagesTypes = ["jpeg", "png", "svg", "gif", "jpg"];

    // Handle file input change
    function changeFileInput(dz, lt, pi, ufc, uf, ufi, ua, fd, ufn, ufit, event) {
        const file                 = event.target.files[0];
        const dropZone             = document.querySelector(`#${dz}`);
        const loadingText          = document.querySelector(`#${lt}`);
        const previewImage         = document.querySelector(`#${pi}`);
        const uploadedFileCounter  = document.querySelector(`.${ufc}`);
        const uploadedFile         = document.querySelector(`#${uf}`);
        const uploadedFileInfo     = document.querySelector(`#${ufi}`);
        const uploadArea           = document.querySelector(`#${ua}`);
        const fileDetails          = document.querySelector(`#${fd}`);
        const uploadedFileName     = document.querySelector(`.${ufn}`);
        const uploadedFileIconText = document.querySelector(`.${ufit}`);

        uploadFile(
            file,
            dropZone,
            loadingText,
            previewImage,
            uploadedFile,
            uploadedFileInfo,
            uploadArea,
            fileDetails,
            uploadedFileName,
            uploadedFileCounter,
            uploadedFileIconText
        );
    }

    // Upload file logic
    function uploadFile(file, dropZone, loadingText, previewImage, uploadedFile, uploadedFileInfo, uploadArea,
        fileDetails, uploadedFileName, uploadedFileCounter, uploadedFileIconText) {
        const fileReader = new FileReader();
        const fileType   = file.type;
        const fileSize   = file.size;

        if (fileValidate(fileType, fileSize, uploadedFileIconText)) {
            dropZone.classList.add('drop-zoon--Uploaded');
            loadingText.style.display  = "block";
            previewImage.style.display = 'none';
            uploadedFile.classList.remove('uploaded-file--open');
            uploadedFileInfo.classList.remove('uploaded-file__info--active');

            fileReader.addEventListener('load', () => {
                setTimeout(() => {
                    uploadArea.classList.add('upload-area--open');
                    loadingText.style.display = "none";
                    previewImage.style.display = 'block';

                    fileDetails.classList.add('file-details--open');
                    uploadedFile.classList.add('uploaded-file--open');
                    uploadedFileInfo.classList.add('uploaded-file__info--active');

                    previewImage.setAttribute('src', fileReader.result);
                    uploadedFileName.textContent = file.name;

                    progressMove(uploadedFileCounter);
                }, 500);
            });

            fileReader.readAsDataURL(file);
        }
    }

    // Validate file
    function fileValidate(fileType, fileSize, uploadedFileIconText) {
        const isImage = imagesTypes.filter(type => fileType.includes(type));

        if (isImage.length) {
            uploadedFileIconText.textContent = isImage[0] === 'jpeg' ? 'jpg' : isImage[0];

            if (fileSize <= 2000000) { // 2MB
                return true;
            } else {
                alert('Please ensure your file is 2MB or less.');
                return false;
            }
        } else {
            alert('Please upload a valid image file.');
            return false;
        }
    }

    // (Optional) Progress counter increase function
    function progressMove(uploadedFileCounter) {
        let counter = 0;
        setTimeout(() => {
            const counterInterval = setInterval(() => {
                if (counter >= 100) {
                    clearInterval(counterInterval);
                } else {
                    counter += 10;
                    uploadedFileCounter.textContent = `${counter}%`;
                }
            }, 100);
        }, 600);
    }
</script>

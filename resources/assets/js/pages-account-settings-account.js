/**
 * Account Settings - Account
 */

'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
  // console.log('Test');
  (function () {
    const deactivateAcc = document.querySelector('#formAccountDeactivation');

    // Update/reset user image of account page
    let accountUserImage = document.getElementById('uploadedAvatar');
    const fileInput = document.querySelector('.account-file-input'),
      resetFileInput = document.querySelector('.account-image-reset');

    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    const maxSize = 800 * 1024;

    const uploadAccountImageMsg = document.getElementById('upload-account-image-msg');

    if (accountUserImage) {
      const resetImage = accountUserImage.src;
      fileInput.onchange = () => {
        if (fileInput.files[0]) {
          // check the allowrd types only
          if (allowedTypes.includes(fileInput.files[0].type)) {
            // check the allowrd types only
            if (fileInput.files[0].size > maxSize) {
              uploadAccountImageMsg.classList.remove('alert-danger');
              uploadAccountImageMsg.textContent = 'Image Size Greater than 800 KB.';
              uploadAccountImageMsg.classList.add('alert-danger');
              return false;
            } else {
              uploadAccountImageMsg.classList.remove('alert-danger');
              uploadAccountImageMsg.textContent = '';
              accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
            }
          } else {
            uploadAccountImageMsg.classList.remove('alert-danger');
            uploadAccountImageMsg.textContent = 'Select a valid image file (JPEG , PNG Or GIF).';
            uploadAccountImageMsg.classList.add('alert-danger');
            return false;
          }
        }
      };
      resetFileInput.onclick = () => {
        fileInput.value = '';
        accountUserImage.src = resetImage;
      };
    }
  })();
});

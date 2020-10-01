<template>
   <div class="wrapper">
       <v-file-input
        color=primary
        label="Change article image"
        @change="onAddFiles" />
   </div>
</template>

<script>
export default {
  name: 'imageUpload',
  data: () => ({
    file: [],
    isError: false,
    errorText: null,
  }),
  methods:
    {
      onAddFiles(file) {
        this.uploadFileToCloudinary(file).then((fileResponse) => {
          this.file.push(fileResponse);
        });
      },
      uploadFileToCloudinary(file) {
        return new Promise(((resolve, reject) => {
          const CLOUDINARY_URL = 'https://api.cloudinary.com/v1_1/gaamix/upload';
          const CLOUDINARY_UPLOAD_PRESET = 'dm5lctpo';
          const formData = new FormData();
          formData.append('upload_preset', CLOUDINARY_UPLOAD_PRESET);
          formData.append('folder', 'cloudinary-demo');
          formData.append('file', file);
          const request = new XMLHttpRequest();
          request.open('POST', CLOUDINARY_URL, true);
          request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
          request.onreadystatechange = () => {
            if (request.readyState === 4 && request.status === 200) {
              const response = JSON.parse(request.responseText);
              resolve(response);
            }
            if (request.status !== 200) {
              const response = JSON.parse(request.responseText);
              const error = response.error.message;
              reject(error);
            }
          };
          request.onerror = (err) => {
            reject(err);
          };
          request.send(formData);
        }));
      },
    },
  watch: {
    file: {
      handler(val) {
        this.$emit('getImage', val);
      },
    },
  },
};
</script>

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
    name: "imageUpload",
    data: () => ({
        file: [],
        isError: false,
        errorText: null
    }),
    methods: 
    {
        onAddFiles(file) 
        {
            this.uploadFileToCloudinary(file).then((fileResponse) => {
                this.file.push(fileResponse);
            });
        },
        uploadFileToCloudinary(file) 
        {
            return new Promise(function (resolve, reject) 
            {
                const CLOUDINARY_URL = 'https://api.cloudinary.com/v1_1/gaamix/upload';
                const CLOUDINARY_UPLOAD_PRESET = 'dm5lctpo';
                let formData = new FormData();
                formData.append('upload_preset', CLOUDINARY_UPLOAD_PRESET);
                formData.append('folder', 'cloudinary-demo');
                formData.append('file', file);
                let request = new XMLHttpRequest();
                request.open('POST', CLOUDINARY_URL, true);
                request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                request.onreadystatechange = () => {
                    if (request.readyState === 4 && request.status === 200) {
                        let response = JSON.parse(request.responseText);
                        resolve(response);
                    }
                    if (request.status !== 200) {
                        let response = JSON.parse(request.responseText);
                        let error = response.error.message;
                        alert('error, status code not 200 ' + error);
                        reject(error);
                    }
                };
                request.onerror = (err) => {
                    alert('error: ' + err);
                    reject(err);
                };
                request.send(formData);
            });
        }
    },
    watch: {
        file:{
            handler(val)
            {
                this.$emit("getImage", val);
            }
        }
    }
}
</script>
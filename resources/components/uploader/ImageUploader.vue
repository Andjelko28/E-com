<template>
    <div>
        <form @submit.prevent="uploadImage">
            <input type="file" @change="onFileChange" />
            <button type="submit">Upload image</button>
        </form>
        <div v-if="imagePath">
            <p>Image uploaded successfully!</p>
            <img
                :src="`/images/${imagePath}`"
                alt="Uploaded Image"
                style="width: 200px"
            />
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            selectedFile: null,
            imagePath: null,
        };
    },
    methods: {
        onFileChange(e) {
            this.selectedFile = e.target.files[0];
        },
        async uploadImage() {
            const formData = new FormData();
            formData.append("image", this.selectedFile);

            try {
                const response = await axios.post(
                    "/api/upload-image",
                    formData,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                );
                this.imagePath = response.data.image_path;
            } catch (e) {
                console.error("Error uploading image", e);
            }
        },
    },
};
</script>

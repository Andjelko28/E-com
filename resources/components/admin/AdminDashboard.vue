<template>
    <div>
        <h2>Add Product</h2>
        <form>
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" v-model="form.name" />
            </div>
            <div>
                <label for="description">Description</label>
                <input
                    type="text"
                    id="description"
                    v-model="form.description"
                />
            </div>
            <div>
                <label for="price">Price</label>
                <input type="number" id="price" v-model="form.price" />
            </div>
            <div>
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" v-model="form.quantity" />
            </div>
            <div>
                <label for="category">Category</label>
                <input id="category" v-model="form.category" />
            </div>
            <div>
                <label for="brand">Brand</label>
                <input type="text" name="" id="brand" v-model="form.brand" />
            </div>
            <div>
                <label for="image">Image</label>
                <input type="file" id="image" @change="onFileChange" />
            </div>
            <button>Add product</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            form: {
                name: "",
                description: "",
                price: "",
                quantity: "",
                category: "",
                brand: "",
                image: "",
            },
        };
    },
};
</script>

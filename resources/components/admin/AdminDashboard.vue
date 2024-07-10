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
                <select name="" id="">
                    <option value=""></option>
                </select>
            </div>
            <div>
                <label for="brand">Brand</label>
                <input type="text" name="" id="brand" v-model="form.brand" />
                <select name="" id="">
                    <option value=""></option>
                </select>
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
                category_id: "",
                brand_id: "",
                image: "",
            },
            newBrand: "",
            newCategory: "",
            brands: [],
            categories: [],
        };
    },
    mounted() {
        this.fetchBrands();
        this.fetchCategories();
    },
    methods: {
        async fetchBrands() {
            try {
                const response = await axios.get("/api/brands");
                this.brands = response.data;
            } catch (error) {
                console.error("Error fetching brands:", error);
            }
        },
        async fetchCategories() {
            try {
                const response = await axios.get("/api/categories");
                this.categories = response.data;
            } catch (error) {
                console.error("Error fetching categories:", error);
            }
        },
        async addBrand() {
            if (this.newBrand.trim()) {
                try {
                    const response = await axios.post("/api/brands", {
                        name: this.newBrand,
                    });
                    this.brands.push(response.data.brand);
                    this.newBrand = "";
                } catch (error) {
                    console.error("Error adding brand:", error);
                }
            }
        },
        async addCategory() {
            if (this.newCategory.trim()) {
                try {
                    const response = await axios.post("/api/categories", {
                        name: this.newCategory,
                    });
                    this.categories.push(response.data.category);
                    this.newCategory = "";
                } catch (error) {
                    console.error("Error adding category:", error);
                }
            }
        },
        async submitForm() {
            try {
                await axios.post("/api/products", this.form);
                console.log("Product added successfully");
            } catch (error) {
                console.error("Error adding product:", error);
            }
        },
    },
};
</script>

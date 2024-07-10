<template>
    <div>
        <h2>Add Product</h2>
        <form @submit.prevent="submitForm">
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" v-model="form.name" required />
            </div>
            <div>
                <label for="description">Description</label>
                <input
                    type="text"
                    id="description"
                    v-model="form.description"
                    required
                />
            </div>
            <div>
                <label for="price">Price</label>
                <input type="number" id="price" v-model="form.price" required />
            </div>
            <div>
                <label for="stock">Quantity</label>
                <input type="number" id="stock" v-model="form.stock" required />
            </div>
            <div>
                <label for="category">Category</label>
                <select v-model="form.category_id">
                    <option value="" disabled>Select a Category</option>
                    <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="category.id"
                    >
                        {{ category.name }}
                    </option>
                </select>
                <input
                    type="text"
                    v-model="newCategory"
                    placeholder="New Category"
                />
            </div>
            <div>
                <label for="brand">Brand</label>
                <select v-model="form.brand_id">
                    <option value="" disabled>Select a Brand</option>
                    <option
                        v-for="brand in brands"
                        :key="brand.id"
                        :value="brand.id"
                    >
                        {{ brand.name }}
                    </option>
                </select>
                <input type="text" v-model="newBrand" placeholder="New Brand" />
            </div>
            <button type="submit">Add product</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            form: this.getInitialFormData(),
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
        getInitialFormData() {
            return {
                name: "",
                description: "",
                price: "",
                stock: "",
                category_id: "",
                brand_id: "",
            };
        },
        async fetchData(endpoint, dataProperty) {
            try {
                const response = await axios.get(endpoint);
                this[dataProperty] = response.data;
            } catch (error) {
                console.error(`Error fetching ${dataProperty}:`, error);
            }
        },
        fetchBrands() {
            this.fetchData("/api/brands", "brands");
        },
        fetchCategories() {
            this.fetchData("/api/categories", "categories");
        },
        async createNewEntity(endpoint, name) {
            try {
                const response = await axios.post(endpoint, { name });
                return response.data;
            } catch (error) {
                console.error(`Error creating ${name}:`, error);
            }
        },
        async handleNewCategory() {
            if (this.newCategory.trim()) {
                const categoryData = await this.createNewEntity(
                    "/api/categories",
                    this.newCategory
                );
                if (categoryData && categoryData.category) {
                    this.form.category_id = categoryData.category.id;
                    this.categories.push(categoryData.category);
                    this.newCategory = "";
                }
            }
        },
        async handleNewBrand() {
            if (this.newBrand.trim()) {
                const brandData = await this.createNewEntity(
                    "/api/brands",
                    this.newBrand
                );
                if (brandData && brandData.brand) {
                    this.form.brand_id = brandData.brand.id;
                    this.brands.push(brandData.brand);
                    this.newBrand = "";
                }
            }
        },
        async submitForm() {
            try {
                await this.handleNewCategory();
                await this.handleNewBrand();

                const formData = new FormData();
                Object.keys(this.form).forEach((key) => {
                    formData.append(key, this.form[key]);
                });

                await axios.post("/api/products", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                });

                console.log("Product added successfully");
                this.form = this.getInitialFormData();
            } catch (error) {
                console.error("Error adding product:", error);
            }
        },
    },
};
</script>

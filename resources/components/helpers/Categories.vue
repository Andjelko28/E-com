<template>
    <ul class="list-style-none">
        <li
            v-for="category in categories"
            :key="category.id"
            class="category-li px-5"
        >
            <a href="#" class="a-style-none fs-5">{{ category.name }}</a>
        </li>
    </ul>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            categories: [],
        };
    },
    mounted() {
        this.fetchCategories();
    },
    methods: {
        async fetchCategories() {
            try {
                const response = await axios.get("/api/categories");
                this.categories = response.data;
            } catch (error) {
                console.error("Error fetching categories", error);
            }
        },
    },
};
</script>

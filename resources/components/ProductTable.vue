<template>
    <div>
        <vue-good-table
            :columns="columns"
            :rows="rows"
            :pagination-options="{ enabled: true, perPage: 10 }"
        >
            <template slot="table-row" slot-scope="props">
                <tr>
                    <td>{{ props.row.name }}</td>
                    <td>{{ props.row.description }}</td>
                    <td>{{ props.row.price }}</td>
                    <td>{{ props.row.stock }}</td>
                </tr>
            </template>
        </vue-good-table>
    </div>
</template>

<script>
import axios from "axios";
import "vue-good-table-next/dist/vue-good-table-next.css";
import { VueGoodTable } from "vue-good-table-next";

export default {
    components: {
        VueGoodTable,
    },
    data() {
        return {
            columns: [
                {
                    label: "Name",
                    field: "name",
                    sortable: true,
                    filterable: true,
                },
                {
                    label: "Description",
                    field: "description",
                },
                {
                    label: "Price",
                    field: "price",
                    type: "number",
                    sortable: true,
                    filterable: true,
                },
                {
                    label: "Stock",
                    field: "stock",
                    type: "number",
                    sortable: true,
                    filterable: true,
                },
            ],
            rows: [],
            loading: false,
            error: null,
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        async fetchData() {
            this.loading = true;
            try {
                const response = await axios.get("/api/products");
                console.log(response.data);
                this.rows = response.data;
            } catch (error) {
                console.error("Error fetching data:", error);
                this.error = "Failed to fetch data.";
            } finally {
                this.loading = false;
            }
        },
    },
};
</script>

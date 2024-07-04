<template>
    <div class="dropdown m-2">
        <button
            :id="label"
            class="btn btn-secondary dropdown-toggle dropdown-button"
        >
            {{ selectedValue ? selectedValue.name : label }}
        </button>
        <div class="dropdown-menu">
            <a
                href=""
                class="dropdown-item"
                v-for="item in items"
                :key="item.id"
                @click.prevent="selectValue(item)"
                >{{ item.name }}</a
            >
        </div>
    </div>
</template>

<script>
export default {
    props: {
        label: String,
        fetchData: {
            type: Function,
            required: true,
            validator: function (value) {
                return typeof value === "function";
            },
        },
    },
    data() {
        return {
            items: [],
            selectedValue: null,
        };
    },
    mounted() {
        this.loadValues();
    },
    methods: {
        async loadValues() {
            if (this.fetchData) {
                try {
                    const response = await this.fetchData();
                    console.log(response.data);
                    this.items = response.data;
                } catch (error) {
                    console.error("Error fetching data", error);
                }
            }
        },
        selectValue(item) {
            this.selectedValue = item;
            this.$emit("item-selected", item);
        },
    },
};
</script>

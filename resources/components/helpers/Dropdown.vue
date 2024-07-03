<template>
    <div class="dropdown m-2">
        <button :for="label" class="btn btn-secondary dropdown-toggle dropdown-button"><slot></slot></button>
        <div class="dropdown-menu">
            <a href="" class="dropdown-item">Link 1</a>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        label: String,
    },
    fetchData: {
        type: Function,
    },
    data() {
        return {
            items: [],
            selectedValue: null,
        };
    },
    mounted() {
        //  this.fetcData().then((response) => {
        //      this.items = response.data;
        //  });
    },
};
</script>


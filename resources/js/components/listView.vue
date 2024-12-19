<template>
    <div>
        <div v-for="(item, index) in items" :key="index">
            <list-item
                :item="item"
                class="item"
                v-on:itemchanged="$emit('reloadList')"
            />
        </div>
    </div>
</template>

<script>
import listItem from "./listItem.vue";

export default {
    props: ["items"],
    components: {
        listItem,
    },
};
</script>

<style scoped>
.item {
    background-color: #8600c5;
    padding: 10px;
    margin-top: 20px;
    border-radius: 12px;
}
</style>

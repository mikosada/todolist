<template>
    <div class="todoContainer">
        <div class="container">
            <add-item v-on:reloadList="getList" />
            <listView :items="items" v-on:reloadList="getList" />
        </div>
    </div>
</template>

<script>
import addItem from "../components/addItem.vue";
import listView from "../components/listView.vue";
import Navbar from "../components/Navbar.vue";
export default {
    name: "home",
    components: {
        addItem,
        listView,
        Navbar,
    },
    data: function () {
        return {
            items: [],
        };
    },
    methods: {
        getList() {
            axios
                .get("api/tasks")
                .then((response) => {
                    this.items = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    created() {
        this.getList();
    },
};
</script>

<style scoped>
.todoContainer {
    width: 100%;
    margin: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.container {
    width: 70%;
}

#title {
    text-align: center;
    font-weight: 700;
    font-size: 24px;
    color: white;
}
</style>

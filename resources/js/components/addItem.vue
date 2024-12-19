<template>
    <div class="card">
        <div class="addItem">
            <form @submit.prevent="addItem">
                <div class="inputItem">
                    <label for="title">Title</label>
                    <input
                        type="text"
                        id="title"
                        v-model="title"
                        placeholder="Enter task title"
                        required
                    />
                    <font-awesome-icon
                        icon="plus-square"
                        :class="[title ? 'active' : 'inactive', 'plus']"
                    />
                </div>
                <div class="inputItem">
                    <label for="description">Description</label>
                    <textarea
                        id="description"
                        v-model="description"
                        placeholder="Enter task description"
                    ></textarea>
                    <font-awesome-icon
                        icon="plus-square"
                        :class="[description ? 'active' : 'inactive', 'plus']"
                    />
                </div>
                <div class="submit">
                    <input type="submit" value="Add Task" />
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            title: "",
            description: "",
        };
    },
    methods: {
        addItem() {
            if (this.title === "") {
                return;
            }

            axios
                .post("api/tasks", {
                    title: this.title,
                    description: this.description,
                })
                .then((response) => {
                    if (response.status === 201) {
                        this.title = "";
                        this.description = "";
                        this.$emit("reloadList");
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style scoped>
.card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    transition: transform 0.2s;
}

.card:hover {
    transform: scale(1.01);
}

.addItem {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 12px;
}

.inputItem {
    display: flex;
    align-items: center;
    width: 100%;
}

label {
    width: 150px;
    margin-right: 10px;
}

input,
textarea {
    background: #f7f7f7;
    border: none;
    outline: none;
    padding: 5px;
    width: 100%;
    margin: 10px;
    transition: border-color 0.3s;
}

input:focus,
textarea:focus {
    border-color: #00ce25;
}

form {
    width: 50%;
}

.plus {
    font-size: 20px;
}

.active {
    color: #00ce25;
}

.inactive {
    color: #999999;
}

.submit {
    width: 100%;
    display: flex;
    justify-content: center;
}

.submit input {
    width: 50%;
    border-radius: 10px;
    background: #8600c5;
    color: white;
    font-weight: 600;
}
</style>

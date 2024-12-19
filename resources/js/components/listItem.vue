<template>
    <div class="item">
        <input
            class="check"
            type="checkbox"
            @change="updateCheck()"
            :checked="item.completed"
        />
        <span
            v-if="!isEditing"
            :class="[item.completed ? 'completed' : '', 'itemText']"
        >
            <p class="taskTitle">{{ item.title }}</p>
            <p class="taskDesc">{{ item.description }}</p>
        </span>

        <div v-else class="editFields">
            <input type="text" v-model="editedTitle" placeholder="Edit title" />
            <textarea
                v-model="editedDescription"
                placeholder="Edit description"
            ></textarea>
            <button @click="saveEdit">Save</button>
            <button @click="cancelEdit">Cancel</button>
        </div>
        <p class="status">
            {{ item.completed ? "Completed" : "Not Completed" }}
        </p>
        <button @click="startEditing" class="editButton">Edit</button>
        <button @click="removeItem()" class="trashcan">
            <font-awesome-icon icon="trash" />
        </button>
    </div>
</template>

<script>
export default {
    props: ["item"],
    data() {
        return {
            isEditing: false,
            editedTitle: this.item.title,
            editedDescription: this.item.description,
        };
    },
    methods: {
        startEditing() {
            this.isEditing = true;
        },
        cancelEdit() {
            this.isEditing = false;
            this.editedTitle = this.item.title;
            this.editedDescription = this.item.description;
        },
        saveEdit() {
            axios
                .put(`/api/tasks/${this.item.id}`, {
                    title: this.editedTitle,
                    description: this.editedDescription,
                })
                .then((response) => {
                    if (response.status === 200) {
                        this.item.title = response.data.title;
                        this.item.description = response.data.description;
                        this.isEditing = false; // Close edit mode
                        this.$emit("itemchanged");
                    }
                })
                .catch((error) => {
                    console.error("Error updating task:", error);
                });
        },
        updateCheck() {
            const status = !this.item.completed;
            axios
                .put("api/tasks/complete/" + this.item.id, {
                    completed: status,
                })
                .then((response) => {
                    if (response.status === 200) {
                        this.item.completed = response.data.completed;
                        this.$emit("itemchanged");
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        removeItem() {
            axios
                .delete("api/tasks/" + this.item.id)
                .then((response) => {
                    if (response.status === 200) {
                        this.$emit("itemchanged");
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
.completed {
    text-decoration: line-through;
    color: #999999;
}

.itemText {
    width: 100%;
    margin-left: 20px;
    color: whitesmoke;
}

.item {
    display: flex;
    justify-content: center;
    align-items: center;
}

.trashcan {
    background: #8600c5;
    border: none;
    color: red;
    outline: none;
    margin-right: 12px;
}

.taskTitle {
    font-size: 18px;
    text-transform: uppercase;
    font-weight: 600;
}

.taskDesc {
    font-size: 16px;
    font-weight: 400;
}

.check {
    margin-left: 12px;
}

.editFields input,
.editFields textarea {
    width: 100%;
    margin: 5px 0;
    padding: 10px;
    font-size: 16px;
}

.editFields button {
    margin: 5px;
}

.editButton {
    background: none;
    border: none;
    color: #e6e6e6;
    cursor: pointer;
    font-weight: 600;
    text-transform: uppercase;
    margin-right: 12px;
}

.status {
    font-size: 14px;
    font-weight: 500;
    margin-top: 5px;
    color: #e6e6e6;
    text-transform: uppercase;
    margin-right: 12px;
}
</style>

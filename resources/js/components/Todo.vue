<template>
    <div v-if="todo.deleted_at == null" class="input-group input-group-sm">
        <span class="input-group-btn">
            <button v-if="!todo.done" type="button" class="btn btn-xs btn-default"
                    @click="todo.done = true; updateTodo(todo);">
              <i class="fa far fa-square"></i>
            </button>
            <button v-if="this.todo.done" type="button" class="btn btn-xs btn-default"
                    @click="todo.done = false; updateTodo(todo);">
              <i class="fa far fa-check-square"></i>
            </button>
        </span>
        <input v-model="todo.name" class="form-control" v-bind:class="{
            'strikethrough': todo.done
        }" @change="updateTodo(todo)"/>
        <span v-if="todo.done" class="input-group-btn">
            <button title="Delete" type="button" class="btn btn-xs btn-danger"
                    @click="deleteTodo(todo)">
                <i class="fa fa-trash"></i>
            </button>
        </span>
    </div>
</template>

<script>
    export default {
        name: "Todo",
        props: [
            'todo',
        ],
        methods: {
            updateTodo: async function (todo) {
                this.$http.put(`/todos/${todo.id}`, {
                    name: todo.name,
                    done: todo.done,
                })
                    .then(response => {
                        todo = response.data;
                    });
            },
            deleteTodo: async function (todo) {
                //set it deleted immediately so the element will be not displayed.
                todo.deleted_at = 'deleted';
                await this.$http.delete(`/todos/${todo.id}`)
                    .then(async response => {
                        todo = response.data;
                    })
            }
        }
    }
</script>

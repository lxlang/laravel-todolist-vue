<template>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-push-2 col-lg-6 col-lg-push-3 no-padding">
                <div class="box">
                    <div class="box-body">
                        <template v-for="todo in todos">
                            <Todo
                                :key="todo.id"
                                v-bind="todo"
                                @nameChanged="todo.name = $event; updateTodo(todo)"
                                @done="todo.done = true; updateTodo(todo)"
                                @open="todo.done = false; updateTodo(todo)"
                                @delete="deleteTodo(todo)"
                            ></Todo>
                        </template>
                    </div>
                    <div class="box-footer">
                        <div class="input-group input-group-sm">
                            <div class="input-group-addon">
                                <i class="fa fa-plus-square"></i>
                            </div>
                            <input type="text" class="form-control" v-model="newTodo" v-on:keyup.enter="createTodo"/>
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-success btn-flat" @click="createTodo">
                                  <i class="fa fa-plus"></i>
                              </button>
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import Todo from "./Todo";
    export default {
        name: "TodoList",
        components: {
            Todo
        },
        props: [
            'name',
            'todos',
        ],
        data() {
            return {
                newTodo: '',
                loaded: false,
            };
        },
        methods: {
            markDone(todo)
            {
                console.log('mark done');
                let index = this.todos.indexOf(todo);
                this.todos[index].done = true;
                this.updateTodo(this.todos[index]);
            },
            markOpen(todo) {
                console.log('mark open');
                todo.done = false;
                this.updateTodo(todo);
                this.$forceUpdate();
            },
            createTodo() {
                this.$http.post('/todos', {
                    name: this.newTodo,
                }).then(response => {
                    this.newTodo = '';
                    this.todos.push(response.data);
                });
            },
            async updateTodo(todo) {
                this.todos.splice(this.todos.indexOf(todo), 1, todo);

                this.$http.put(`/todos/${todo.id}`, {
                    name: todo.name,
                    done: todo.done,
                })
                    .then(response => {
                        todo = response.data;
                    });

                this.$forceUpdate();
            },
            deleteTodo: async function (todo) {
                this.$http.delete(`/todos/${todo.id}`);
                let index = this.todos.indexOf(todo);
                this.todos.splice(index, 1);
                this.$forceUpdate();
            }
        },
        watch: {

        }
    }
</script>

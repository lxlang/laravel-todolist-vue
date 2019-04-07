<template>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-push-2 col-lg-6 col-lg-push-3">
                <div class="box">
                    <div class="box-header">
                        <h4>{{ this.$props.name }}</h4>
                    </div>
                    <div class="box-body">
                        <Todo
                                v-for="todo in todos"
                                v-bind:key="todo.id"
                                v-bind:todo="todo"
                        ></Todo>
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
                todos: this.$props.todos,
            };
        },
        methods: {
            createTodo: function () {
                this.$http.post('/todos', {
                    name: this.newTodo,
                }).then(response => {
                    this.newTodo = '';
                    this.todos.push(response.data);
                });
            }
        },
    }
</script>

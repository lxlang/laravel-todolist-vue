<template>
    <div v-if="!deleted_at" class="input-group input-group-sm">
        <span class="input-group-btn">
            <button v-if="done" type="button" class="btn btn-xs btn-default" @click="markOpen">
                <i class="fa far fa-check-square"></i>
            </button>
            <button v-else type="button" class="btn btn-xs btn-default" @click="markDone">
                <i class="fa far fa-square"></i>
            </button>
        </span>

        <input :value="name" class="form-control" v-bind:class="{
            'strikethrough': done
        }" @input.lazy="nameChanged"/>

        <span v-if="done" class="input-group-btn">
            <button title="Delete" type="button" class="btn btn-xs btn-danger"
                    @click="del">
                <i class="fa fa-trash"></i>
            </button>
        </span>
    </div>
</template>

<script>
    export default {
        name: "Todo",
        props: [
            'name',
            'done',
            'deleted_at',
        ],
        data() {
            return {
            };
        },
        methods: {
            markDone() {
                this.$emit('done');
            },
            markOpen() {
                this.$emit('open');
            },
            nameChanged(event) {
                this.$emit('nameChanged', event.target.value);
            },
            del() {
                this.$emit('delete');
            },
        },
    }
</script>

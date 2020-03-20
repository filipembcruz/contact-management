<template>
    <form :id="id" :class="css" :action="action" :method="defineMethod" :enctype="enctype" >
        <input v-if="alterMethod" type="hidden" name="_method" :value="alterMethod" />
        <input v-if="token" type="hidden" name="_token" :value="token"/>
        <slot></slot>
    </form>
</template>

<script>
    export default {
        props:['css', 'action', 'method', 'enctype', 'token', 'id'],
        computed: {
            defineMethod: function () {
                let method = this.method.toLowerCase();

                if (method === 'post' || method === 'get') {
                    return method;
                }
                else if (method === 'put') {
                    this.alterMethod = 'put';
                }
                else if (method === 'delete') {
                    this.alterMethod = 'delete';
                }
                return 'post'
            },
        },
        data: function() {
            return {
                alterMethod:''
            }
        }
    }
</script>
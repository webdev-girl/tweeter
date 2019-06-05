<template>
    <div class="">
        {{comment.comment}} <br />
            {{ comment.user_id }} @ {{ comment.created_at }}
     </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props:['comments']
    }
</script>

<template>
    <div>
        <div class="comment-contentborder">
            {{ comment.comment }}
        </div>
        <commenting-component  :tweetId="tweetId"></commenting-component>
    </div>

</template>

<script>
    export default {
        mounted() {
        },
        props: ['tweetId']
    }
</script>

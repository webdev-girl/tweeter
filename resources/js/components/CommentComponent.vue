<template>
    <div>
        <div class="col-sm-2">
            <img class="comment-avatar" src="images/profile.png" alt="profile">
        </div>
        <div class="comment-content" style="font-size: 20px; color:#3B3B54; font-weight:bold; font-style: italic;">
            {{comment.comment}}
        </div>
        <br />
         {{ comment.user_id }} @ {{ comment.created_at }}

    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('CommentComponent mounted.')
        },
        props: ['comment']
    }
</script>

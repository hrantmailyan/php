<template>
    <div>
        <div v-for="comment in comments" :key="comment.id" class="card-body">
            <div>
                User: {{comment.user.name}}
            </div>
            <div>
                Comment: {{comment.text}}
            </div>
            <div v-if="auth" @click="getCommentId(comment)">

                <img src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/26/000000/external-comment-chat-flatart-icons-outline-flatarticons.png"/>
            </div>
            <div>
                <button class="btn btn-danger" v-if="open_child.id == comment.id" @click="openChild(comment.id, false)">close</button>
                <button class="btn btn-primary" v-else @click="openChild(comment.id, true)">open</button>
            </div>
            <div v-if="open_child.id == comment.id">
                <Comment :comment_id="comment.id" :auth="auth" @replacing="getCommentId" ></Comment>
            </div>
        </div>
    </div>
</template>

<script>
    import Comment from './Comments.vue';

export default {
    props:["comments","auth"],
    components: {
            Comment
        },
    data() {
            return {
                open_child:{},
                new_comment:{
                    text: '',
                    parent_id:0,
                    user_id:this.user_id,
                    page_id:''
                },
                replacing_comment:""
            }
        },
    methods: {
        
            openChild: function(id,bool) {
                if (bool) {
                    this.open_child = {id: id}
                }else {
                    this.open_child = {id: ''}
                }
            },
            getCommentId: function(comment) {
                // console.log(comment, 1);
                this.$emit('replacing', comment)
            }
    },
}
</script>
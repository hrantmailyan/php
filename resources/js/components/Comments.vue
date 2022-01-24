<template>
    <div>
        <div v-if="is_empty">Have not comments</div>
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
            <div v-if="open_child.id == comment.id && comment.child_comments">
                <comment :comment_id="comment.id" :auth="auth" @replacing="getCommentId"></comment>
            </div>
        </div>
    </div>
</template>

<script>
// import ChildComment from './ChildComment.vue';
import axios from 'axios';


export default {
    name: 'comment',
    props:["comment_id","auth"],  
    // components: {
    //         ChildComments
    //     },
    data() {
            return {
                comments:[],
                open_child:{},
                new_comment:{
                    text: '',
                    parent_id:0,
                    user_id:this.user_id,
                    page_id:''
                },
                replacing_comment:"",
                is_empty: false
            }
        },
    methods: {
        
            openChild: function(id, bool) {
                if (bool) {
                    this.open_child = {id: id}
                }else {
                    this.open_child = {id: ''}
                }
            },
            getCommentId: function(comment) {
                this.$emit('replacing', comment)
            }
    },
    mounted() {
        axios.get("/comment/"+this.comment_id).then(response => {
            if (response.data.comments.length) {
                this.comments = response.data.comments
            }else {
                this.is_empty = true
            }
        })
    },
}
</script>
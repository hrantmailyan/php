<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-20">
                <div class="card">
                    <div class="card-header">Comments</div>
                    <div class="for-group" v-if="auth">
                        <textarea required name="comment" class="form-control" placeholder="Add your comment" v-model="new_comment.text"></textarea>
                    </div>
                    <div class="for-group" v-if="auth">
                        <button class="btn btn-primary" @click="saveComment">Save</button>
                    </div>
                    <div v-if="replacing_comment && auth">
                        <div class="d-flex justify-content-between">
                            <span>
                                {{replacing_comment}}
                            </span>
                            <button class="btn btn-warning" @click="replacing_comment = ''">Remove</button>
                        </div>
                    </div>
                    <ChildComments :comments="comments" :auth="auth" @replacing="replacing" ></ChildComments>
                    <!-- <div v-for="comment in comments" :key="comment.id" class="card-body">
                        <div>
                            User: {{comment.user.name}}
                        </div>
                        <div>
                            Comment: {{comment.text}}
                        </div>
                        <div @click="getCommentId(comment)" v-if="auth">

                            <img src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/26/000000/external-comment-chat-flatart-icons-outline-flatarticons.png"/>
                        </div>
                        <h6 @click="openChild(comment.id)">open</h6>
                        <div v-if="open_child.id == comment.id">
                            <div v-for="childs in comment.child_comments" :key="childs">
                                {{childs.text}}
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ChildComments from './ChildComments.vue';
import axios from 'axios';

    export default {
        components: {
            ChildComments
        },
        props:['pageComments','user_id'],
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
                auth: this.user_id ? true : false,
                replacing_comment:""
            }
        },
        mounted() {
            console.log('Component mountedaaa.')
            let url = window.location.pathname 
            let page_id = url.substr(url.lastIndexOf('/') + 1);
            this.new_comment.page_id = page_id
            this.comments = JSON.parse(this.pageComments)
        },
        methods: {
            openChild: function(id) {
                this.open_child = {id: id}
            },
            saveComment: function() {
                axios.post("/comment",this.new_comment).then(response => {
                    console.log(response.data.comment);
                    let comment = {
                        id: response.data.comment.id,
                        text:response.data.comment.text,
                        parent_id:response.data.comment.parent_id,
                        user:response.data.comment.user,
                        page_id:response.data.comment.page_id,
                    }
                    
                    this.comments = response.data.comment
                    this.new_comment.text = ''
                    this.replacing_comment = ''
                    this.new_comment.parent_id = 0
                })
            },
            replacing: function(comment) {
                console.log(comment);
                this.replacing_comment = comment.text
                this.new_comment.parent_id = comment.id
            }
        },
    }
</script>

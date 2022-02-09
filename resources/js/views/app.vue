<template>
  <div class="container">
      <h1 class="my-5">Our blog</h1>
      <div v-if="posts">
          <article class="mb-4" v-for="post in posts" :key=" `post-${post.id} `" >
              <h2>{{post.title}}</h2>
              <div class="mb-4">
                  {{formatDate(post.created_at)}}
              </div>
              <p>{{getExcerpt(post.content,100)}}</p>
          </article>

          <!-- PAGINATION -->
          <button class="btn btn-primary mr-3"
          :disabled="pagination.current === 1"
           @click="getPosts(pagination.current-1)">
              Prev
          </button >

          <button class="btn btn-primary mr-3"
          :disabled="pagination.current === pagination.last"
           @click="getPosts(pagination.current +1)">
              Next
          </button>
      </div>

      <div v-else>
          Loading
      </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
name:'App',
components:{},
data(){
    return{
        posts:null,
        pagination:null,
    }
},
created(){
this.getPosts();
},
methods:{
    getPosts(page = 1){
        //AXIOS CALL
        axios.get('http://127.0.0.1:8000/api/posts?page=${page}')
        .then(res=>{
            this.posts = res.data.data;
            this.pagination = {
                current:res.data.current_page,
                last:res.data.last_page
            }
        })
    },
    getExcerpt(text,maxLenght){
    if(text.lenght > maxLenght){
        return text.substr(0,maxLenght) + '...';
    }
    return text;
},
formatDate(postDate){
    const date = new Date(postDate);

    const formatted = new Intl.DateTimeFormat('it-IT').format(date);
    return formatted;
}
},

}
</script>

<style lang="scss">
div{
    h1{
        text-transform:uppercase;
    }
}
</style>
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
              <!-- Route con parametri dettagli -->
                <router-link :to="{name: 'post-detail',
                 params: {slug: post.slug}}">
                  Read more
                </router-link>
          </article>

          <!-- PAGINATION -->
          <button class="btn btn-primary mr-3"
          :disabled="pagination.current === 1"
           @click="getPosts(pagination.current-1)">
              Prev
          </button >

          <button
           v-for="i in pagination.last"
          :key=" `page-${i} `"
          @click="getPosts(i)"
          class="btn mr-3"
          :class="pagination.current === i ? 'btn-primary' : 'btn-secondary' ">
          {{i}}
          </button>

          <button class="btn btn-primary mr-3"
          :disabled="pagination.current === pagination.last"
           @click="getPosts(pagination.current +1)">
              Next
          </button>
      </div>

      <Loader v-else/>
          <!-- Loading -->
  </div>
</template>

<script>
import axios from 'axios';
import Loader from '../components/Loader';

export default {
name:'Blog',
components:{
    Loader
},
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
        axios.get(`http://127.0.0.1:8000/api/posts?page=${page}`)
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

</style>
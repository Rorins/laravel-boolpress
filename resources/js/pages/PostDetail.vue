<template>
  <section class="container">
      <h1>POST TITLE HERE</h1>
      
      <div v-if="post">
          <h1>{{post.title}}</h1>

          <h4>Category:{{post.category.name}}</h4>

          <Tags :list="post.tags" />
          <p>{{post.content}}</p>
      
      </div>

      <Loader text="Loading posts" v-else/>

  </section>
</template>

<script>
import axios from 'axios';
import Tags from '../components/Tags';
import Loader from '../components/Loader';

export default {
name:'PostDetail',
components:{
    Tags,
    Loader,
},
data(){
    return{
        post:null
    }
},
created(){
    this.getPostDetail();
},
methods:{
    getPostDetail(){
        //Get post from api
        axios.get(`http://127.0.0.1:8000/api/posts/${this.$route.params.slug}`)
        .then(res =>{
         

            if(res.data.not_found){
                this.$router.push({name:'not-found'})
            }else{
                this.post = res.data;
            }
            
        })
        .catch(err=> log.error(err))
    }
}
}
</script>

<style>

</style>
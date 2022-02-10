<template>
  <div>
      <Header />
      
      <main>
          <!-- Componenti che matchano la rotta, osserva in che rotta ti trovi -->
          <router-view></router-view>
      </main>
  </div>
</template>

<script>
import Header from '../components/Header';

export default {
name:'App',
components:{
    Header,
},
}
</script>

<style lang="scss">

</style>
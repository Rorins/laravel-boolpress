<template>
   <div> 
        <span class="badge badge-primary mr-2" v-for="tag in list" :key="`tag-${tag.id}`">
            {{tag.name}}
        </span>
    </div>
</template>

<script>
export default {
name:'Tags',
props:{
    list:Array,
}
}
</script>

<style>

</style>
<template>
    <main>
        <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
          <a class="p-2 text-muted" href="#">World</a>
          <a class="p-2 text-muted" href="#">U.S.</a>
          <a class="p-2 text-muted" href="#">Technology</a>
          <a class="p-2 text-muted" href="#">Design</a>
          <a class="p-2 text-muted" href="#">Culture</a>
          <a class="p-2 text-muted" href="#">Business</a>
          <a class="p-2 text-muted" href="#">Politics</a>
          <a class="p-2 text-muted" href="#">Opinion</a>
          <a class="p-2 text-muted" href="#">Science</a>
          <a class="p-2 text-muted" href="#">Health</a>
          <a class="p-2 text-muted" href="#">Style</a>
          <a class="p-2 text-muted" href="#">Travel</a>
        </nav>
      </div>

      <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
          <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
          <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
          <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
        </div>
      </div>
        <h1>Lista post</h1>
            <ul>
                <li v-for="post in posts" :key="post.id">
                    {{post.title}}
                </li>
            </ul>
    </main>
</template>
<script>
    import "bootstrap";
    import "bootstrap/dist/css/bootstrap.min.css";
    export default {
        name:"Main",
        data(){
            return{
                posts: []
            }
        },
        mounted(){
            axios.get("/api/posts")
            .then((response) =>{
                this.posts = response.data.data;
            })
            .catch((error) =>{
                console.log(error);
            })
        }
    }
</script>
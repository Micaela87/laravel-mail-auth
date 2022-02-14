<template>
    <div class="container-series">
        <div v-if="singlePost">
            <h2>Title: {{ singlePost.title }}</h2>
            <h3>Author: {{ singlePost.author }}</h3>
            <p>{{ singlePost.content }}</p>
            <h4>Category: {{ postCategory.name }}</h4>
            <h4>Tags: </h4>
            <ul>
                <li v-for="(tag, i) in postTags">{{ tag.name }}</li>
            </ul>
            <h4>Rating: {{ singlePost.rating }}</h4>
            <h4>Release Date: {{ singlePost.release_date }}</h4>
        </div>
        <div v-else>
            Loading...
        </div>
    </div>

</template>

<script>

    import { getDetails } from "../utils";

    export default {
        data() {
            return {
                singlePost: '',
                postCategory: '',
                postTags: ''
            }
        },
        created() {
            this.showDetails();
        },
        methods: {
            showDetails: async function() {
                this.singlePost = await getDetails(this.$route.params.id);

                try {

                    let responseCategory = await fetch('http://localhost:8000/api/categories/' + this.singlePost.category_id);
                    let responseTags = await fetch('http://localhost:8000/api/posts/' + this.singlePost.id + '/tags');

                    if (responseCategory.ok) {

                        let responseToJson = await responseCategory.json();
                        this.postCategory = responseToJson.data;

                    }

                    if (responseTags.ok) {

                        let responseToJson = await responseTags.json();
                        this.postTags = responseToJson.data;

                    }
                    
                } catch(err) {
                    console.log(err);
                }
                
            }
        },
    }
</script>

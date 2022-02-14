<template>
    <div class="container-series">
        <h1>Edit post</h1>
        <form>
            <label for="title">Titolo</label><br>
            <input type="text" name="title" v-model="postTitle"><br>
            <label for="author">Autore</label><br>
            <input type="text" name="author" v-model="postAuthor"><br>
            <textarea name="content" cols="30" rows="10" v-model="postContent"></textarea><br>
            <label for="category">Category</label>
            <select name="category" v-model="postCategory">
                <option v-for="(category, i) in allCategories" :value="category.id">{{ category.name }}</option>
            </select><br>
            <div v-for="(tag, i) in allTags">
                <label :for="tag.name">{{ tag.name }}</label>
                <input type="checkbox" :value="tag.id" v-model="postTags" name="tags">
            </div>
            <label for="release_date">Data di rilascio</label><br>
            <input type="date" name="release_date" v-model="postReleaseDate"><br>
            <label for="rating">Rating</label>
            <input type="number" name="rating" min="1" max="5" v-model="postRating">
            <input type="button" value="Submit" @click="updatePost()">
        </form>
    </div>
</template>

<script>
    import { getDetails } from "../utils";

    export default {
        data() {
            return {
                singlePost: {},
                urlToPost: 'http://localhost:8000/api/posts/' + this.$route.params.id + '/update',
                allCategories: [],
                allTags: [],
                checkedTags: []
            }
        },
        created() {
            this.showDetails();
        },
        computed: {
            postTitle: {
                get() {
                    return this.singlePost.title;
                },
                set(value) {
                    if (value) {
                        this.singlePost.title = value;
                        return this.singlePost.title;
                    }

                    return this.singlePost.title;
                }
            },
            postAuthor: {
                get() {
                    return this.singlePost.author;
                },
                set(value) {
                    if (value) {
                        this.singlePost.author = value;
                        return this.singlePost.author;
                    }

                    return this.singlePost.author;
                }
            },
            postContent: {
                get() {
                    return this.singlePost.content;
                },
                set(value) {
                    if (value) {
                        this.singlePost.content = value;
                        return this.singlePost.content;
                    }

                    return this.singlePost.content;
                }
            },
            postRating: {
                get() {
                    return this.singlePost.rating;
                },
                set(value) {
                    if (value) {
                        this.singlePost.rating = value;
                        return this.singlePost.rating;
                    }

                    return this.singlePost.rating;
                }
            },
            postReleaseDate: {
                get() {
                    return this.singlePost.release_date;
                },
                set(value) {
                    if (value) {
                        this.singlePost.release_date = value;
                        return this.singlePost.release_date;
                    }

                    return this.singlePost.release_date;
                }
            },
            postCategory: {
                get() {
                    return this.singlePost.category_id
                },
                set(value) {
                    if (value) {
                        this.singlePost.category_id = value;
                        return this.singlePost.category_id;
                    }

                    return this.singlePost.category_id;
                }
            },
            postTags: {
                get() {
                    return this.checkedTags;
                },
                set(value) {
                    if (value) {
                        this.checkedTags = value;
                        return this.checkedTags;
                    }

                    return this.checkedTags;
                }
            }
        },
        methods: {
            showDetails: async function() {
                this.singlePost = await getDetails(this.$route.params.id);
                this.getAllCategories();
                this.getAllTags();
                this.getPostTags();
            },
            getAllCategories: async function() {

                try {

                    let response = await fetch('http://localhost:8000/api/categories');

                    if (response.ok) {
                        let responseToJson = await response.json();

                        this.allCategories = responseToJson.data;
                    }

                } catch(err) {
                    console.log(err);
                }
            },
            getAllTags: async function() {

                try {

                    let response = await fetch('http://localhost:8000/api/tags');

                    if (response.ok) {
                        let responseToJson = await response.json();

                        this.allTags = responseToJson.data;
                    }

                } catch(err) {
                    console.log(err);
                }
            },
            getPostTags: async function() {
                try {

                    let response = await fetch('http://localhost:8000/api/posts/' + this.$route.params.id + '/tags');

                    if (response.ok) {
                        let responseToJson = await response.json();

                        this.checkedTags = responseToJson.data.map( x => x.id);
                    }

                } catch(err) {
                    console.log(err);
                }
            },
            updatePost: async function() {

                let data = JSON.stringify({
                    title: this.postTitle,
                    author: this.postAuthor,
                    content: this.postContent,
                    release_date: this.postReleaseDate,
                    rating: this.postRating,
                    category_id: this.postCategory,
                    tags: this.checkedTags
                });

                try {

                    let response = await fetch(this.urlToPost, {
                        method: 'POST',
                        headers: {
                        'Content-Type': 'application/json'
                        },
                        body: data
                    });

                    if (response.ok) {
                        this.$router.push({ name: 'posts' });
                    }

                } catch(err) {
                    console.log(err);
                }
            }
        }
    }
</script>

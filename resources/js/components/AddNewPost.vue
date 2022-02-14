<template>
    <div class="container-series">
        <h1>Fill in the folloiwing form to add a new post</h1>
        <form>
            <label for="title">Titolo</label><br>
            <input type="text" name="title" v-model="title"><br>
            <label for="author">Autore</label><br>
            <input type="text" name="author" v-model="author"><br>
            <label for="content">Content</label><br>
            <textarea name="content" cols="30" rows="10" v-model="content"></textarea><br>
            <label for="category">Category</label>
            <select name="category" v-model="categoryId">
                <option v-for="(category, i) in categoryArr" :value="category.id">{{ category.name }}</option>
            </select><br>
            <div v-for="(tag, i) in tagsArr">
                <label :for="tag.name">{{ tag.name }}</label>
                <input type="checkbox" name="tag" :value="tag.id" v-model="checkedTags">
            </div>
            <label for="release_date">Data di rilascio</label><br>
            <input type="date" name="release_date" v-model="releaseDate"><br>
            <label for="rating">Rating</label>
            <input type="number" min="1" max="5" name="rating" v-model="rating">
            <input type="button" value="Submit" @click="sendDataToStore()">
        </form>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                title: '',
                author: '',
                content: '',
                releaseDate: '',
                rating: '',
                categoryArr: [],
                categoryId: '',
                tagsArr: [],
                checkedTags: []
            }
        },
        created() {
            this.getAllCategories();
            this.getAllTags();
        },
        methods: {
            sendDataToStore: async function() {

                let data = {
                    title: this.title,
                    author: this.author,
                    content: this.content,
                    release_date: this.releaseDate,
                    rating: this.rating,
                    category_id: this.categoryId,
                    tags: this.checkedTags
                }
                try {

                    let response = await fetch('http://localhost:8000/api/posts/store', {
                        method: 'POST',
                        headers: {
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });

                    if (response.ok) {
                        this.$router.push({ name: 'posts' });
                    }

                } catch(err) {
                    console.log(err);
                }

            },
            getAllCategories: async function() {
                try {
                    let response = await fetch('http://localhost:8000/api/categories');

                    if (response.ok) {

                        let responseToJson = await response.json();
                        this.categoryArr = responseToJson.data;

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
                        this.tagsArr = responseToJson.data;

                    }

                } catch(err) {
                    console.log(err);
                }
            }
        }
    }
</script>
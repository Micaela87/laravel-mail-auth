<template>
    <div class="container-series">
        <form>
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" name="email" required autocomplete="email" autofocus v-model="userEmail">
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" name="password" required autocomplete="current-password" v-model="userPassword">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="button" class="btn btn-primary" @click="logUser()">
                        Login
                    </button>
                </div>
            </div>
        </form>
        <form>
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                <div class="col-md-6">
                    <input id="name" type="text" name="name" v-model="newName" required autocomplete="name" autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" name="email" v-model="newEmail" required autocomplete="email">
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" name="password" required autocomplete="new-password" v-model="newPassword">
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" v-model="passwordConfirmed">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="button" class="btn btn-primary" @click="registerUser()">
                        Register
                    </button>
                </div>
            </div>
        </form>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                userEmail: '',
                userPassword: '',
                newName: '',
                newEmail: '',
                newPassword: '',
                passwordConfirmed: ''
            }
        },
        methods: {
            logUser: async function() {
                let data = {
                    email: this.userEmail,
                    password: this.userPassword
                }
                try {

                    let response = await fetch('http://localhost:8000/api/login', {
                        method: 'POST',
                        headers: {
                        'Content-Type': 'application/json',

                        },
                        body: JSON.stringify(data)
                    });

                    if (response.ok) {
                        
                        let responseHeaders = response.headers.entries();

                        for (let x of responseHeaders) {
                            console.log(x);
                        }

                        this.$router.push({ name: 'posts' });
                    }

                } catch(err) {
                    console.log(err);
                }
            },
            registerUser: async function() {
                let data = {
                    name: this.newName,
                    email: this.newEmail,
                    password: this.newPassword,
                    password_confirmation: this.passwordConfirmed
                }
                try {

                    let response = await fetch('http://localhost:8000/api/register', {
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
            }
        }
    }
</script>

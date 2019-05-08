<template>
    <div>
        <!--  Sign in modal  -->
        <div class="modal fade" id="modalSignIn" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="card-body">
                        <img class="auth-form__logo d-table mx-auto mb-3" src="../../../../images/AV_logo.png"
                             alt="">
                        <h5 class="auth-form__title text-center mb-4">Access Your Account</h5>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="signInEmail">Email address</label>
                                <input type="email" class="form-control" id="signInEmail"
                                       aria-describedby="emailHelp" placeholder="Enter email" v-model="email">
                            </div>
                            <div class="form-group">
                                <label for="signInPassword">Password</label>
                                <input type="password" class="form-control" id="signInPassword"
                                       placeholder="Password" v-model="password">
                            </div>
                            <div class="form-group access-group">
                                <button type="submit" class="btn-accent btn btn-pill  d-table mx-auto login-button"
                                        @click.self.prevent="login">Sign In
                                </button>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="#">Forgot password?</a>
                                <a href="#" id="toggleSignIn" @click="toggleModal(false)">Create account</a>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#"><i class="fab fa-telegram"></i></a>
                        <a href="#"><i class="fab fa-google"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!--  Sign up modal  -->
        <div class="modal fade" id="modalSignUp" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="card-body">
                        <img class="auth-form__logo d-table mx-auto mb-3" src="../../../../images/AV_logo.png"
                             alt="Shards Dashboards - Register Template">
                        <h5 class="auth-form__title text-center mb-4">Create Your Account</h5>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="signUpEmail">Email address</label>
                                <input type="email" class="form-control" id="signUpEmail"
                                       aria-describedby="emailHelp" placeholder="Enter email" v-model="email">
                            </div>
                            <div class="form-group">
                                <label for="signUpPassword">Password</label>
                                <input type="password" class="form-control" id="signUpPassword"
                                       placeholder="Password" v-model="password">
                            </div>
                            <div class="form-group access-group">
                                <button type="submit" class="btn-accent btn btn-pill  d-table mx-auto login-button"
                                        @click.self.prevent="register">Sign Up
                                </button>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="#">Forgot password?</a>
                                <a href="#" @click="toggleModal(true)">Sign in</a>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#"><i class="fab fa-telegram"></i></a>
                        <a href="#"><i class="fab fa-google"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: '',
                password: '',
                csrf_token: view._csrf_token,
            }
        },
        methods: {
            toggleModal(isSignIn) {
                let $modalSignIn = $('#modalSignIn'),
                    $modalSighUp = $('#modalSignUp');

                if (isSignIn) {
                    $modalSignIn.modal('show');
                    $modalSighUp.modal('hide');
                } else {
                    $modalSignIn.modal('hide');
                    $modalSighUp.modal('show');
                }
            },
            login() {
                axios.post('/login', {
                    email: this.email,
                    password: this.password,
                    _csrf_token: this.csrf_token,
                    formSubmitted: true
                }).then(window.location.href = "/dashboard/")
            },
            register() {
                axios.post('/registration', {
                    email: this.email,
                    password: this.password,
                    _csrf_token: this.csrf_token,
                    formSubmitted: true
                });
            }
        }
    }
</script>


<style>

</style>

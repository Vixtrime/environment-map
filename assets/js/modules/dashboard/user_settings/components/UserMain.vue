<template>
    <div class="row">
        <div class="col-lg-8 mx-auto mt-4">
            <div class="card card-small edit-user-details mb-4">
                <div class="card-header p-0">
                    Очень красивая картинка, которая поднимает посетителю настроение
                </div>
                <div class="card-body p-0">
                    <div class="border-bottom clearfix d-flex">
                        <ul class="nav nav-tabs border-0 mt-auto mx-4 pt-2">
                            <li class="nav-item">
                                <a class="nav-link active" href="#" @click="toggleNav('general')">General</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#" @click="toggleNav('payment')">Payment</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#" @click="toggleNav('another')">Another</a>
                            </li>
                        </ul>
                    </div>
                    <form action="#" class="py-4">
                        <div class="form-row mx-4">
                            <div class="col-lg-8">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="about">About me</label>
                                        <input type="text" class="form-control" id="about" value="About"
                                               v-model.trim="formData.about.data" @input="clearInvalid('about')">
                                        <div class="invalid-feedback">{{ formData.about.invalid }}</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="custom-control custom-toggle my-2">
                                            <input type="checkbox" id="notifications" name="customToggle1"
                                                   class="custom-control-input" checked>
                                            <label class="custom-control-label"
                                                   for="customToggle1">Notifications</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer border-top">
                    <a href="#" class="btn btn-sm btn-accent ml-auto d-table mr-3"
                       @click.self.prevent="sendData">Save Changes</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import UserSettingsGeneral from './UserSettingsGeneral';
    import UserSettingsPayments from './UserSettingsPayments';
    import UserSettingsAdditional2 from './UserSettingsAdditional2';

    export default {
        components: {
            UserSettingsGeneral,
            UserSettingsPayments,
            UserSettingsAdditional2
        },
        data() {
            return {
                navBody: 'general',
                formData:
                    {
                        about:
                            {
                                data: '',
                                invalid: ''
                            },
                        notifications:
                            {
                                data: true,
                                invalid: ''
                            }
                    }
            }
        },
        beforeCreate() {
            axios.get('/dashboard/user/settings')
                .then(function (response) {
                    console.log(response);
                });
        },
        methods: {
            sendData() {
                axios.post('/dashboard/user/settings', {
                    notifications: this.formData.notifications.data,
                    about: this.formData.about.data,
                    csrf: dashboard_token,
                    form_submitted: true
                }).then(response => {
                    for (let key in response['data']) {
                        if (this.formData[key]) {
                            this.formData[key]['invalid'] = response['data'][key];
                            document.getElementById(key).classList.add('is-invalid');
                        }
                    }
                });

            },
            toggleNav(navItem) {
                this.navBody = navItem;
            },
            clearInvalid(element) {
                document.getElementById(element).classList.remove('is-invalid');
            }
        }
    }
</script>

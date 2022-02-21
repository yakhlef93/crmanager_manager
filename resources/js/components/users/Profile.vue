<template>
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4 col-xl-3">
            <div class="card col-12">
                <div class="card-header">Profil</div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6 text-center">
                            <img v-if="url" :src="url" class="rounded-circle bg-primary" width="80px" height="80px">
                        </div>
                        <div class="col-md-6 text-center pt-4">
                            <h5>{{form.user_name}}</h5>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <ul>
                            <li class="mt-1"><strong class="mr-3 text-dark">Nom Complet</strong> <span class="text-secondary">{{form.name}}</span></li>
                            <li class="mt-1"><strong class="mr-3 text-dark">Email</strong> <span class="text-secondary">{{form.email}}</span></li>
                            <li class="mt-1"><strong class="mr-3 text-dark">Téléphone</strong> <span class="text-secondary">{{form.phone_number}}</span></li>
                            <!-- <li class="mt-1"><strong class="mr-3 text-dark">Magasing</strong> <span class="text-secondary">{{user.agency.label}}</span></li> -->
                            <li class="mt-1"><strong class="mr-3 text-dark">Adresse</strong> <span class="text-secondary">{{form.address}}</span></li>
                            <!-- <li class="mt-1"><strong class="mr-3 text-dark">Autorisations</strong> 
                                <span class="badge badge-primary m-1 px-2" v-for="permission in user_permissions" :key="permission.id">{{permission}}</span>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-lg-8 col-xl-9">
            <div class="card">
                <div class="card-body">
                    <b-tabs
                        active-nav-item-class="text-danger"
                        active-tab-class="text-secondary"
                        content-class="mt-3"
                    >
                        <b-tab title="Mot de Passe" lazy>
                            <form @submit.prevent="updatePassword">
                                <div class="form-group row">
                                    <label for="old_password" class="col-md-4 col-form-label text-md-right">Ancien Mot de Passe <span class="text-danger">*</span></label>

                                    <div class="col-md-6 mr-auto">
                                        <input id="old_password" v-model="form.old_password" type="password" :class="{'is-invalid':form.errors.old_password}" class="form-control" @input="form.errors.old_password = null" name="old_password" required autocomplete="old-password">
                                        <small class="text-danger" v-if="form.errors.old_password">{{form.errors.old_password[0]}}</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Mot de Passe <span class="text-danger">*</span></label>

                                    <div class="col-md-6 mr-auto">
                                        <input id="password" v-model="form.password" type="password" :class="{'is-invalid':form.errors.password}" class="form-control" @input="form.errors.password = null" name="password" required autocomplete="new-password">
                                        <small class="text-danger" v-if="form.errors.password">{{form.errors.password[0]}}</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmer Mot de Passe <span class="text-danger">*</span></label>

                                    <div class="col-md-6 mr-auto">
                                        <input id="password-confirm" v-model="form.password_confirm" type="password" :class="{'is-invalid':form.errors.password_confirm}" class="form-control" @input="form.errors.password_confirm = null" name="password_confirmation" required autocomplete="new-password">
                                        <small class="text-danger" v-if="form.errors.password_confirm">{{form.errors.password_confirm[0]}}</small>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 col-form-label text-md-right"><small>Remarque: tous les champs avec <span class="text-danger">*</span> sont obligatoires!</small></label>
                                    <div class="col-md-6 mr-auto">
                                        <button type="submit" class="btn btn-sm btn-primary float-right">
                                            <div v-if="submitting">
                                                <b-spinner small  type="grow" label="Loading..."></b-spinner>
                                            </div>
                                             Enregistrer
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </b-tab>
                    </b-tabs>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import CustomPagination from "../pagination/CustomPagination";
    export default {
        components: {CustomPagination},
        name: 'ShowUser',
        props:['user','user_permissions'],
        data() {
            return {
                url:this.user.Avatar != null ? this.user.Avatar : '/assets/images/user_without_avatar.svg',
                submitting:false,
                form: {
                    user_name: this.user.user_name,
                    name: this.user.name,
                    email: this.user.email,
                    phone_number: this.user.phone_number,
                    address: this.user.address,
                    comment: this.user.comment,
                    old_password: this.user.old_password,
                    password: this.user.password,
                    password_confirm: this.user.password_confirm,
                    errors: {},
                }
            }
        },
        mounted(){
        },
        methods: {
            updatePassword: function () {
                this.submitting = true;
                let data = new FormData();

                data.append('old_password', this.form.old_password)
                data.append('password', this.form.password)
                data.append('password_confirmation', this.form.password_confirm)

                axios.post('/users/update_password', data)
                    .then((response) => {
                        console.log(response.data)
                        if(response.data ==false)
                            this.form.errors.old_password = ['Encien mot de passe, incorrect!'];//flash('Encien mot de passe, incorrect!', 'danger');
                        else{
                           flash('Le mot de passe a été modifier avec succes.', 'success'); 
                       }
                        this.submitting = false;
                    })
                    .catch((serverError) => {
                        this.form.errors = serverError.response.data.errors;
                        this.submitting = false;
                    })
            },
        }
    }
</script>
<style scoped>
    .badge-primary{
        font-size: 12px;
        font-weight: 500;
    }
</style>
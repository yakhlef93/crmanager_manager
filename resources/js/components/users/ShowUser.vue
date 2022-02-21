<template>
	<div>
		
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Profile Image</label>
                            
                            <div class="col-md-6 mr-auto">
                                <img v-if="url" :src="url" class="rounded-circle bg-primary p-1 mb-2" width="80px" height="80px">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Nom Utilisateur </label>
                            <div class="col-md-6 mr-auto">
                                <h5>{{form.name}}</h5>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Type Utilisateur </label>
                            <div class="col-md-6 mr-auto">
                                <h5>{{form.type_user}}</h5>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Statut </label>
                            <div class="col-md-6 mr-auto">
                                <h5><span v-html="badged_status[user.status]"></span></h5>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">E-mail </label>
                            <div class="col-md-6 mr-auto">
                                <h5>{{form.email}}</h5>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Téléphone </label>
                            <div class="col-md-6 mr-auto">
                                <h5>{{form.phone_number}}</h5>
                            </div>
                        </div>

                        <div class="form-group row">
                        	<label class="col-md-4 col-form-label text-md-right">Adresse</label>

                        	<div class="col-md-6 mr-auto">
                                <h5>{{form.address}}</h5>
                            </div>
	                        
                        </div>
                        <div class="form-group row">
                        	<label class="col-md-4 col-form-label text-md-right">Obsérvation</label>

                        	<div class="col-md-6 mr-auto">
                                <h5>{{form.comment}}</h5>
                            </div>
	                        
                        </div>
                         <hr class="w-50 bg-light mx-auto my-4">
	</div>
</template>
<script>
    export default {
        name: 'ShowUser',
        props:['user','badged_status'],
        data() {
            return {
                url:this.user.Avatar != null ? this.user.Avatar : '/assets/images/user_without_avatar.svg',
                form: {
                    status: this.user.status,
                    name: this.user.name,
                    type_user: this.user.type == 'admin'?'Admin': this.user.type == 'emp' ? 'Employer' : 'Chauffeur',
                    email: this.user.email,
                    phone_number: this.user.phone_number,
                    address: this.user.address,
                    store: this.user.store?this.user.store.label:'',
                    comment: this.user.comment,
                    errors: {},
                }
            }
        },
        mounted(){
        },
        methods: {
            changeRowsPerPage: function(rowsPerPage){
                this.rowsPerPage = rowsPerPage;
                this.loadContracts(1);
            },
        }
    }
</script>

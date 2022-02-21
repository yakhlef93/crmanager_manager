<template>
	<div>
        <b-overlay :show="submitting" rounded="sm">
    		<form @submit.prevent="updateUser">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Profile Image</label>
                            <div class="col-md-6 mr-auto">
                                <div class="mt-3 position-relative"><img v-if="url" :src="url" class="rounded-circle bg-primary p-1 mb-2" width="90px"><b-button class="position-absolute t-0 border-0 bg-transparent text-danger" v-if="form.avatar" @click="form.avatar = null; url='/assets/images/user_without_avatar.svg'"><i class="fas fa-times"></i></b-button></div>
                                <b-form-file
                                  v-model="form.avatar"
                                  placeholder="Choisir une image..."
                                   accept=".jpg, .png, .jpeg"
                                   @change="onImageUploaded"
                                ></b-form-file>
                                
                                <small class="text-danger" v-if="form.errors.avatar">{{form.errors.avatar[0]}}</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nom Utilisateur <span class="text-danger">*</span></label>
                            <div class="col-md-6 mr-auto">
                                <input id="name" v-model="form.name" type="text" :class="{'is-invalid':form.errors.name}" class="form-control" name="name" required autocomplete="name" @input="form.errors.name = null" autofocus>
                                <small class="text-danger" v-if="form.errors.name">{{form.errors.name[0]}}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="enter_date" class="col-md-4 col-form-label text-md-right">Date d'entrée <span class="text-danger">*</span></label>
                            <div class="col-md-6 mr-auto">
                                <input id="enter_date" v-model="form.enter_date" type="date" :class="{'is-invalid':form.errors.enter_date}" class="form-control" name="enter_date" required autocomplete="enter_date" @input="form.errors.enter_date = null" autofocus>
                                <small class="text-danger" v-if="form.errors.enter_date">{{form.errors.enter_date[0]}}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type_user" class="col-md-4 col-form-label text-md-right">Type Utilisateur <span class="text-danger">*</span></label>
                            <div class="col-md-6 mr-auto">
                                <select id="type_user" v-model="form.type_user" @change="form.errors.type_user = null" :class="{'is-invalid':form.errors.type_user}" class="form-control" autofocus>
                                        <option value="admin">Admin</option>
                                        <option value="emp">Employer</option>
                                        <option value="driver">Chouffeur</option>
                                    </select>
                                    <small class="text-danger" v-if="form.errors.type_user">{{form.errors.type_user[0]}}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail <span class="text-danger">*</span></label>
                            <div class="col-md-6 mr-auto">
                                <input id="email" v-model="form.email" type="email" :class="{'is-invalid':form.errors.email}" class="form-control" name="email" required autocomplete="email" @input="form.errors.email = null" autofocus>
                                <small class="text-danger" v-if="form.errors.email">{{form.errors.email[0]}}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">Téléphone <span class="text-danger">*</span></label>
                            <div class="col-md-6 mr-auto">
                                <input id="phone_number" v-model="form.phone_number" type="text" :class="{'is-invalid':form.errors.phone_number}" class="form-control" name="phone_number" required autocomplete="phone_number" @input="form.errors.phone_number = null" autofocus>
                                <small class="text-danger" v-if="form.errors.phone_number">{{form.errors.phone_number[0]}}</small>
                            </div>
                        </div>

                        <div class="form-group row">
                        	<label for="address" class="col-md-4 col-form-label text-md-right">Adresse</label>

                        	<div class="col-md-6 mr-auto">
                                <textarea class="form-control" :class="{'is-invalid':form.errors.address}" v-model="form.address" id="address" @input="form.errors.address = null" autocomplete="address" autofocus></textarea>
	                        <small class="text-danger" v-if="form.errors.address">{{form.errors.address[0]}}</small>
                            </div>
	                        
                        </div>
                        <div class="form-group row">
                        	<label for="comment" class="col-md-4 col-form-label text-md-right">Obsérvation</label>

                        	<div class="col-md-6 mr-auto">
                                <textarea class="form-control" :class="{'is-invalid':form.errors.comment}" v-model="form.comment" id="comment" @input="form.errors.comment = null" autocomplete="comment" autofocus></textarea>
	                        <small class="text-danger" v-if="form.errors.comment">{{form.errors.comment[0]}}</small>
                            </div>
	                        
                        </div>
                        <hr class="w-50 bg-light mx-auto my-4">
                        <div class="form-group row mb-0">
                        	<label class="col-md-4 col-form-label text-md-right"><small>Remarque: tous les champs avec <span class="text-danger">*</span> sont obligatoires!</small></label>
                            <div class="col-md-6 mr-auto">
                                <button type="submit" class="btn btn-sm btn-primary float-right">
                                    Enregistrer
                                </button>
                            </div>
                        </div>
                </form>
            </b-overlay>
	</div>
</template>
<script>
    export default {
        name: 'EditUser',
        props:['user','options_status'],
        data() {
            return {
                url:this.user.Avatar != null ? this.user.Avatar : '/assets/images/user_without_avatar.svg',
                submitting:false,
                form: {
                    status:this.user.status,
                    type_user:this.user.type,
                    avatar: this.user.Avatar != null ? this.user.Avatar : null,
                    name: this.user.name,
                    enter_date: this.user.enter_date,
                    email: this.user.email,
                    phone_number: this.user.phone_number,
                    address: this.user.address,
                    store_id: this.user.store_id?this.user.store_id:null,
                    comment: this.user.comment,
                    errors: {},
                }
            }
        },
        mounted(){
        },
        methods: {
            onImageUploaded(event) {
              var input = event.target;
                // Ensure that you have a file before attempting to read it
                if (input.files && input.files[0]) {
                    // create a new FileReader to read this image and convert to base64 format
                    var reader = new FileReader();
                    // Define a callback function to run, when FileReader finishes its job
                    reader.onload = (e) => {
                        // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
                        // Read image as base64 and set to imageData
                        this.url = e.target.result;
                    }
                    // Start the reader job - read file as a data url (base64 format)
                    reader.readAsDataURL(input.files[0]);
                }
            },
            updateUser: function () {
                this.submitting = true;
                let data = new FormData();
                if(this.form.avatar)
                    data.append('avatar', this.form.avatar)
                data.append('type', this.form.type_user)
                data.append('name', this.form.name)
                data.append('enter_date', this.form.enter_date)
                data.append('email', this.form.email)
                data.append('phone_number', this.form.phone_number)
                data.append('address', this.form.address?this.form.address:'')
                data.append('comment', this.form.comment?this.form.comment:'')

                axios.post('/users/' + this.user.id, data, {
                    params: {'_method':'PATCH'}
                })
                    .then((response) => {
                        flash('L\'utilisateur a été modifier avec succes.', 'success');
                        this.submitting = false;
                    })
                    .catch((serverError) => {
                        this.form.errors = serverError.response.data.errors;
                        this.submitting = false;
                    })
            }
        }
    }
</script>

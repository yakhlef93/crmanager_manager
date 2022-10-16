<template>
	<div>
        <b-overlay :show="submitting" rounded="sm">
		      <form @submit.prevent="updateCustomer" class="dropzone">
                        <div class="form-group row">
                                <div class="col-md-5 ml-auto">
                                    <!-- <label for="title" class="col-form-label text-md-right mr-3">Profil Image 
                                    </label>
                                    <div style="width: 110px;height: 90px;cursor: pointer;background-color: #e5e5ff; margin: 5px;display: inline-block;">
                                        <div v-if="url" class="position-relative w-100 h-100">
                                            <img :src="url" class="bg-primary" width="100%" height="100%">
                                            <b-button class="position-absolute py-1 px-2 border-0 bg-light text-danger" style="right:0px; border-radius: 0px;" @click="form.avatar=null">
                                                <i class="fas fa-times"></i>
                                            </b-button>
                                        </div>
                                        <label v-else class="position-relative w-100 h-100" for="avatar" style="cursor: pointer;">
                                            <img src="/assets/images/add.svg" class="bg-light" style="padding: 2rem" width="100%" height="100%">
                                        </label>
                                        <b-form-file
                                                id="avatar"
                                                v-model="form.avatar"
                                                class="d-none"
                                                placeholder="Choisir des images..."
                                                accept=".jpg, .png, .jpeg"
                                                @change="onAvatarUploaded"
                                                >
                                        </b-form-file>
                                    </div>
                                    <small class="text-danger" v-if="form.errors.avatar">{{form.errors.avatar[0]}}</small> -->
                                </div>
                                <div class="col-md-5 mr-auto">
                                    <label for="gender" class="col-form-label text-md-right">Genre 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select id="gender" v-model="form.gender" @change="form.errors.gender = null" :class="{'is-invalid':form.errors.gender}" class="form-control" autofocus>
                                        <option value="m">M.</option>
                                        <option value="mme">Mme.</option>
                                        <option value="mlle">Mlle.</option>
                                    </select>
                                    <small class="text-danger" v-if="form.errors.gender">{{form.errors.gender[0]}}</small>

                                    <label for="status" class="col-form-label text-md-right">Statut 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select id="status" v-model="form.status" @change="form.errors.status = null" :class="{'is-invalid':form.errors.status}" class="form-control" autofocus>
                                        <option value="enabled">Enabled</option>
                                        <option value="disabled">Disabled</option>
                                        <option value="expire_soon">Expire Soon</option>
                                    </select>
                                    <small class="text-danger" v-if="form.errors.status">{{form.errors.status[0]}}</small>
                                </div>
                        </div>
                        
                        <div class="form-group row">
                                <div class="col-md-5 ml-auto">
                                    <label for="title" class="col-form-label text-md-right">Prénom 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input id="first_name" v-model="form.first_name" type="text" :class="{'is-invalid':form.errors.first_name}" class="form-control" name="first_name" required autocomplete="first_name" @input="form.errors.first_name = null" autofocus>
                                    <small class="text-danger" v-if="form.errors.first_name">{{form.errors.first_name[0]}}</small>
                                </div>
                                <div class="col-md-5 mr-auto">
                                    <label for="description" class="col-form-label text-md-right">Nom <span class="text-danger">*</span></label>
                                    <input id="last_name" v-model="form.last_name" type="text" :class="{'is-invalid':form.errors.last_name}" class="form-control" name="last_name" required autocomplete="last_name" @input="form.errors.last_name = null" autofocus>
                                    <small class="text-danger" v-if="form.errors.last_name">{{form.errors.last_name[0]}}</small>
                                </div>
                        </div>
                        <div class="form-group row">
                                <div class="col-md-5 ml-auto">
                                    <label for="title" class="col-form-label text-md-right">Téléphone 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input id="phone_number" v-model="form.phone_number" type="text" :class="{'is-invalid':form.errors.phone_number}" class="form-control" name="phone_number" required autocomplete="phone_number" @input="form.errors.phone_number = null" autofocus>
                                    <small class="text-danger" v-if="form.errors.phone_number">{{form.errors.phone_number[0]}}</small>
                                </div>
                                <div class="col-md-5 mr-auto">
                                    <label for="description" class="col-form-label text-md-right">E-mail</label>
                                    <input id="email" v-model="form.email" type="email" :class="{'is-invalid':form.errors.email}" class="form-control" name="email" autocomplete="email" @input="form.errors.email = null" autofocus>
                                <small class="text-danger" v-if="form.errors.email">{{form.errors.email[0]}}</small>
                                </div>
                        </div>
                        <div class="form-group row">
                                <div class="col-md-5 mr-auto">
                                    <label for="description" class="col-form-label text-md-right">Ville <span class="text-danger">*</span></label>
                                    <input id="city" v-model="form.city" type="text" :class="{'is-invalid':form.errors.city}" class="form-control" name="city" required autocomplete="city" @input="form.errors.city = null" autofocus>
                                <small class="text-danger" v-if="form.errors.city">{{form.errors.city[0]}}</small>
                                </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-5 ml-auto">
                                <label for="title" class="col-form-label text-md-right">Adresse
                                </label>
                                <textarea class="form-control" :class="{'is-invalid':form.errors.address}" v-model="form.address" id="address" @input="form.errors.address = null" autocomplete="address" autofocus></textarea>
	                            <small class="text-danger" v-if="form.errors.address">{{form.errors.address[0]}}</small>
                            </div>
                        </div>

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
        name: 'EditCustomer',
        props: ['customer','options_status'],
        data() {
            return {
                // url:this.customer.Avatar,
                submitting:false,
                form: {
                	status:this.customer.status,
                    // avatar: null,
                    first_name:this.customer.first_name,
                    last_name:this.customer.last_name,
                    gender:this.customer.gender,
                    email:this.customer.email,
                    phone_number:this.customer.phone_number,
                    city:this.customer.city,
                    address:this.customer.address,
                    errors: {},
                }
            }
        },
        mounted(){            
        },
        methods: {
            updateCustomer: function () {
                this.submitting=true;
                let data = new FormData();

                data.append('avatar', this.form.avatar)
                data.append('status', this.form.status)
                data.append('first_name', this.form.first_name)
                data.append('last_name', this.form.last_name)
                data.append('gender', this.form.gender)
                data.append('birthdate', this.form.birthdate)
                data.append('email', this.form.email? this.form.email : '')
                data.append('phone_number', this.form.phone_number)
                data.append('code_postal', this.form.code_postal)
                data.append('city', this.form.city)
                data.append('address', this.form.address? this.form.address : '')
                data.append('comment', this.form.comment? this.form.comment : '')
                data.append('cin_number', this.form.cin_number)
                data.append('cin_expiry_date', this.form.cin_expiry_date)
                data.append('drive_licence_number', this.form.drive_licence_number)
                data.append('drive_licence_expiry_date', this.form.drive_licence_expiry_date)
                data.append('type', this.form.type)
                if(this.form.type == 'enterprise')
                    data.append('tier_id', this.form.tier_id)

                axios.post('/customers/'+this.customer.id, data, {
                    params: {'_method':'PATCH'}
                })
                    .then((response) => {
                        this.submitting=false;
                        flash('Le client a été ajouter avec succes.', 'success');
                    })
                    .catch((serverError) => {
                        flash('certains champs comportent des erreurs, veuillez vérifier les données que vous entrez!', 'danger');
                        this.form.errors = serverError.response.data.errors;
                        this.submitting=false;
                    })
            },

            // onAvatarUploaded(event) {
            //   var input = event.target;
            //     // Ensure that you have a file before attempting to read it
            //     if (input.files && input.files[0]) {
            //         // create a new FileReader to read this image and convert to base64 format
            //         var reader = new FileReader();
            //         // Define a callback function to run, when FileReader finishes its job
            //         reader.onload = (e) => {
            //             // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
            //             // Read image as base64 and set to imageData
            //             this.url = e.target.result;
            //         }
            //         // Start the reader job - read file as a data url (base64 format)
            //         reader.readAsDataURL(input.files[0]);
            //     }
            // },
        }
    }
</script>

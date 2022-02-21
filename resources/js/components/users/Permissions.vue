<template>
    <div>
        <div class="row">
            <div class="col-md-7">
                <b-table
                    :items="permissions"
                    :fields="fields"
                    :busy="isBusy"
                    class="mt-3"
                    responsive="true"
                    striped
                    borderless
                    hover
                >

                   <template v-slot:cell(actions)="row">

                        <b-link @click="edit(row.item)" class="btn btn-sm text-primary"  v-b-tooltip.hover title="Eidter"><i class="fas fa-pen"></i></b-link>

                        <b-button class="btn btn-sm bg-transparent border-0 text-danger" @click="showConfirmation(row.item.id)" v-b-tooltip.hover title="Supprimer">
                            <i class="fas fa-times"></i>
                        </b-button>
                    </template>
                    <template v-slot:table-busy>
                        <div class="text-center text-dark my-2">
                            <b-spinner class="align-middle"></b-spinner>
                            <strong>Loading...</strong>
                        </div>
                    </template>
                </b-table>
                <b-modal ref="delete-modal" hide-footer title="Confirmation">
                    <div class="d-block text-left mt-2">
                        <h4 style="font-size: 1.3rem;">Are you sure to delete this Permission?</h4>
                    </div>
                    <b-button class="btn-model btn btn-danger" block @click="deletePermission">Yes</b-button>
                    <b-button class="btn-model btn" variant="outline-info" block @click="hideModal">No</b-button>
                </b-modal>
            </div>
            <div class="col-md-5">
                <label class="mt-3"><strong>{{ selectedToEdit ? 'Edit Permission' : 'Add Permission' }}</strong></label>
                <input v-model="form.name" type="text" @input="form.errors.name = null" class="form-control mt-2"
                       placeholder="Permission name">
                <small class="text-danger" v-if="form.errors.name">{{ form.errors.name[0] }}</small>
                <div class="w-100 text-right">
                    <button @click="savePermission()" class="btn btn-primary mt-3">Save</button>
                    <button v-if="selectedToEdit" @click="selectedToEdit=null; form.name=''" class="btn btn-light mt-3">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "Permissions",
    data() {
        return {
            permissions: [],
            fields: [
                {
                    key: 'id',
                    label: 'ID',
                    sortable: true
                },
                {
                    key: 'name',
                    label: 'Name',
                    sortable: true
                },
                {
                    key: 'guard_name',
                    label: 'Guard Name',
                    sortable: true
                },
                {
                    key: 'actions',
                    label: 'Actions',
                }
            ],
            isBusy: false,
            selectedToEdit: null,
            selectedIdToDelete:-1,
            form: {
                name: '',
                errors: {},
            },
        }
    },
    methods: {

        toggleBusy() {
            this.isBusy = !this.isBusy
        },
        loadPermissions: function () {
            this.toggleBusy();
            axios.get('/permissions')
                .then((response) => {
                    this.permissions = response.data;
                    this.toggleBusy();
                })
                .catch((serverError) => {
                    console.log(serverError);
                })
        },

        showConfirmation(permission_id) {
            this.selectedIdToDelete = permission_id;
            this.$refs['delete-modal'].show()
        },
        edit(permission) {
            this.selectedToEdit = permission.id;
            this.form.name = permission.name;
        },
        hideModal() {
            this.$refs['delete-modal'].hide()
        },
        deletePermission() {
            axios.delete('/permissions/' + this.selectedIdToDelete+'/destroy')
                .then((response) => {
                    if(response.data === 1){
                        flash('The permission has been deleted.', 'success');
                        this.loadPermissions();
                    }
                    else if(response.data === 0){
                        flash('You can\'t delete this permission cause it\'s affected to some users.', 'danger');
                    }
                    this.hideModal();
                    this.selectedToEdit = null;
                    this.selectedIdToDelete = -1;
                })
                .catch((serverError) => {
                    console.log(serverError);
                })
        },
        savePermission: function () {
            let data = new FormData();

            data.append('name', this.form.name)

            if (!this.selectedToEdit) {
                axios.post('/permissions/store', data)
                    .then((response) => {
                        flash('The permission has been added.', 'success');
                        this.formReset();
                        
                    })
                    .catch((serverError) => {
                        this.form.errors = serverError.response.data.errors;
                    })
            } else {
                axios.post('/permissions/' + this.selectedToEdit+'/update', data, {
                    params: {'_method': 'PATCH'}
                })
                    .then((response) => {
                        flash('The permission has been updated.', 'success');
                        this.formReset();
                    })
                    .catch((serverError) => {
                        this.form.errors = serverError.response.data.errors;
                    })
            }
            this.loadPermissions();

        },
        formReset() {
            this.form = {
                name: '',
                errors: {},
            };
        },

    },
    mounted() {
        this.loadPermissions();
    }

}
</script>


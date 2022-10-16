<template>
    <div>
        <div class="row">
                    <div class="col-md-3">
                        <v-select  
                            class="text-secondary bg-white"
                            v-model="selected_options.customers_ids" 
                            :options="select_customers" 
                            :reduce="label => label.id" 
                            label="FullName"
                            multiple
                            placeholder="Par clients"
                            >
                            
                        </v-select>
                    </div>
                    <div class="col-md-3">
                        <v-select  
                            class="text-secondary bg-white"
                            v-model="selected_options.status" 
                            :options="options_status" 
                            :reduce="label => label.value" 
                            label="label"
                            multiple 
                            placeholder="Par statut"
                            >
                            
                        </v-select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-sm btn-outline-secondary" @click="loadCustomers"><i class="fas fa-filter"></i> Filtrer</button>
                    </div>
                </div>
        <div class="table-responsive">
            <b-table
            :items="customers"
            :fields="fields"
            :busy="isBusy"
            class="mt-3"
            responsive="true"
            striped
            borderless
            hover
            >
                <template v-slot:cell(status)="row">
                    <span v-html="badged_status[row.item.status]"></span>
                </template>
                <template v-slot:cell(id)="row">
                    {{row.index+1}}
                </template>
                <!-- <template v-slot:cell(Avatar)="row">
                    <img :src="row.item.Avatar ? row.item.Avatar : '/assets/images/user_without_avatar.svg'" :class="row.item.Avatar ? '' : 'p-2 bg-primary'" width="50" height="50" class="rounded-circle">
                </template> -->
                <template v-slot:cell(actions)="row">
                    <b-button v-if="row.item.status == 'enabled' || row.item.status == 'expire_soon'" class="btn btn-sm bg-transparent border-0 text-danger" @click="disable(row.item.id)" v-b-tooltip.hover title="Disable">
                        <i class="fas fa-user-slash"></i>
                    </b-button>
                    <b-button v-else class="btn btn-sm bg-transparent border-0 text-success" @click="enable(row.item.id)" v-b-tooltip.hover title="Enable">
                        <i class="fas fa-user-check"></i>
                    </b-button>

                    <b-link  :href="'/customers/'+ row.item.id" class="btn btn-sm text-info" v-b-tooltip.hover title="Voir"><i class="fas fa-eye"></i></b-link>

                    <b-link :href="'/customers/'+ row.item.id + '/edit'" class="btn btn-sm text-primary"  v-b-tooltip.hover title="Eidter"><i class="fas fa-pen"></i></b-link>

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
        </div>
        


        <custom-pagination
            :_dataset="dataset"
            @changeRowsPerPage="changeRowsPerPage($event)"
            @paginationChangePage="loadCustomers($event)"
        />

        <b-modal ref="delete-modal" hide-footer title="Confirmation">
            <div class="d-block text-left mt-2">
                <h4 style="font-size: 1.1rem;">Voulez-vous vraiment supprimer ce client?</h4>
                <span class="text-danger"><b>Remarque:</b> Tout les contrats de ce client sera supprimer!</span>
            </div>
            <b-button class="btn-model btn btn-sm float-right" variant="outline-info" block @click="hideModal">No</b-button>            
            <b-button class="btn-model btn btn-sm btn-danger float-right mr-2" block @click="deleteCustomer">Yes</b-button>

        </b-modal>
    </div>
</template>

<script>


import CustomPagination from "../pagination/CustomPagination";

export default {
    components: {CustomPagination},
    name: "Customers",
    props:['badged_status','options_status'],
    data() {
        return {
            customerToDelete: null,
            rowsPerPage:10,
            customers: [],
            select_customers: [],
            dataset: null,
            selected_options:{
                customers_ids:null,
                status:null,
            },
            fields: [
                {
                    key: 'id',
                    label: '#',
                    sortable: true
                },
                //  {
                //     key: 'Avatar',
                //     label: 'Avatar',
                // }, 
                {
                    key: 'last_name',
                    label: 'Nom',
                    sortable: true
                }, {
                    key: 'first_name',
                    label: 'Prénom',
                    sortable: true
                }, {
                    key: 'phone_number',
                    label: 'Téléphone',
                    sortable: true
                },{
                    key: 'company_name',
                    label: 'Company',
                    sortable: true
                },{
                    key: 'ice',
                    label: 'ICE',
                    sortable: true
                },{
                    key: 'city',
                    label: 'City',
                    sortable: true
                },{
                    key: 'global_black_list',
                    label: 'G.B.L',
                    sortable: true
                }, {
                    key: 'status',
                    label: 'Statut',
                    sortable: true
                },{
                    key: 'actions',
                    label: 'Actions',
                },
            ],
            isBusy: false,
        }
    },
    mounted() {
        this.loadCustomers();
    },
    methods: {
        changeRowsPerPage: function(rowsPerPage){
            this.rowsPerPage = rowsPerPage;
            this.loadCustomers(1);
        },
        toggleBusy() {
            this.isBusy = !this.isBusy
        },
        enable(id) {
            let data = new FormData();

            data.append('status', 'enabled')
            axios.post('/customers/'+id, data, {
                    params: {'_method':'PATCH'}
                })
                    .then((response) => {
                        flash('Le client a été ajouter avec succes.', 'success');
                        this.loadCustomers();
                    })
                    .catch((serverError) => {
                        flash('certains champs comportent des erreurs, veuillez vérifier les données que vous entrez!', 'danger');
                        this.form.errors = serverError.response.data.errors;
                    })
        },
        disable(id) {
            let data = new FormData();

            data.append('status', 'disabled')
            axios.post('/customers/'+id, data, {
                    params: {'_method':'PATCH'}
                })
                    .then((response) => {
                        flash('Le client a été ajouter avec succes.', 'success');
                        this.loadCustomers();
                    })
                    .catch((serverError) => {
                        flash('certains champs comportent des erreurs, veuillez vérifier les données que vous entrez!', 'danger');
                        this.form.errors = serverError.response.data.errors;
                    })
        },
        loadCustomers: function (page = 1) {
            this.toggleBusy();
            axios.get('/customers?page=' + page + '&per_page='+this.rowsPerPage, {
                    params: this.selected_options
                })
                .then((response) => {
                    this.dataset = response.data.customers;
                    this.customers = response.data.customers.data;
                    this.select_customers = response.data.filter_customers
                    this.toggleBusy();
                })
                .catch((serverError) => {
                    console.log(serverError);
                })
        },
        hideModal() {
            this.$refs['delete-modal'].hide()
            this.customerToDelete = null;
        },
        showConfirmation(customer_id) {
            this.customerToDelete = customer_id;
            this.$refs['delete-modal'].show();
        },
        deleteCustomer() {
            axios.delete('/customers/' + this.customerToDelete+'/destroy')
                .then((response) => {
                    if(response.data ==true){
                        flash('Le client a été supprimer avec succès.', 'success');
                        this.loadCustomers(this.dataset.current_page);
                    }else
                        flash(response.data, 'danger');

                    this.hideModal();
                    this.customerToDelete = null;
                })
                .catch((serverError) => {
                    console.log(serverError);
                })
        },
    }
}
</script>

<style scoped>

.btn-model {
    margin-top: 2rem;
    display: inline;
    width: 70px;
}
</style>

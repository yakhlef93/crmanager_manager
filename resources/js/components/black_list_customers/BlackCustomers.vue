<template>
    <div>
        <div class="table-responsive">
            <b-table
            :items="black_customers"
            :fields="fields"
            :busy="isBusy"
            class="mt-3"
            responsive="true"
            striped
            borderless
            hover
            >
                <template v-slot:cell(id)="row">
                    {{row.index+1}}
                </template>
                <template v-slot:cell(actions)="row">
                    <b-button class="btn btn-sm bg-transparent border-0 text-danger" @click="showConfirmation(row.item)" v-b-tooltip.hover title="Supprimer">
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
            @paginationChangePage="loadBlackCustomers($event)"
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
    name: "BlackCustomers",
    props:['badged_status','options_status'],
    data() {
        return {
            customerToDelete: null,
            rowsPerPage:10,
            black_customers: [],
            dataset: null,
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
                    key: 'name',
                    label: 'Nom',
                    sortable: true
                }, {
                    key: 'phone_number',
                    label: 'Téléphone',
                    sortable: true
                },{
                    key: 'city',
                    label: 'City',
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
        this.loadBlackCustomers();
    },
    methods: {
        changeRowsPerPage: function(rowsPerPage){
            this.rowsPerPage = rowsPerPage;
            this.loadBlackCustomers(1);
        },
        toggleBusy() {
            this.isBusy = !this.isBusy
        },
        loadBlackCustomers: function (page = 1) {
            this.toggleBusy();
            axios.get('/black_list_customers?page=' + page + '&per_page='+this.rowsPerPage)
                .then((response) => {
                    this.dataset = response.data;
                    this.black_customers = response.data.data;
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
        showConfirmation(customer) {
            this.customerToDelete = customer;
            this.$refs['delete-modal'].show();
        },
        deleteCustomer() {
            axios.delete('/api/blacklistcustomers/delete', {
                        params: {
                            'cin_number':this.customerToDelete.cin_number,
                            'customer_id':this.customerToDelete.customer_id
                        }
                    })
                .then((response) => {
                    if(response.data ==true){
                        flash('Le client a été supprimer avec succès.', 'success');
                        this.loadBlackCustomers(this.dataset.current_page);
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

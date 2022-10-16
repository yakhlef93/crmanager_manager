<template>
	<div>
        <div class="form-group row position-relative personal-info-box d-print-none">
            <!-- <label class="col-md-2 col-form-label text-md-right">Profil Image</label> -->
            
            <div class="col-md-4 text-center mt-3">
                <div style="width:80px; position:relative; margin:auto;">
                    <img v-if="url" :src="url" class="rounded-circle bg-primary p-1 mb-2" width="80px" height="80px">
                    <div class="customer-avatar-online position-absolute" :class="customer.status == 'deactivate' ? 'bg-danger' : 'bg-success'"></div>
                </div>
                <h5 class="show-h5 text-primary">{{customer.gender+' '+customer.last_name+' '+customer.first_name}}</h5>
                <div class="text-left" style="width: fit-content;margin-left:auto;margin-right:auto;">
                    <label class="d-block text-secondary"><i class="fa fa-phone-alt text-secondary"></i> {{ customer.phone_number }}</label>
                    <label class="d-block text-secondary"><i class="fas fa-envelope text-secondary"></i> {{ customer.email }}</label>
                    <label class="d-block text-secondary"><i class="fas fa-map-marker-alt text-secondary"></i> {{ customer.city }}</label>
                </div>
            </div>
            <div class="col-md-4 text-left mt-3">
                <div class="text-left" style="width: fit-content;margin-left:auto;margin-right:auto;">
                    <label class="form-label d-block text-left text-secondary">website: {{ customer.website }} </label>
                    <label class="form-label d-block text-left text-secondary">company: {{ customer.company }} </label>
                    <label class="form-label d-block text-left text-secondary">ice: {{ customer.ice }}</label>
                </div>
            </div>
            <div class="col-md-4 text-left mt-3">
                <div class="text-left" style="width: fit-content;margin-left:auto;margin-right:auto;">
                    <!-- <label class="form-label d-block text-left text-secondary">N°: {{ customer.drive_licence_number }} </label>
                    <label class="form-label d-block text-left text-secondary">Date d'expiration: {{ customer.drive_licence_expiry_date }} </label>
                    <label class="form-label d-block text-left text-secondary">Documents scannée: </label> -->
                </div>
            </div>

        </div>
        
        <div class="form-group row mb-0 d-print-none">
            <div class="table-responsive">
                <b-table
                    :items="blacklistcustomers"
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
                    @paginationChangePage="loadblacklistcustomers($event)"
                />

        </div>
	</div>
</template>
<script>
import CustomPagination from "../pagination/CustomPagination";
    export default {
    components: {CustomPagination},
        name: 'ShowCustomer',
        props: ['customer','badged_status', 'contract_badged_status'],
        data() {
            return {
                rowsPerPage:10,
                blacklistcustomers: [],
                dataset: null,
                isBusy: false,
                fields: [
                    {
                        key: 'id',
                        label: '#',
                        sortable: true
                    },
                    {
                        key: 'name',
                        label: 'name',
                        sortable: true 
                    }, {
                        key: 'gender',
                        label: 'gender',
                    }, {
                        key: 'phone_number',
                        label: 'phone_number',
                        sortable: true
                    }, {
                        key: 'city',
                        label: 'city',
                        sortable: true
                    }, {
                        key: 'comment',
                        label: 'comment',
                        sortable: true
                    },
                ]
            }
        },
        mounted(){
            this.loadblacklistcustomers();
        },
        methods: {
            
            changeRowsPerPage: function(rowsPerPage){
                this.rowsPerPage = rowsPerPage;
                this.loadblacklistcustomers(1);
            },
            toggleBusy() {
                this.isBusy = !this.isBusy
            },
            loadblacklistcustomers: function (page = 1) {
                this.toggleBusy();
                axios.get('/blacklistcustomers?page=' + page + '&per_page='+this.rowsPerPage, {
                        params: {
                            'customers_id':[this.customer.id],
                        }
                    })
                    .then((response) => {
                        this.dataset = response.data;
                        this.blacklistcustomers = response.data.data;
                        this.toggleBusy();
                    })
                    .catch((serverError) => {
                        console.log(serverError);
                    })
            },
        }
    }
</script>
<style scoped>
.sts-numbers span{
    font-size: 15px;
    padding: 10px 10px;
}
.personal-info-box label{
    font-weight: 500;
    font-size: 16px;
}
.personal-info-box .fa-download{
    font-size: 20px;
}
.customer-avatar-online {
    width: 17px;
    height: 17px;
    border-radius: 50%;
    right: 2px;
    bottom: 15px;
}
</style>
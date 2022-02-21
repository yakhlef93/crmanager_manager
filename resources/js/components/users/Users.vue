<template>
    <div>
        <div class="table-responsive">
            <b-table
            :items="users"
            :fields="fields"
            :busy="isBusy"
            class="mt-3"
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
                <template v-slot:cell(type)="row">
                    {{row.item.type=='admin'?'Admin':'Employer'}}
                </template>
                <template v-slot:cell(Avatar)="row">
                    <b-avatar badge :badge-variant="row.item.is_online ===  1 ? 'success' : 'danger'" :class="row.item.Avatar ? 'warning' : 'p-2 bg-primary'" width="45" height="45" :src="row.item.Avatar ? row.item.Avatar : '/assets/images/user_without_avatar.svg'"></b-avatar>

                </template>
                <template v-slot:cell(actions)="row">

                    <b-link  :href="'/users/'+ row.item.id" class="btn btn-sm text-info" v-b-tooltip.hover title="Voir"><i class="fas fa-eye"></i></b-link>

                    <b-link :href="'/users/'+ row.item.id + '/edit'" class="btn btn-sm text-primary"  v-b-tooltip.hover title="Eidter"><i class="fas fa-pen"></i></b-link>

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
            @paginationChangePage="loadUsers($event)"
        />

        <b-modal ref="delete-modal" hide-footer title="Confirmation">
            <div class="d-block text-left mt-2">
                <h4 style="font-size: 1.1rem;">Voulez-vous vraiment supprimer cet utilisateur?</h4>
            </div>
            <b-button class="btn-model btn btn-sm float-right" variant="outline-info" block @click="hideModal">No</b-button>            
            <b-button class="btn-model btn btn-sm btn-danger float-right mr-2" block @click="deleteUser">Yes</b-button>

        </b-modal>
    </div>
</template>

<script>


import CustomPagination from "../pagination/CustomPagination";

export default {
    components: {CustomPagination},
    name: "Users",
    props:['badged_status','options_status'],
    data() {
        return {
            userToDelete: null,
            rowsPerPage:10,
            users: [],
            dataset: null,
            fields: [
                 {
                    key: 'id',
                    label: '#',
                    sortable: true
                },
                 {
                    key: 'Avatar',
                    label: 'Avatar',
                    sortable: true
                }, {
                    key: 'name',
                    label: 'Nom Utilisateur',
                    sortable: true
                },{
                    key: 'email',
                    label: 'E-mail',
                    sortable: true
                },{
                    key: 'phone_number',
                    label: 'Téléphone',
                    sortable: true
                },{
                    key: 'status',
                    label: 'Statut',
                    sortable: true
                },{
                    key: 'type',
                    label: 'Type',
                    sortable: true
                }, {
                    key: 'actions',
                    label: 'Actions',
                },
            ],
            isBusy: false,
        }
    },
    mounted() {
        this.loadUsers();
    },
    methods: {
        changeRowsPerPage: function(rowsPerPage){
            this.rowsPerPage = rowsPerPage;
            this.loadUsers(1);
        },
        toggleBusy() {
            this.isBusy = !this.isBusy
        },
        loadUsers: function (page = 1) {
            this.toggleBusy();
            axios.get('/users?page=' + page + '&per_page='+this.rowsPerPage)
                .then((response) => {
                    this.dataset = response.data;
                    this.users = response.data.data;
                    this.toggleBusy();
                })
                .catch((serverError) => {
                    console.log(serverError);
                })
        },
        hideModal() {
            this.$refs['delete-modal'].hide()
            this.userToDelete = null;
        },
        showConfirmation(user) {
            this.userToDelete = user;
            this.$refs['delete-modal'].show();
        },
        deleteUser() {
            axios.delete('/users/' + this.userToDelete+'/destroy')
                .then((response) => {
                    flash('L\'utilisateur a été supprimer avec succes.', 'success');
                    this.hideModal();
                    this.userToDelete = null;
                    this.loadUsers(this.dataset.current_page);
                })
                .catch((serverError) => {
                    console.log(serverError);
                })
        }
    }
}
</script>

<style scoped>

.btn-model {
    margin-top: 2rem;
    display: inline;
    width: 70px;
}
.b-avatar{
    width: 3.5rem;
    height: 3.5rem;
}
</style>

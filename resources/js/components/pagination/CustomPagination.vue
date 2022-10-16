<template>
    <div class="row" v-if="_dataset">
        <div class="col-sm-12">
            <div class="d-flex align-items-center float-right">
                <div class="d-flex align-items-center mr-2">
                    <span class="mr-2">Ligne par page</span>
                    <select class="custom-select custom-select-sm" v-model="rowsPerPage" @change="$emit('changeRowsPerPage', rowsPerPage)" id="rows_per_page" style="width:60px !important;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="-1">Tout</option>
                    </select>
                </div>
                <span class="mr-2">{{_dataset.from}} - {{_dataset.to}} de {{_dataset.total}}</span>
                <pagination
                    class="mb-0"
                    :data="_dataset"
                    @pagination-change-page="$emit('paginationChangePage', $event)"
                    :limit="2"
                    size="small"
                    :show-disabled="true"
                >
                    <span slot="prev-nav">&lt; Précédent</span>
                    <span slot="next-nav">Suivant &gt;</span>
                </pagination>
            </div>
        </div>
    </div>
</template>


<script>
import pagination from "laravel-vue-pagination";
export default {
    components: {pagination},
    name: "CustomPagination",
    props: [
        '_dataset'
    ],
    data: function () {
        return {
            rowsPerPage:10,
        }
    },
    methods: {
    }
}
</script>

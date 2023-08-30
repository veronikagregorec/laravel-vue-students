<template>
   <div class="wrap">
        <el-card class="box-card">
            <h3>Students data</h3>
            <div class="btn">
                <el-button type="default" @click="create" style="width: 143px;">Add student</el-button>
            </div>

            <div>
                <el-table :data="filterTableData" style="width: 100%"
                :stripe="true">
                    <el-table-column v-for="column in tableColumn" :key="column"
                    :label="column.label"
                    :prop="column.prop"
                    :column-key="column.prop"
                    :min-width="column.minWidth"
                    :sortable="column.sortable"
                    :align="column.align"
                    :header-align="column.align"
                    :fixed="column.fixed"
                    :formatter="column.formatter">
                    </el-table-column>
                    <el-table-column align="right">
                    <template #header>
                        <el-input v-model="search" size="small" placeholder="Search" />
                    </template>
                    <template #default="scope">
                        <el-button size="small" @click="editData(scope.$index, scope.row)"
                        >Edit</el-button
                        >
                        <el-button
                        size="small"
                        type="danger"
                        @click="deleteData(scope.$index, scope.row)"
                        >Delete</el-button
                        >
                    </template>
                    </el-table-column>
                </el-table>
            </div>
             <div class="message" v-if="this.$store.state.message">{{ this.$store.state.message }}</div>
        </el-card>
      </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: 'student-table-component',

    data() {
        return {
            search:"",
            tableColumn: [
                {
                    prop: "id",
                    label: "Id",
                    minWidth: 50,
                    sortable: true,
                    hidden: false,
                    align: "center",
                    fixed: true
                    
                },
                {
                    prop: "name",
                    label: "Name",
                    minWidth: 170,
                    sortable: false,
                    hidden: false,
                    align: "center",
                    fixed: true
                },
                {
                    prop: "class",
                    label: "Class",
                    minWidth: 50,
                    sortable: false,
                    hidden: false,
                    align: "center",
                    fixed: true
                },
                {
                    prop: "section",
                    label: "Section",
                    minWidth: 50,
                    sortable: false,
                    hidden: false,
                    align: "center",
                    fixed: true
                },
                {
                    prop: "email",
                    label: "Email",
                    minWidth: 150,
                    sortable: false,
                    hidden: false,
                    align: "center",
                    fixed: true
                }
            ]
        }
    },

    computed: {
        ...mapGetters({
            filterTableData: "filterTableData"
        })
    },

    methods: {
        create() {
            window.location.href = '/add-student'
        },

        editData(index,row) {
            window.location.href = '/edit-student/'+row.id+'/edit'
        },

        // automatically refresh the page
        fetchAllData() {
            this.$store.dispatch('getStudents')
        },

        deleteData(index, row) {
            if (confirm("Are you sure you want to delete this data?")) {
                this.$store.dispatch('deleteStudent', { id: row.id })
                this.fetchAllData()
            }
        }
    },

    mounted() {
        this.$store.dispatch('getStudents', { search: this.search })
    },

    watch: {
        search: function (val) {
            this.$store.dispatch('getStudents', {search:this.search})
        }
    }
}
</script>

<style scoped>
.wrap{
  display: flex;
  justify-content: center;
  align-items: center;
}

.card-header {
  display: flex;
  justify-content: center;
  align-items: center;
}

.box-card {
  width: 1200px;
}

.message{
    text-align: center;
    margin-top: 20px;
    color: #f56c6c;
}

.btn{
  display: flex;
  justify-content: flex-end;
  border: none;
}
</style>
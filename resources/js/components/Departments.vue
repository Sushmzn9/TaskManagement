

<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h5 class="float-left text-light">Departments List</h5>
                    <div class="btn btn-success float-right mt-2" @click="createDepartment">
                        New Department
                    </div>
                    <div class="card-body">
                        <button @click="testAction" class="btn btn-success">
test
                        </button>
                        {{ test }}
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            Department
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="name">Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        v-model="departmentData.name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="director_id" class="name">Director</label>
                                                    <select name="director_id" class="form-control"
                                                        v-model="departmentData.director_id">
                                                        <option value="">Select a person</option>
                                                        <option value="1">IT Director</option>
                                                        <option value="2">HR Director</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>

                                        <button type="button" class="btn btn-success"
                                            @click="!edit ? storeDepartment() : updateDepartment()">
                                            {{ !edit ? "Store" : "Update" }}
                                        </button>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Director</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="(item, index) in Department" :key="index">
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ item.name }}</td>
                            <td>{{ item.director_id }}</td>
                            <td> <button class="btn btn-success" @click="editDepartment(item)"><i
                                        class="fa fa-edit"></i></button>
                                <button class="btn btn-danger m-1" @click="deleteDepartment(item)"> <i
                                        class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref, computed } from 'vue';
import { useStore } from "vuex"
const Department = ref({})

const store = useStore();

const edit = ref(false)

const departmentData = ref({
    id: "",
    name: "",
    director_id: "",
});

    // try {
    //     const response = await axios.get(window.url + 'api/getDepartments');
    //     Department.value = response.data;
    // } catch (error) {
    //     console.error('Error fetching departments:', error);
    // }
    


function createDepartment() {
    $('#exampleModal').modal('show')
}

function editDepartment(item) {
    $('#exampleModal').modal('show')
    edit.value = true
    departmentData.value = {
        id: item.id,
        name: item.name,
        director_id: item.director_id

    }

}

 function storeDepartment() {
    // try {
    //     console.log(DepartmentErrors.value);
    //     const response = await axios.post(window.url + 'api/storeDepartment', departmentData.value);
    //     getDepartments();
    //     $('#exampleModal').modal('hide')
    //     console.log(response);

    // } catch (error) {
    //     console.error('Error fetching departments:', error);
    // }
store.dispatch('storeDepartment', departmentData.value)

}

async function updateDepartment() {
    try {
        const response = await axios.post(window.url + 'api/updateDepartment/' + departmentData.value.id, departmentData.value);
        console.log(response);
        getDepartments();
        edit.value = false
        $('#exampleModal').modal('hide')


    } catch (error) {
        console.error('Error fetching departments:', error.message);
    }

}

async function deleteDepartment(item) {
    try {
        const response = await axios.post(window.url + 'api/deleteDepartment/' + item.id);
        console.log(response);
        getDepartments();

    } catch (error) {
        console.error('Error fetching departments:', error.message);
    }
}

function testAction(){
    store.dispatch("testAction")
}

onMounted(() => store.dispatch('getDepartments')
);
;
const test =  computed(() => store.getters.test)
const departments = computed(()=>store.getters.departments)
</script>
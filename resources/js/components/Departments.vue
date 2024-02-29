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
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name" class="name">Name</label>
                                                    <input type="text" class="form-control" name="name" v-model="departmentData.name
                                                        " />
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>

                                        <button type="button" class="btn btn-success" @click="
                                            !edit
                                                ? storeDepartment()
                                                : updateDepartment()
                                            ">
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
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in departments" :key="index">
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ item.name }}</td>
                            <td>
                                <button class="btn btn-success" @click="editDepartment(item)">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-danger m-1" @click="deleteDepartment(item)">
                                    <i class="fa fa-trash"></i>
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
import { onMounted, ref, computed } from "vue";
import { useStore } from "vuex";
const Department = ref({});

const store = useStore();

const edit = ref(false);

const departmentData = ref({
    id: "",
    name: "",
});

function createDepartment() {
    $("#exampleModal").modal("show");
}

function editDepartment(item) {
    $("#exampleModal").modal("show");
    edit.value = true;
    departmentData.value = {
        id: item.id,
        name: item.name,

    };
}

function storeDepartment() {
    store.dispatch("storeDepartment", departmentData.value);
}

async function updateDepartment() {
    store.dispatch("updateDepartment", departmentData.value);
    edit.value = false;
    $("#exampleModal").modal("hide");
}

async function deleteDepartment(item) {

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {


            store.dispatch("deleteDepartment", item);

        }
    });
}

onMounted(() => store.dispatch("getDepartments"));

const departments = computed(() => store.getters.departments);

</script>

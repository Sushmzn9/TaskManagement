<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h5 class="float-left text-light">User List</h5>
                    <button class="btn btn-success float-right mt-2" @click="createUser">
                        New User
                    </button>
                </div>
                <div class="card-body">
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fs-5" id="exampleModalLabel">
                                        Users
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    v-model="userData.name" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" name="email"
                                                    v-model="userData.email" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" name="password"
                                                    v-model="userData.password" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="department_id">Department</label>
                                                <multi-select :options="filteredDepartments
                                                    " v-model="userData.department_id
        " :searchable="true"></multi-select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="selected_role">Role</label>
                                                <!-- Assuming "multi-select" is a custom component or plugin -->
                                                <multi-select :options="filteredRoles" v-model="userData.selected_roles
                                                    " :searchable="true" mode="tags"></multi-select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="permission_categories">Permission
                                                    Categories</label>
                                                <multi-select :options="filteredPermissionCategories
                                                    " v-model="userData.selected_permission_categories
        " :searchable="true" mode="tags" @input="getFilteredPermission
        "></multi-select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="filtered_permission">Permissions</label>
                                                <multi-select :options="filteredPermission
                                                    " v-model="userData.selected_permission
        " :searchable="true" mode="tags"></multi-select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="button" class="btn btn-success" @click="
                                        !edit ? storeUser() : updateUser()
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

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in getUser" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.email }}</td>
                            <td>{{ item.department != null ? item.department.name : ".." }}</td>
                            <td>
                                <button class="btn btn-success" @click="editUser(item)">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-danger ml-1" @click="deleteUser(item)">
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
0;

const User = ref({});

const store = useStore();

const edit = ref(false);

const userData = ref({
    id: "",
    name: "",
    department_id: "",
    email: "",
    password: "",
    selected_roles: [],
    selected_permission_categories: [],
    selected_permission: [],
});
function getFilteredPermission(values) {
    store.dispatch("getFilteredPermission", { values: values }).then(() => {
        userData.value.selected_permission = [];
        filteredPermission.value.forEach((item) =>
            userData.value.selected_permission.push(item.value)
        );
    });
}

function createUser() {
    $("#exampleModal").modal("show");
}

function editUser(item) {
    $("#exampleModal").modal("show");
    edit.value = true;
    userData.value = {
        id: item.id,
        name: item.name,
        department_id: item.department_id === 0 ? "" : item.department_id.toString(),
        email: item.email,
        selected_roles: [],
        selected_permission_categories: [],
        selected_permission: []
    };

    // Populate selected roles
    item.roles.forEach(role => {
        userData.value.selected_roles.push(role.id);
    });

    // Extract unique permission categories
    const permissionArray = item.permissions.map(permission => permission.name.split('-')[0]);
    const uniqueItems = [...new Set(permissionArray)];
    userData.value.selected_permission_categories = uniqueItems;

    // Fetch filtered permissions based on unique categories
    store.dispatch('getFilteredPermission', { values: uniqueItems }).then(() => {
        // Populate selected permissions
        item.permissions.forEach(permission => {
            userData.value.selected_permission.push(permission.id);
        });
    });
}




function storeUser() {
    store.dispatch("storeUser", userData.value);
}

async function updateUser() {
    store.dispatch("updateUser", userData.value);
    edit.value = false;
    $("#exampleModal").modal("hide");
}

async function deleteUser(item) {
    store.dispatch("deleteUser", item);
}

const filteredDepartments = computed(() => store.getters.filtered_departments);
console.log(filteredDepartments);
const filteredRoles = computed(() => store.getters.filtered_roles);
const filteredPermissionCategories = computed(
    () => store.getters.filtered_permission_categories
);
const filteredPermission = computed(() => store.getters.filtered_permission);
const getUser = computed(() => store.getters.users)
console.log(getUser);

onMounted(
    () => {
        store.dispatch("getAllRoles");
        store.dispatch("getAllDepartments");
        store.dispatch("getAllPermissions");
        store.dispatch("getUser");
    }


);
</script>

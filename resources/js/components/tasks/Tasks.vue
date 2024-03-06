<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h5 class="float-left text-light">Assign List</h5>
                    <button class="btn btn-success float-right" @click="createTask">
                        New Task
                    </button>
                </div>
                <div class="card-body">
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header text-light">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        Task Details
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title" class="form-label">
                                                    Title
                                                </label>
                                                <input type="text" class="form-control" name="title"
                                                    v-model="taskData.title" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="start_date" class="form-label">
                                                    Start Date
                                                </label>
                                                <input type="date" class="form-control" name="start_date"
                                                    v-model="taskData.start_date" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="end_date" class="form-label">
                                                    End Date
                                                </label>
                                                <input type="date" class="form-control" name="end_date"
                                                    v-model="taskData.end_date" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="priority" class="form-label p-2">
                                                    Priority
                                                </label>
                                                <select class="form-select mr-2" name="priority"
                                                    v-model="taskData.priority">
                                                    <option value="Urgent">Urgent</option>
                                                    <option value="Not Urgent">Not Urgent</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="form-label">
                                            Description
                                        </label>
                                        <input type="text" class="form-control" name="description"
                                            v-model="taskData.description" />
                                    </div>
                                    <div class="form-group">
                                        <label for="assign_to" class="form-label">Assign To</label>
                                        <multi-select :options="filteredUsers" v-model="taskData.assign_to" :searchable="true" mode="tags"></multi-select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="button" class="btn btn-success"
                                        @click="edit ? updateTask() : storeTask()">
                                        {{ edit ? 'Update' : 'Create' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                <div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Title</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Priority</th>
                <th>Description</th>
                <th>Assign To</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(tas, index) in allTask" :key="index">
                
                <td>{{ tas.title }}</td>
                <td>{{ tas.start_date }}</td>
                <td>{{ tas.end_date }}</td>
                <td :class="{'table-success' : tas.priority ==='Urgent'}">{{ tas.priority }}</td>
                <td>{{ tas.description }}</td>
                <td>{{ tas.department.name}}</td>
                
                <td> <button class="btn btn-success" >
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-danger ml-1">
                                    <i class="fa fa-trash"></i>
                                </button></td>
              
            </tr>
        </tbody>
        </table>
        </div>

            </div>
                </div>
           
            </div>
        
        </div>
    </div>
</template>


<script setup>
import { onMounted, ref, computed } from 'vue'
import { useStore } from 'vuex'

const store = useStore()
const edit = ref(false)
const taskData = ref({

    title: '',
    priority: "",
    start_date: "",
    end_date: "",
    description: "",
    assign_to: [],

})

function createTask() {
    $('#exampleModal').modal('show')
}

// function editTask(item) {
//     $('#exampleModal').modal('show')
//     edit.value = true
//     taskData.value = {
//         id: '',
//     title: '',
//     priority: "",
//     start_date: "",
//     end_date: "",
//     description: "",
//     assign_to: [],
//     }
// }

function storeTask() {
    store.dispatch('storeTask', taskData.value)
}

async function updateTask() {
    store.dispatch('updateTask', taskData.value)
    edit.value = false
    $('#exampleModal').modal('hide')
}

// async function deleteTask(item) {
//     Swal.fire({
//         title: 'Are you sure?',
//         text: "You won't be able to revert this!",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes, delete it!',
//     }).then((result) => {
//         if (result.isConfirmed) {
//             store.dispatch('deleteTask', item)
//         }
//     }

onMounted(() => {
    store.dispatch('getAllUsers'),
    store.dispatch('getTask');
    
},
)

const filteredUsers = computed(() => {store.getters.filtered_users})
console.log(filteredUsers.value);
const allTask = computed(()=>store.getters.task)
</script>

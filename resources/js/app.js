import "./bootstrap";

// window.url = "https://task_management.test/";
window.url= "http://taskmanagement.test/"
import { createApp } from "vue";
import { store } from "./store/store";
import Multiselect from '@vueform/multiselect';
import '@vueform/multiselect/themes/default.css';
import Swal from "sweetalert2";
import Departments from "./components/Departments.vue";
 
import PermissionsCreate from "./components/permissions/PermissionsCreate.vue";
import Users from "./components/users/Users.vue"
const app = createApp({});
window.Swal = Swal
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.onmouseenter = Swal.stopTimer;
      toast.onmouseleave = Swal.resumeTimer;
    }
  });
 window.Toast = Toast;

app.component("Departments", Departments);
app.component("permission-create", PermissionsCreate);
app.component("users", Users);
app.component("multi-select", Multiselect);
app.use(store);
app.mount("#app");

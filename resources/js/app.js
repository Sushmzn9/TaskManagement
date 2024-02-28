import "./bootstrap";

window.url = "http://taskmanagement.test/";

import { createApp } from "vue";
import { store } from "./store/store";

import Departments from "./components/Departments.vue";
import PermissionsCreate from "./components/permissions/PermissionsCreate.vue";
const app = createApp({});
app.component("Departments", Departments);
app.component("permission-create", PermissionsCreate);
app.use(store);
app.mount("#app");

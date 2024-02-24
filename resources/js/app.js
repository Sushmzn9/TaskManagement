import "./bootstrap";

import { createApp } from "vue";

import Departments from "./components/Departments.vue";
const app = createApp({});
app.component("Departments", Departments);

window.url = "/task_management/";
app.mount("#app");

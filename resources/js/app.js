import "./bootstrap";

window.url = "https://task_management.test/";

import { createApp } from "vue";

import Departments from "./components/Departments.vue";
const app = createApp({});
app.component("Departments", Departments);

app.mount("#app");

import "./bootstrap";

window.url = "http://taskmanagement.test/";

import { createApp } from "vue";
import { store } from "./store/store";

import Departments from "./components/Departments.vue";
const app = createApp({});
app.component("Departments", Departments);
app.use(store);
app.mount("#app");

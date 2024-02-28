import axios from "axios";

export default {
    state: {
        departments: {},
    },
    getters: {
        departments(state) {
            return state.departments;
        },
    },
    mutations: {
        set_departments: (state, data) => {
            state.departments = data;
        },
    },
    actions: {
        getDepartments: async (context) => {
            try {
                const response = await axios.get(
                    window.url + "api/getDepartments"
                );
                context.commit("set_departments", response.data);
            } catch (error) {
                console.error("Error fetching departments:", error);
            }
        },
        storeDepartment: async (context, departmentData) => {
            const response = await axios.post(
                window.url + "api/storeDepartment",
                departmentData
            );
            context.dispatch("getDepartments");
            $("#exampleModal").modal("hide");
        },
        updateDepartment: async (context, departmentData) => {
            try {
                const response = await axios.post(
                    window.url + "api/updateDepartment/" + departmentData.id,
                    departmentData
                );
                console.log(response);
                context.dispatch("getDepartments");
            } catch (error) {
                console.error("Error fetching departments:", error.message);
            }
        },
        deleteDepartment: async (context, item) => {
            try {
                const response = await axios.post(
                    window.url + "api/deleteDepartment/" + item.id
                );
                context.dispatch("getDepartments");
            } catch (error) {
                console.error("Error fetching departments:", error.message);
            }
        },
    },
};

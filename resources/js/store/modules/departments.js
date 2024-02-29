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
            window.Toast.fire({
                icon: "success",
                title: "Department Created Successfully"
              });
            context.dispatch("getDepartments");
            $("#exampleModal").modal("hide");
        
        },
        updateDepartment: async (context, departmentData) => {
            try {
                const response = await axios.post(
                    window.url + "api/updateDepartment/" + departmentData.id,
                    departmentData
                );
                window.Toast.fire({
                    icon: "success",
                    title: "Department Updated Successfully"
                  });
                context.dispatch("getDepartments");
            } catch (error) {
                console.error("Error fetching departments:", error);
            }
        },
        deleteDepartment: async (context, item) => {
            try {
                const response = await axios.post(
                    window.url + "api/deleteDepartment/" + item.id
                );
                window.Toast.fire({
                    icon: "success",
                    title: "Department Deleted Successfully"
                  });
                context.dispatch("getDepartments");
            } catch (error) {
                console.error("Error fetching departments:", error);
            }
        },
    },
};

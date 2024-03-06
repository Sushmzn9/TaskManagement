import axios from "axios";

export default {
    state: {
        Task: {},
    },
    getters: {
        task(state) {
            console.log(state.Task);
            return state.Task;
        },
    },
    mutations: {
        set_Task: (state, data) => {
            state.Task = data;
        },
    },
    actions: {
        getTask: async (context) => {
            try {
                const response = await axios.get(
                    window.url + "api/getTask"
                );
                console.log(response.data);
                context.commit("set_Task", response.data);
            } catch (error) {
                console.error("Error fetching Task:", error);
            }
        },
        storeTask: async (context, taskData) => {
            console.log();
            const response = await axios.post(
                window.url + "api/storeTask",
                taskData
            );
            window.Toast.fire({
                icon: "success",
                title: "Task Created Successfully"
              });
            context.dispatch("getTask");
            $("#exampleModal").modal("hide");
        
        },
        updateTask: async (context, TaskData) => {
            try {
                const response = await axios.post(
                    window.url + "api/updateTask/" + TaskData.id,
                    TaskData
                );
                window.Toast.fire({
                    icon: "success",
                    title: "Task Updated Successfully"
                  });
                context.dispatch("getTask");
            } catch (error) {
                console.error("Error fetching Task:", error);
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
                context.dispatch("getTask");
            } catch (error) {
                console.error("Error fetching Tasks:", error);
            }
        },
    },
};

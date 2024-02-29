import axios from "axios";

export default {
    state: {
        users:[]
    },
    getters: {
      
        users(state){
            return state.users
        }
    },
    mutations: {
        set_departments: (state, data) => {
            state.departments = data;
        },
        set_users:(state,data) =>{
            state.users = data;
        }
    },
    actions: {
        getUser: async (context) => {
            try {
                const response = await axios.get(
                    window.url + "api/getUser"
                
                );
                console.log(response.data);
                context.commit("set_users", response.data);
            } catch (error) {
                console.error("Error fetching Users:", error);
            }
        },
        storeUser: async (context, userData) => {
       try{
        const response = await axios.post(
            window.url + "api/storeUser",
            userData
        );
        console.log(userData);
          context.dispatch("getUser");
         $("#exampleModal").modal("hide");
       } catch(error) {
        console.log(error);       }
           
        },
        updateUser: async (context, userData) => {
            try {
                const response = await axios.post(
                    window.url + "api/updateUser/" + userData.id,
                    userData
                );
                context.dispatch("getUser");
            } catch (error) {
                console.error("Error fetching :", error);
            }
        },
        deleteUser: async (context, item) => {
            try {
                const response = await axios.post(
                    window.url + "api/deleteUser/" + item.id
                );
                context.dispatch("getUser");
            } catch (error) {
                console.error("Error fetching deleteUser:", error);
            }
        },
    },
};

import axios from "axios";

export default {
    state: {
        users:[],
        userLinks:[]
    },
    getters: {
      
        users(state){
            return state.users
        },
        userLinks(state){
            return state.userLinks
        }
    },
    mutations: {
        set_departments: (state, data) => {
            state.departments = data;
        },
        set_users:(state,data) =>{
            state.users = data;

            state.userLinks=data.links

        }
    },
    actions: {
        getUser: async (context) => {
            try {
                const response = await axios.get(
                    window.url + "api/getUser"
                
                );
    
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
                console.log(userData);
                const response = await axios.post(
                    window.url + "api/postUser/" + userData.id, userData
                );
                console.log(response);
                context.dispatch("getUser");
            } catch (error) {
                console.error("Error fetching :", error.message);
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

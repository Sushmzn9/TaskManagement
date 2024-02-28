import axios from "axios";


export default {
    state:{
        departments: {}
    },
    getters:{
        departments(state){
            return state.departments
        }
    },
    mutations:{
        set_departments : (state,data) =>{
            state.departments = data
        }
    },
    actions:{
        getDepartments : async (context) =>{
            try {
                const response = await axios.get(window.url + 'api/getDepartments');
                // Department.value = response.data;
                context.commit('set_departments' , response.data)
            } catch (error) {
                console.error('Error fetching departments:', error);
            }
        },
        storeDepartment: async (context, departmentData) => {
            const response = await axios.post(window.url + 'api/storeDepartment', departmentData);
            //   getDepartments();
               $('#exampleModal').modal('hide')

        }
    },

}
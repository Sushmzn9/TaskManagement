import { createStore } from "vuex";
import departmentsModules from "./modules/departments";
import apidata from "./modules/apidata";
import user from "./modules/user";

export const store = createStore({
    strict:true,
    modules:{departmentsModules,
    apidata, user},
    state:{
        test: 0
    },
    getters:{
        test(state){
return state.test
        }
    },
    mutations:{
        TestMutation  (state) {
            console.log('mutation commied')
           console.log( state.test++);
        }
    },
    actions:{testAction : (context) => {
     context.commit('TestMutation')
    }}
})
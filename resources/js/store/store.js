import { createStore } from "vuex";
import departmentsModules from "./modules/departments";

export const store = createStore({
    strict:true,
    modules:{departmentsModules},
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
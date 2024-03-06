import axios from 'axios'

export default {
    state: {
        filtered_departments: [],
        filtered_roles: [],
        filtered_permission_categories: [],
        filtered_permission: [],
        all_permissions: [],
        filtered_users: [],
    },
    getters: {
        filtered_departments(state) {
            console.log(state.filtered_departments)
            return state.filtered_departments
        },
        filtered_roles(state) {
            return state.filtered_roles
        },

        filtered_permission_categories(state) {
            return state.filtered_permission_categories
        },

        filtered_permission(state) {
            return state.filtered_permission
        },

        filtered_users(state) {
            console.log(state.filtered_users,"5tgy")
            return state.filtered_users
        },
    },
    mutations: {
        set_all_Departments: (state, data) => {
            state.filtered_departments = []
            data.forEach((department) =>
                state.filtered_departments.push({
                    value: department.id,
                    label: department.name,
                })
            )
        },
        set_all_roles: (state, data) => {
            state.filtered_roles = []
            data.forEach((role) =>
                state.filtered_roles.push({ value: role.id, label: role.name })
            )
        },
        set_all_permissions: (state, data) => {
            state.filtered_permission_categories = []
            state.all_permissions = data
            let itemArray = []
            data.forEach((item) => {
                let items = item.name.split('-')
                itemArray.push(items[0])
            })

            let uniqueItems = [...new Set(itemArray)]
            state.filtered_permission_categories = uniqueItems
        },
        set_filtered_permission: (state, data) => {
            state.filtered_permission = []
         
            data.values.map((value) => {
                state.all_permissions.find((element) => {
                    if (element.name.includes(value)) {
                        state.filtered_permission.push({
                            value: element.id,
                            label: element.name,
                        })
                    }
                })
            })
        },
        set_all_users: (state, data) => {
            state.filtered_users = []
            data.map((item) =>
            state.filtered_users.push({
                    value: item.id,
                    label: item.name,
                })
            )
            console.log(state.filtered_users);
        },
     

    },
    actions: {
        getAllDepartments: async (context) => {
            try {
                const response = await axios.get(
                    window.url + 'api/getAllDepartments'
                )

                context.commit('set_all_Departments', response.data)
            } catch (error) {
                console.error('Error fetching departments:', error)
            }
        },
        getAllRoles: async (context) => {
            try {
                const response = await axios.get(window.url + 'api/getAllRoles')

                context.commit('set_all_roles', response.data)
            } catch (error) {
                console.error('Error fetching roles:', error)
            }
        },
        getAllPermissions: async (context) => {
            try {
                const response = await axios.get(
                    window.url + 'api/getAllPermissions'
                )
                context.commit('set_all_permissions', response.data)
            } catch (error) {
                console.error('Error fetching permissions:', error)
            }
        },
        getFilteredPermission: async (context, data) => {
            context.commit('set_filtered_permission', data)
        },

        getAllUsers: async (context) => {
            try {
                const response = await axios.get(window.url + 'api/getAllUsers')

                context.commit('set_all_users', response.data)
            } catch (error) {
                console.error('Error fetching getAllUsers:', error)
            }
        },
    },
}

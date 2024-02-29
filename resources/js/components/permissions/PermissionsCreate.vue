<template>
    <div class="row">
        <div class="col-md-12">
            <div class="form-check-inline">
                <input
                    type="radio"
                    class="form-check-input"
                    name="permission_type"
                    id="inlineradio1"
                    v-model="permissionData.permission_type"
                    value="basic"
                />
                <label for="inlineradio1" class="form-check-label">Basic</label>
            </div>
            <div class="form-check-inline">
                <input
                    type="radio"
                    class="form-check-input"
                    name="permission_type"
                    id="inlineradio2"
                    v-model="permissionData.permission_type"
                    value="curd"
                />
                <label for="inlineradio2" class="form-check-label">CURD</label>
            </div>
        </div>
    </div>

    <div class="row" v-if="permissionData.permission_type === 'basic'">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name" class="name">Name</label>
                <input type="text" class="form-control" name="name" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="display_name" class="name">Display_Name</label>
                <input type="text" class="form-control" name="display_name" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="description" class="name">Description</label>
                <input type="text" class="form-control" name="description" />
            </div>
        </div>
    </div>

    <div class="row" v-if="permissionData.permission_type === 'curd'">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name" class="resource">Resource</label>
                <input
                    type="text"
                    class="form-control"
                    name="resource"
                    v-model="permissionData.resource"
                />
            </div>
        </div>

        <div class="col-md-8 mt-4 pt-3">
            <div class="form-check-inline">
                <input
                    type="checkbox"
                    class="form-check-input"
                    name="curdSelection[]"
                    id="inlinecheckbox1"
                    v-model="permissionData.curdSelection"
                    value="create"
                />
                <label for="inlinecheckbox1" class="form-check-label">
                    Create
                </label>
            </div>
            <div class="form-check-inline">
                <input
                    type="checkbox"
                    class="form-check-input"
                    name="curdSelection[]"
                    id="inlinecheckbox2"
                    v-model="permissionData.curdSelection"
                    value="read"
                />
                <label for="inlinecheckbox2" class="form-check-label">
                    Read
                </label>
            </div>
            <div class="form-check-inline">
                <input
                    type="checkbox"
                    class="form-check-input"
                    name="curdSelection[]"
                    id="inlinecheckbox3"
                    v-model="permissionData.curdSelection"
                    value="update"
                />
                <label for="inlinecheckbox3" class="form-check-label">
                    Update
                </label>
            </div>
            <div class="form-check-inline">
                <input
                    type="checkbox"
                    class="form-check-input"
                    name="curdSelection[]"
                    id="inlinecheckbox4"
                    v-model="permissionData.curdSelection"
                    value="delete"
                />
                <label for="inlinecheckbox4" class="form-check-label">
                    Delete
                </label>
            </div>
        </div>

        <div
            class="row"
            v-if="
                permissionData.resource.length >= 3 &&
                permissionData.curdSelection.length > 0 &&
                permissionData.permission_type === 'curd'
            "
        >
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Display Name</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(
                                            item, index
                                        ) in permissionData.curdSelection"
                                        :key="index"
                                    >
                                        <td v-text="curdName(item)"></td>
                                        <td v-text="curdDisplayName(item)"></td>
                                        <td v-text="curdDisplayName(item)"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                permissionData: {
                    resource: '',
                    permission_type: 'basic',
                    curdSelection: ['create', 'read', 'update', 'delete'],
                },
            }
        },
        methods: {
            curdName(item) {
                return (
                    this.permissionData.resource.toLowerCase() +
                    '-' +
                    item.toLowerCase()
                )
            },
            curdDisplayName(item) {
                return (
                    this.permissionData.resource.substr(0, 1).toUpperCase() +
                    this.permissionData.resource.substr(1) +
                    ' ' +
                    item.substr(0, 1).toUpperCase() +
                    item.substr(1)
                )
            },
        },
    }
</script>

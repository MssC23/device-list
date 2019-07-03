<template>
    <div>
        <button @click="loadCreateModal()" class="btn btn-primary mb-4">Add New Device</button>
        <table class="table" v-if="devices">
            <thead>
                <th>UUID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Code</th>
                <th>Status</th>
                <th>Actions</th>
                
            </thead>
            <tbody>
                <tr v-for="device, index in devices">
                    <td>{{device.uuid}}</td>
                    <td>{{device.name}}</td>
                    <td>{{device.description}}</td>
                    <td>{{device.code}}</td>
                    <td>{{device.status}}</td>
                    <td>
                        <button @click="loadUpdateModal(index)" class="btn btn-info">Edit</button>
                        <button @click="deleteDevice(index)" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Create Modal -->
        <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Device</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="uuid">UUID</label>
                        <input v-model="device.uuid" type="text" id="uuid" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input v-model="device.name" type="text" id="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea v-model="device.description" type="text" id="description" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="code">Code</label>
                        <input v-model="device.code" type="text" id="code" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="status">status</label>
                        <input v-model="device.status" type="text" id="status" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button @click="createDevice()" type="button" class="btn btn-primary">Add Device</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Update Modal -->
        <div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Device</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="uuid">UUID</label>
                        <input v-model="new_update_device.uuid" type="text" id="uuid" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input v-model="new_update_device.name" type="text" id="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea v-model="new_update_device.description" type="text" id="description" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="code">Code</label>
                        <input v-model="new_update_device.code" type="text" id="code" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="status">status</label>
                        <input v-model="new_update_device.status" type="text" id="status" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button @click="updateDevice()" type="button" class="btn btn-primary">Update Device</button>
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
                device: {
                    uuid: '',
                    name: '',
                    description: '',
                    code: '',
                    status: ''
                },
                devices: [],
                errors: [],
                new_update_device: []
            }
        },
        methods: {

            loadCreateModal() {
                $("#create-modal").modal("show");
            },

            loadUpdateModal(index) {
                this.errors = [];
                $("#update-modal").modal("show");
                this.new_update_device = this.devices[index];
            },

            loadDevices() {
                axios.get('api/devices').then(response=> {
                    this.devices = response.data.devices
                });
            },

            createDevice() {
                axios.post('api/devices', {
                    uuid: this.device.uuid,
                    name: this.device.name,
                    description: this.device.description,
                    code: this.device.code,
                    status: this.device.status
                }).then(response=> {
                    this.devices.push(response.data.devices);
                     $('#create-modal').modal('hide');
                }).catch(error => {
                    console.log(error);
                });
            },

            updateDevice() {
                axios.patch('api/devices/' + this.new_update_device.id, {
                    uuid: this.new_update_device.uuid,
                    name: this.new_update_device.name,
                    description: this.new_update_device.description,
                    code: this.new_update_device.code,
                    status: this.new_update_device.status
                }).then(response => {
                    $('#update-modal').modal('hide');
                }).catch(error => {
                    console.log(error);
                });
            },

            deleteDevice(index) {
                let confirmBox = confirm('Do you really want to delete this device?');
                if (confirmBox == true) {
                    axios.delete('api/devices/' + this.devices[index].id)
                        .then(response => {
                            this.$delete(this.devices, index);
                        }).catch(error => {
                            console.log(error);
                        });
                }
            }

            
        },
        mounted() {
            this.loadDevices();
        }
    }
</script>

<template>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Student Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" v-model="student.name">
                        </div>
                        <div class="form-group">
                            <label for="batchYear" class="col-form-label">Batch Year:</label>
                            <input type="number" class="form-control" id="batchYear" v-model="student.batch_year">
                        </div>
                        <div class="form-group">
                            <label for="joined" class="col-form-label">Joined:</label>
                            <input type="text" class="form-control" id="joined" v-model="student.joined">
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-form-label">Status:</label>
                            <select class="form-control" id="status" v-model="student.status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="saveStudent()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            student: {
                name: '',
                batch_year: '',
                joined: '',
                status: ''
            }
        }
    },
    methods: {
        saveStudent() {
            // TODO: Implement saving changes to the student's information
            // using an AJAX request to the server.
            // Once the changes are saved, you can call this.$emit('saved')
            // to signal to the parent component that the modal should be closed.
        }
    }
}
</script>
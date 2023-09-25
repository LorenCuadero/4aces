<template>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">
                        {{ __("words.EditDetails") }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frmTest" v-on:submit.prevent="handleSubmit" enctype="multipart/form-data" ref="myForm">
                    <input type="hidden" id="id" name="id" v-model="id" ref="id" />
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="first_name" class="col-sm-3 col-form-label" style="text-align: left">{{
                                __("words.FirstName") }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="first_name" ref="first_name" name="first_name"
                                    :value="first_name" :class="{ 'is-invalid': errors.first_name }" required />
                                <span class="invalid-feedback" v-if="errors.first_name">
                                    {{ errors.first_name[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-sm-3 col-form-label" style="text-align: left">{{
                                __("words.LastName") }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="last_name" name="last_name" ref="last_name"
                                    :value="last_name" :class="{ 'is-invalid': errors.last_name }" required />
                                <span class="invalid-feedback" v-if="errors.last_name">
                                    {{ errors.last_name[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="middle_name" class="col-sm-3 col-form-label" style="text-align: left">{{
                                __("words.MiddleName") }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="middle_name" ref="middle_name"
                                    :value="middle_name" name="middle_name" :class="{
                                        'is-invalid': errors.middle_name,
                                    }" required />
                                <span class="invalid-feedback" v-if="errors.middle_name">
                                    {{ errors.middle_name[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label" style="text-align: left">{{ __("words.Email")
                            }}</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email" ref="email" :value="email"
                                    :class="{ 'is-invalid': errors.email }" required />
                                <span class="invalid-feedback" v-if="Object.keys(errors).length">
                                    <span v-for="(fieldErrors, field) in errors">
                                        <span v-for="error in fieldErrors">{{
                                            error
                                        }}</span>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 col-form-label" style="text-align: left">{{ __("words.Phone")
                            }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="phone" name="phone" ref="phone" :value="phone"
                                    :class="{ 'is-invalid': errors.phone }" required />
                                <span class="invalid-feedback" v-if="errors.phone">
                                    {{ errors.phone[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="birthdate" class="col-sm-3 col-form-label" style="text-align: left">{{
                                __("words.BirthDate") }}</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="birthdate" name="birthdate" ref="birthdate"
                                    :value="birthdate" :class="{ 'is-invalid': errors.birthdate }" required />
                                <span class="invalid-feedback" v-if="errors.birthdate">
                                    {{ errors.birthdate[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="civil_status" class="col-sm-3 col-form-label" style="text-align: left">
                                {{ __("words.CivilStatus") }}
                            </label>
                            <div class="col-sm-9">
                                <select name="civil_status" class="form-control" id="civil_status" ref="civil_status"
                                    :value="civil_status" :class="{
                                        'is-invalid': errors.civil_status,
                                    }" required>
                                    <option value="single" selected>
                                        {{ __("words.Single") }}
                                    </option>
                                    <option value="married">
                                        {{ __("words.Married") }}
                                    </option>
                                    <option value="divorced">
                                        {{ __("words.Divorced") }}
                                    </option>
                                    <option value="widowed">
                                        {{ __("words.Widowed") }}
                                    </option>
                                </select>
                                <span class="invalid-feedback" v-if="errors.civil_status">
                                    {{ errors.civil_status[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label" style="text-align: left">{{
                                __("words.Address") }}</label>
                            <div class="col-sm-9">
                                <textarea name="address" class="form-control" id="address" rows="3" ref="address"
                                    :value="address" :class="{ 'is-invalid': errors.address }" required></textarea>
                                <span class="invalid-feedback" v-if="errors.address">
                                    {{ errors.address[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profile_image" class="col-sm-3 col-form-label">{{ __("words.ProfileImage")
                            }}</label>
                            <div class="col-sm-9">
                                <input v-on:change="prof_image" name="profile_image" type="file" class="form-control-file"
                                    ref="profile_image" id="profile_image"
                                    accept="image/jpeg, image/png, image/gif, image/jpg"
                                    :class="{ 'is-invalid': errors.profile_image }">
                                <span class="invalid-feedback" v-if="errors.profile_image">
                                    {{ errors.profile_image[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ __("words.SaveChanges") }}
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                {{ __("words.Close") }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            loading: false,
            errors: {},
        };
    },
    mount() {
        console.log(['the mount']);
    },
    methods: {
        prof_image(event) {
            this.profile_image = event.target.files[0];
        },
        handleSubmit() {
            app.loading.show();

            var formData = new FormData(this.$refs.myForm);
            formData.append("profile_image_b", this.$refs.profile_image);
            formData.append("_token", app.token);
            for (const pair of formData.entries()) {
                console.log(`${pair[0]}, ${pair[1]}`);
            }

            axios.post(`/person/${this.$refs.id.value}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then((response) => {
                    this.errors = {};
                    this.successMessage = response.data.message;
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                })
                .catch((error) => {
                    app.loading.hide();

                    setTimeout(() => {
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors;
                        } else {
                            this.errorMessage = error.response.data.error;
                        }
                    }, 2000);
                });
        },
    },
};
</script>
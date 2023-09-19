<template>
    <div class="modal-dialog" id="register-mdl">
        <div class="modal-content">
            <div class="modal-body">
                <form v-on:submit.prevent="register">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input
                            id="name"
                            type="text"
                            v-model="name"
                            class="form-control"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"
                            >Email Address</label
                        >
                        <input
                            id="email"
                            type="email"
                            v-model="email"
                            class="form-control"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"
                            >Password</label
                        >
                        <input
                            id="password"
                            type="password"
                            v-model="password"
                            class="form-control"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="password-confirm" class="form-label"
                            >Confirm Password</label
                        >
                        <input
                            id="password-confirm"
                            type="password"
                            v-model="passwordConfirmation"
                            class="form-control"
                            required
                        />
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            v-on:click="showModal = false"
                        >
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            showModal: false,
            name: "",
            email: "",
            password: "",
            passwordConfirmation: "",
        };
    },
    methods: {
        async register() {
            try {
                await axios.post("/register", {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.passwordConfirmation,
                });
            } catch (error) {}
        },
    },
};
</script>

<style>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background-color: #fff;
    border-radius: 0.5rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    max-width: 90vw;
    max-height: 90vh;
    overflow: auto;
}

.modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #dee2e6;
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
}

.modal-title {
    margin-bottom: 0;
    line-height: 1.5;
    font-size: 1.25rem;
    font-weight: 500;
}

.btn-close {
    padding: 0.5rem 0.75rem;
    margin: -0.5rem -0.75rem -0.5rem auto;
}
</style>

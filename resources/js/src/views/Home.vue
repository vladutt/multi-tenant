<template>
    <div>

        <div class="vx-card__title mb-4 pb-3">
            <h4 class="mb-4">Create new project</h4>
        </div>

        <div>
            <vs-input
                v-model="project.name"
                class="w-full"
                label-placeholder="Project name"
                name="name"/>

            <vs-button @click="createProject">Create project</vs-button>
        </div>

        <div class="vx-card__title mb-4 mt-10 pb-3">
            <h4 class="mb-4">Products</h4>
        </div>

        <div v-if="products.length === 0">
            <p>Fara produse momentan...</p>
        </div>
        <div v-else>
            <ul>
                <li v-for="product in products">{{ product.product_name }}</li>
            </ul>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            project: {
                name: null,
            },
            products: []
        }
    },
    methods: {
        createProject() {
            this.$http.post('/create-project', {name: this.project.name})
                .then((response) => {
                    this.products = response.data.data
                    this.$vs.notify({
                        title: 'Create project',
                        text: 'The project was created.',
                        color: 'success',
                    })
                })
                .catch((error) => {
                    this.$vs.notify({
                        title: 'Create project',
                        text: JSON.parse(JSON.stringify(error.response.data.errors.name))[0],
                        color: 'warning',
                    })
                })
        }
    }
}

</script>

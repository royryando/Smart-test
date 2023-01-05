<template>
    <Head>
        <title>Edit Kriteria - Aplikasi Smart Test</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-info">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-folder"></i> Edit Kriteria</span>
                            </div>
                            <div class="card-body">

                                <form @submit.prevent="submit">
                                    <div class="mb-3">
                                        <label class="fw-bold">Deskripsi</label>
                                        <input class="form-control" v-model="form.deskripsi" :class="{ 'is-invalid': errors.deskripsi }" type="float" placeholder="Rentang Awal">
                                    </div>
                                    <div v-if="errors.deskripsi" class="alert alert-danger">
                                        {{ errors.deskripsi }}
                                    </div>
                                    <div class="mb-3">
                                        <label class="fw-bold">Bobot</label>
                                        <input class="form-control" v-model="form.bobot" :class="{ 'is-invalid': errors.bobot }" type="float" placeholder="Rentang Akhir">
                                    </div>
                                    <div v-if="errors.bobot" class="alert alert-danger">
                                        {{ errors.bobot }}
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-info shadow-sm rounded-sm" type="submit">UPDATE</button>
                                            <button class="btn btn-warning shadow-sm rounded-sm ms-3" type="reset">RESET</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    //import layout App
    import LayoutApp from '../../../Layouts/App.vue';

    //import Heade and Link from Inertia
    import { Head, Link } from '@inertiajs/inertia-vue3';

    //import reactive from vue
    import { reactive } from 'vue';

    //import inertia adapter
    import { Inertia } from '@inertiajs/inertia';

    //import sweet alert2
    import Swal from 'sweetalert2';

    export default {
        //layout
        layout: LayoutApp,

        //register components
        components: {
            Head,
            Link
        },

        //props
        props: {
            errors : Object,
            category: Object
        },

        //composition API
        setup(props) {

            //define form with reactive
            const form = reactive({
                deskripsi: props.category.deskripsi,
                bobot: props.category.bobot
            });

            //method "submit"
            const submit = () => {

                //send data to server
                Inertia.post(`/apps/categories/${props.category.id}`, {
                    //data
                    _method: 'PUT',
                    deskripsi: form.deskripsi,
                    bobot: form.bobot

                }, {
                    onSuccess: () => {
                        //show success alert
                        Swal.fire({
                            title: 'Success!',
                            text: 'Kriteria updated successfully.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                });
                console.log(form.kelengkapan_administrasi);

            }
            return {
                form,
                submit,
            };

        }
    }
</script>

<style>

</style>
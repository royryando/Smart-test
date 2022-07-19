<template>
    <Head>
        <title>Edit Kriteria - Aplikasi Smart Test</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-folder"></i> Edit Kriteria</span>
                            </div>
                            <div class="card-body">

                                <form @submit.prevent="submit">
                                    <div class="mb-3">
                                        <label class="fw-bold">Rentang Awal</label>
                                        <input class="form-control" v-model="form.rentang_awal" :class="{ 'is-invalid': errors.rentang_awal }" type="float" placeholder="Rentang Awal">
                                    </div>
                                    <div v-if="errors.rentang_awal" class="alert alert-danger">
                                        {{ errors.rentang_awal }}
                                    </div>
                                    <div class="mb-3">
                                        <label class="fw-bold">Rentang Akhir</label>
                                        <input class="form-control" v-model="form.rentang_akhir" :class="{ 'is-invalid': errors.rentang_akhir }" type="float" placeholder="Rentang Akhir">
                                    </div>
                                    <div v-if="errors.rentang_akhir" class="alert alert-danger">
                                        {{ errors.rentang_akhir }}
                                    </div>
                                    <div class="mb-3">
                                        <label class="fw-bold">Kategori</label>
                                        <input class="form-control" v-model="form.kategori" :class="{ 'is-invalid': errors.kategori }" type="text" placeholder="Kategori">
                                    </div>
                                    <div v-if="errors.kategori" class="alert alert-danger">
                                        {{ errors.kategori }}
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-primary shadow-sm rounded-sm" type="submit">UPDATE</button>
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
                rentang_awal: props.category.rentang_awal,
                rentang_akhir: props.category.rentang_akhir,
                kategori: props.category.kategori
            });

            //method "submit"
            const submit = () => {

                //send data to server
                Inertia.post(`/apps/categories/${props.category.id}`, {
                    //data
                    _method: 'PUT',
                    rentang_awal: form.rentang_awal,
                    rentang_akhir: form.rentang_akhir,
                    kategori: form.kategori

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
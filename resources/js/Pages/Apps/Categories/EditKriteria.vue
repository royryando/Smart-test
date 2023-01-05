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
                                        <label class="fw-bold">Keterangan</label>
                                        <input class="form-control" v-model="form.keterangan" :class="{ 'is-invalid': errors.keterangan }" type="text" placeholder="Keterangan">
                                    </div>
                                    <div v-if="errors.keterangan" class="alert alert-danger">
                                        {{ errors.keterangan }}
                                    </div>
                                    <div class="mb-3">
                                        <label class="fw-bold">Nilai Awal</label>
                                        <input class="form-control" v-model="form.nilai_awal" :class="{ 'is-invalid': errors.nilai_awal }" type="float" placeholder="Nilai Awal">
                                    </div>
                                    <div v-if="errors.nilai_awal" class="alert alert-danger">
                                        {{ errors.nilai_awal }}
                                    </div>
                                    <div class="mb-3">
                                        <label class="fw-bold">Nilai Akhir</label>
                                        <input class="form-control" v-model="form.nilai_akhir" :class="{ 'is-invalid': errors.nilai_akhir }" type="float" placeholder="Nilai Akhir">
                                    </div>
                                    <div v-if="errors.nilai_akhir" class="alert alert-danger">
                                        {{ errors.nilai_akhir }}
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
            kriteria: Object
        },

        //composition API
        setup(props) {

            //define form with reactive
            const form = reactive({
                keterangan: props.kriteria.keterangan,
                nilai_awal: props.kriteria.nilai_awal,
                nilai_akhir: props.kriteria.nilai_akhir
            });

            //method "submit"
            const submit = () => {

                //send data to server
                Inertia.post(`/apps/categories/${props.kriteria.id}/putkriteria`, {
                    //data
                    _method: 'PUT',
                    keterangan: form.keterangan,
                    nilai_awal: form.nilai_awal,
                    nilai_akhir: form.nilai_akhir


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
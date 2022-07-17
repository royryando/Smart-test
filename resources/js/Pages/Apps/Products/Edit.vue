<template>
    <Head>
        <title>Edit Penilaian - Aplikasi SMART TEST</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-pencil-alt me-1"></i> Edit Nilai Peserta</span>
                            </div>
                            <div class="card-body">

                                <form @submit.prevent="submit">
                                    <!-- <div class="mb-3">
                                        <input class="form-control" @input="form.image = $event.target.files[0]" :class="{ 'is-invalid': errors.image }" type="file">
                                    </div>
                                    <div v-if="errors.image" class="alert alert-danger">
                                        {{ errors.image }}
                                    </div> -->
                                    <div class="mb-3">
                                        <label class="fw-bold">Nama Lengkap Peserta</label>
                                        <select class="form-select" :class="{ 'is-invalid': errors.customer_id }" v-model="form.customer_id">
                                            <option v-for="(customer, index) in customers" :key="index" :value="customer.id">{{ customer.name }}</option>
                                        </select>
                                    </div>
                                    <div v-if="errors.customer_id" class="alert alert-danger">
                                        {{ errors.customer_id }}
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">Kelengkapan Administrasi</label>
                                                <input class="form-control" v-model="form.kelengkapan_administrasi" :class="{ 'is-invalid': errors.kelengkapan_administrasi }" type="text" placeholder="Kelengkapan Administrasi">
                                            </div>
                                            <div v-if="errors.kelengkapan_administrasi" class="alert alert-danger">
                                                {{ errors.kelengkapan_administrasi }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">Nilai Tes Fisik</label>
                                                <input class="form-control" v-model="form.tes_fisik" :class="{ 'is-invalid': errors.tes_fisik }" type="number" placeholder="Nilai Tes Fisik">
                                            </div>
                                            <div v-if="errors.tes_fisik" class="alert alert-danger">
                                                {{ errors.tes_fisik }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">Nilai Tes Matematika</label>
                                                <input class="form-control" v-model="form.tes_matematika" :class="{ 'is-invalid': errors.tes_matematika }" type="number" placeholder="Nilai Tes Matematika">
                                            </div>
                                            <div v-if="errors.tes_matematika" class="alert alert-danger">
                                                {{ errors.tes_matematika }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">Nilai Tes Bahasa</label>
                                                <input class="form-control" v-model="form.tes_bahasa" :class="{ 'is-invalid': errors.tes_bahasa }" type="number" placeholder="Nilai Tes Bahasa">
                                            </div>
                                            <div v-if="errors.tes_bahasa" class="alert alert-danger">
                                                {{ errors.tes_bahasa }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-primary shadow-sm rounded-sm" type="submit">UPDATE</button>
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
    //import layout
    import LayoutApp from '../../../Layouts/App.vue';

    //import Heade and Link from Inertia
    import { Head, Link } from '@inertiajs/inertia-vue3';
    
    //import reactive from vue
    import { reactive } from 'vue';

    //import inerita adapter
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
            errors: Object,
            customers: Array,
            product: Object
        },

        //composition API
        setup(props) {

            //define form with reactive
            const form = reactive({
                customer_id: props.product.customer_id,
                kelengkapan_administrasi: props.product.kelengkapan_administrasi,
                tes_fisik: props.product.tes_fisik,
                tes_matematika: props.product.tes_matematika,
                tes_bahasa: props.product.tes_bahasa,
            });

            //method "submit"
            const submit = () => {

                //send data to server
                Inertia.post(`/apps/products/${props.product.id}`, {
                    //data
                    _method: 'PUT',
                    // image: form.image,
                    // barcode: form.barcode,
                    customer_id: form.customer_id,
                    kelengkapan_administrasi: form.kelengkapan_administrasi,
                    tes_fisik: form.tes_fisik,
                    tes_matematika: form.tes_matematika,
                    tes_bahasa: form.tes_bahasa,
                }, {
                    onSuccess: () => {
                        //show success alert
                        Swal.fire({
                            title: 'Success!',
                            text: 'Product updated successfully.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    },
                });

            }

            return {
                form,
                submit,
            }

        }
    }
</script>

<style>

</style>
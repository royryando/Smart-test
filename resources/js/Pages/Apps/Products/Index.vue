<template>
    <Head>
        <title>Tambah Penilaian - Aplikasi SMART TEST</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-info">
                            <div class="card-header mt-4 mb-2">
                                <span class="font-weight-bold">Tambah Nilai</span>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="submit">
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
                                            <button class="btn btn-info shadow-sm rounded-sm" type="submit">SAVE</button>
                                            <button class="btn btn-warning shadow-sm rounded-sm ms-3" type="reset">RESET</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-header mt-4 mb-2">
                                <span class="font-weight-bold">Data Nilai</span>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nama Lengkap</th>
                                            <th scope="col">Kelengkapan Administrasi</th>
                                            <th scope="col">Tes Fisik</th>
                                            <th scope="col">Tes Matematika</th>
                                            <th scope="col">Tes Bahasa</th>
                                            <th scope="col" class="text-center" style="width:30%">Actions</th>
                                        </tr>   
                                    </thead>
                                    <tbody>
                                        <tr v-for="penilaian in penilaian_view" :key="penilaian.id">
                                            <td>{{ penilaian.customer.name }}</td>
                                            <td>{{ penilaian.kelengkapan_administrasi }}</td>
                                            <td>{{ penilaian.tes_fisik }}</td>
                                            <td>{{ penilaian.tes_matematika }}</td>
                                            <td>{{ penilaian.tes_bahasa }}</td>
                                            <td class="text-center">
                                                <Link :href="`/apps/products/${penilaian.id}/edit`" v-if="hasAnyPermission(['nilai.edit'])" class="btn btn-success btn-sm me-2"><i class="fa fa-pencil-alt me-1"></i> EDIT</Link>
                                                <button @click.prevent="destroy(penilaian.id)" v-if="hasAnyPermission(['nilai.delete'])" class="btn btn-danger btn-sm me-2"><i class="fa fa-trash me-1"></i> DELETE</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div v-if="penilaian_view.length != 0" class="row">
                                    <div class="col-12">
                                        <button @click.prevent="proses()" v-if="hasAnyPermission(['nilai.delete'])" class="btn btn-info btn-sm"><i class="fa fa-check"></i> PROSES</button>
                                    </div>
                                </div>
                                    
                                <Pagination :links="products.links" align="end"/>
                            </div>
                            
                            <div class="card-header mt-4 mb-2">
                                <span class="font-weight-bold">Hasil Nilai</span>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                            <tr style="background-color: #e6e6e7;">
                                                <th scope="col">Date</th>
                                                <th scope="col">Nama Peserta</th>
                                                <th scope="col">Nilai Hasil Peserta</th>
                                                <th scope="col">Kategori</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                            <tr v-for="profit in profits" :key="profit.id">
                                                <td>{{ profit.created_at }}</td>
                                                <td class="text-center">{{ profit.customer.name }}</td>
                                                <td class="text-center">{{ profit.nilai }}</td>
                                                <td class="text-center">{{ profit.kategori }}</td>
                                            </tr>
                                    </tbody>
                                </table>
                                <div v-if="profits.length" class="export text-end mb-3">
                                    <a @click.prevent="clear()" target="_blank" class="btn btn-warning btn-md border-0 shadow me-3"><i class="fa fa-trash me-1"></i> CLEAR</a>
                                    <a :href="`/apps/profits/export?start_date=${start_date}&end_date=${end_date}`" target="_blank" class="btn btn-success btn-md border-0 shadow me-3"><i class="fa fa-file-excel"></i> EXCEL</a>
                                    <a :href="`/apps/profits/pdf?start_date=${start_date}&end_date=${end_date}`" target="_blank" class="btn btn-secondary btn-md border-0 shadow"><i class="fa fa-file-pdf"></i> PDF</a>
                                </div>
                                <Pagination :links="products.links" align="end"/>
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

    //import axios
    import axios from 'axios';

    //import component barcode
    import Barcode from '../../../Components/Barcode.vue';

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
            products: Object,
            penilaian_view: Array,
            profits: Array
        },

        //composition API
        setup(props) {

            //define form with reactive
            // console.log(customers);
            const form = reactive({
                customer_id: '',
                kelengkapan_administrasi: '',
                tes_fisik: '',
                tes_matematika: '',
                tes_bahasa: ''
            });

            //method "submit"
            const submit = () => {

                //send data to server
                Inertia.post('/apps/products', {
                    //data
                    customer_id: form.customer_id,
                    kelengkapan_administrasi: form.kelengkapan_administrasi,
                    tes_fisik: form.tes_fisik,
                    tes_matematika: form.tes_matematika,
                    tes_bahasa: form.tes_bahasa
                }, {
                    onSuccess: () => {
                        //show success alert
                        Swal.fire({
                            title: 'Success!',
                            text: 'Data Nilai Berhasil Disimpan.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    },
                });

            }


            //method "destroy"
            const destroy = (id) => {

                //show confirm
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((result) => {
                    if (result.isConfirmed) {

                        //send to server
                        Inertia.delete(`/apps/products/${id}`);

                        //show alert
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Product deleted successfully.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    }
                })
            }
            const proses = () => {
                Swal.fire({
                    title: 'Apakah akan di proses hitung ?',
                    text : "Pastikan Data Nilai sudah benar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya, diproses'
                }).then((result) => {
                        if (result.isConfirmed){
                            //send to server
                            Inertia.post(`/apps/profits/proses`);
                            Swal.fire({
                                title: 'Proses!',
                                text: 'Proses hitung data berhasil.',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false,
                            });
                                
                        }                        
                    })
                    
            }
            const clear = () => {
                Swal.fire({
                    title: 'Apakah anda akan menghapus hasil proses ?',
                    text : "Penghapusan tidak bisa dikembalikan",
                    icon: 'danger',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya, diproses'
                }).then((result) => {
                        if (result.isConfirmed){
                            //send to server
                            Inertia.post(`/apps/profits/clear`);
                            Swal.fire({
                                title: 'Data Terhapus',
                                text: 'Penghapusan Data Hitung Berhasil di hapus.',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false,
                            });
                                
                        }                        
                    })
                    
            }

            return {
                form,
                submit,
                destroy,
                proses,
                clear
            }

        }
    }
</script>

<style>

</style>
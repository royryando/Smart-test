<template>
    <Head>
        <title>Penilaian - Aplikasi SMART TEST</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-pencil-alt me-1"></i> NILAI PESERTA</span>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="handleSearch">
                                    <div class="input-group mb-3">
                                        <Link href="/apps/products/create" v-if="hasAnyPermission(['nilai.create'])" class="btn btn-primary input-group-text"> <i class="fa fa-plus-circle me-2"></i> INPUT NILAI</Link>
                                        <input type="text" class="form-control" v-model="search" placeholder="search by product title...">

                                        <button class="btn btn-primary input-group-text" type="submit"> <i class="fa fa-search me-2"></i> SEARCH</button>

                                    </div>
                                </form>
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
                                                <button @click.prevent="proses(penilaian.id)" v-if="hasAnyPermission(['nilai.delete'])" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> PROSES</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>    
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

    //import component pagination
    import Pagination from '../../../Components/Pagination.vue';

    //import Heade and Link from Inertia
    import { Head, Link } from '@inertiajs/inertia-vue3';

    //import ref from vue
    import { ref } from 'vue';

        //import axios
    import axios from 'axios';
    
    //import inertia adapter
    import { Inertia } from '@inertiajs/inertia';

    //import sweet alert2
    import Swal from 'sweetalert2';

    //import component barcode
    import Barcode from '../../../Components/Barcode.vue';

    export default {
        //layout
        layout: LayoutApp,

        //register components
        components: {
            Head,
            Link,
            Pagination
            // Barcode
        },

        //props
        props: {
            products: Object,
            penilaian_view: Array,
            proses: Array
            
        },
        

        //composition API
        setup(props) {
            const proses_nilai = ref({});
            //define state search
            console.log(props.proses);
            const search = ref('' || (new URL(document.location)).searchParams.get('q'));
            //define method search
            const handleSearch = () => {
                Inertia.get('/apps/products', {
                    
                    //send params "q" with value from state "search"
                    q: search.value,
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
            const proses = (id) => {
                //send to server
                axios.post(`/apps/profits/proses/${id}`).then(response => {
                    if(response.data.success) {

                        //assign response to state "product"
                        proses_nilai.value = response.data.data;
                        console.log(proses_nilai.value);
                    } else {

                        //set state "product" to empty object
                        proses_nilai.value = {};
                    }
                });
                
                //show alert
                Swal.fire({
                    title: 'Proses!',
                    text: 'Nilai Peserta Berhasil diProses.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                });
                    
            }

            return {
                search,
                handleSearch,
                destroy,
                proses
            }
        }
    }
</script>

<style>

</style>
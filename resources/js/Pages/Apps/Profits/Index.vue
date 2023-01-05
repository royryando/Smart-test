<template>
    <Head>
        <title>Report Penilaian - Aplikasi Smart Test</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-info">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-line"></i> REPORT PENILAIAN</span>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="filter">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">START DATE</label>
                                                <input type="date" v-model="start_date" class="form-control">
                                            </div>
                                            <div v-if="errors.start_date" class="alert alert-danger">
                                                {{ errors.start_date }}
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">END DATE</label>
                                                <input type="date" v-model="end_date" class="form-control">
                                            </div>
                                            <div v-if="errors.end_date" class="alert alert-danger">
                                                {{ errors.end_date }}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-white">*</label>
                                                <button class="btn btn-md btn-info border-0 shadow w-100"><i class="fa fa-filter"></i> FILTER</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div v-if="profits.length != 0">
                                    <hr>
                                    <div class="export text-end mb-3">
                                        <a :href="`/apps/profits/export?start_date=${start_date}&end_date=${end_date}`" target="_blank" class="btn btn-success btn-md border-0 shadow me-3"><i class="fa fa-file-excel"></i> EXCEL</a>
                                        <a :href="`/apps/profits/pdf?start_date=${start_date}&end_date=${end_date}`" target="_blank" class="btn btn-secondary btn-md border-0 shadow"><i class="fa fa-file-pdf"></i> PDF</a>
                                    </div>
                                    <table class="table table-bordered">
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
                                </div>

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

    //import hook ref
    import { ref } from 'vue';

    //import inertia adapter
    import { Inertia } from '@inertiajs/inertia';

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
            profits: Array,
            customers: Array,
            products: Object,
            penilaian_view: Array
        },

        //composition API
        setup(props) {

            //define state
            const start_date = ref('' || (new URL(document.location)).searchParams.get('start_date'));
            const end_date   = ref('' || (new URL(document.location)).searchParams.get('end_date'));

            //define methods filter
            const filter = () => {

                Inertia.get('/apps/profits/filter', {
                    start_date: start_date.value,
                    end_date: end_date.value,
                });

            }

            return {
                start_date,
                end_date,
                filter,
            }

        }
    }
</script>

<style>

</style>

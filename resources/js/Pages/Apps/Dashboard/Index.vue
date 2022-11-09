<template>

    <Head>
        <title>Dashboard - Aplikasi Smart Test</title>
    </Head>

    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-12">
                        <div v-if="hasAnyPermission(['dashboard.index'])" class="card border-0 rounded-3 shadow border-top-info">
                            <div class="card-bod text-center d-inline">
                                <img src="/images/yumnaa.png" style="margin-top: 20px" class="bg-light rounded shadow-sm p-1" width="100">
                                <p style="font-size: 24px; margin-top: 10px">Welcome to LPK Yumnaa Arsy Kara</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div v-if="hasAnyPermission(['dashboard.index'])" class="card border-0 rounded-3 shadow border-top-info mb-4">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-line"></i> JUMLAH PESERTA TAHUN INI</span>
                            </div>
                            <div class="card-body">
                                <strong>{{ count_customer }}</strong> PESERTA
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div v-if="hasAnyPermission(['dashboard.index'])" class="card border-0 rounded-3 shadow border-top-info mb-4">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-line"></i> JUMLAH PESERTA LULUS</span>
                            </div>
                            <div class="card-body">
                                <strong>{{ count_lulus }}</strong> PESERTA
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div v-if="hasAnyPermission(['dashboard.index'])" class="card border-0 rounded-3 shadow border-top-info mb-4">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-line"></i> JUMLAH PESERTA TIDAK LULUS</span>
                            </div>
                            <div class="card-body">
                                <strong>{{ count_tidak_lulus }}</strong> PESERTA
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div v-if="hasAnyPermission(['dashboard.index'])" class="card border-0 rounded-3 shadow border-top-info mb-4">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-line"></i> JUMLAH PESERTA DIPERTIMBANGKAN</span>
                            </div>
                            <div class="card-body">
                                <strong>{{ count_dipertimbangkan }}</strong> PESERTA
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

    //import Heade and useForm from Inertia
    import { Head } from '@inertiajs/inertia-vue3';

    //import ref from vue
    import { ref } from 'vue';

    //chart
    import { BarChart, DoughnutChart } from 'vue-chart-3';
    import { Chart, registerables } from "chart.js";

    //register chart
    Chart.register(...registerables);

    export default {

        //layout
        layout: LayoutApp,

        // //register component
        // components: {
        //     Head,
        //     BarChart,
        //     DoughnutChart
        // },

        props: {
            //total penjualan hari ini
            count_customer: Number,
            count_lulus: Number,
            count_tidak_lulus: Number,
            count_dipertimbangkan: Number,
            //jumlah nilai
        },

        setup(props) {



            return {
                // options,
                // chartSellWeek,
                // chartBestProduct
            }

        }
    }
</script>

<style>

</style>

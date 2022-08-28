<template>

    <Head>
        <title>Dashboard - Aplikasi Smart Test</title>
    </Head>

    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">

                <div class="row">
                    <div class="col-md-8">
                        <div v-if="hasAnyPermission(['dashboard.index'])" class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><strong> SMART TEST </strong></span>
                            </div>
                            <div class="card-body">
<<<<<<< HEAD
                                <p>Selamat Datang di Aplikasi Ranti</p>
=======
                                <p>Nama Welcome to LPK Yumnaa Arsy Kara</p>
>>>>>>> 2989702dd7bf9b7c1699df6d882b46f7e615b8d0
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div v-if="hasAnyPermission(['dashboard.index'])" class="card border-0 rounded-3 shadow border-top-info mb-4">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-line"></i> JUMLAH PESERTA TAHUN INI</span>
                            </div>
                            <div class="card-body">
                                <strong>{{ count_customer }}</strong> PESERTA
                            </div>
                        </div>
                        <!-- <div v-if="hasAnyPermission(['dashboard.index'])" class="card border-0 rounded-3 shadow border-top-success">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-bar"></i> AVARAGE NILAI</span>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold">{{ avarage_nilai }}</h5>
                            </div>
                        </div> -->
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
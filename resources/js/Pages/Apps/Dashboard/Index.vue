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
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Provident accusamus velit accusantium sit neque, mollitia repudiandae laudantium quia officia quos fugiat omnis vero iure possimus nemo voluptates assumenda soluta nobis.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div v-if="hasAnyPermission(['dashboard.index'])" class="card border-0 rounded-3 shadow border-top-info mb-4">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-line"></i> JUMLAH PESERTA</span>
                            </div>
                            <div class="card-body">
                                <strong>{{ count_customer }}</strong> PESERTA
                            </div>
                        </div>

                        <div v-if="hasAnyPermission(['dashboard.index'])" class="card border-0 rounded-3 shadow border-top-success">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-bar"></i> AVARAGE NILAI</span>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold">{{ avarage_nilai }}</h5>
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

        //register component
        components: {
            Head,
            BarChart,
            DoughnutChart
        },

        props: {
            //total penjualan hari ini
            count_customer: Number,
            //jumlah nilai
            avarage_nilai: Number
        },

        setup(props) {

            //method random color
            // function randomBackgroundColor(length) {
            //     var data = [];
            //     for (var i = 0; i < length; i++) {
            //         data.push(getRandomColor());
            //     }
            //     return data;
            // }

            // //method generate random color
            // function getRandomColor() {
            //     var letters = '0123456789ABCDEF'.split('');
            //     var color = '#';
            //     for (var i = 0; i < 6; i++) {
            //         color += letters[Math.floor(Math.random() * 16)];
            //     }
            //     return color;
            // }

            //option chart
            // const options = ref({
            //     responsive: true,
            //     plugins: {
            //         legend: {
            //             display: false,
            //         },
            //         title: {
            //             display: false,
            //         },
            //     },
            //     beginZero: true
            // });

            //chart sell week
            // const chartSellWeek = {
            //     labels: props.sales_date,
            //     datasets: [{
            //         data: props.grand_total,
            //         backgroundColor: randomBackgroundColor(props.sales_date.length),
            //     }, ],
            // };

            //chart produk terlaris
            // const chartBestProduct = {
            //     labels: props.product,
            //     datasets: [{
            //         data: props.total,
            //         backgroundColor: randomBackgroundColor(5),
            //     }, ],
            // };

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
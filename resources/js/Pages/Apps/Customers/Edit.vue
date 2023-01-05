<template>
    <Head>
        <title>Edit Data Peserta - Aplikasi Smart Test</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-info">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-user-circle"></i> EDIT DATA PESERTA</span>
                            </div>
                            <div class="card-body">

                                <form @submit.prevent="submit">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">Nama Lengkap</label>
                                                <input class="form-control" v-model="form.name" :class="{ 'is-invalid': errors.name }" type="text" placeholder="Nama Lengkap">
                                            </div>
                                            <div v-if="errors.name" class="alert alert-danger">
                                                {{ errors.name }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">Tempat Tanggal Lahir</label>
                                                <input class="form-control" v-model="form.tempat_tgl_lahir" :class="{ 'is-invalid': errors.no_telp }" type="text" placeholder="Tempat, 00-00-0000">
                                            </div>
                                            <div v-if="errors.tempat_tgl_lahir" class="alert alert-danger">
                                                {{ errors.tempat_tgl_lahir }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="fw-bold">Alamat</label>
                                        <textarea class="form-control" v-model="form.alamat" :class="{ 'is-invalid': errors.alamat }" type="text" rows="4" placeholder="Alamat"></textarea>
                                    </div>
                                    <div v-if="errors.alamat" class="alert alert-danger">
                                        {{ errors.alamat }}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">Jenis Kelamin</label>
                                                <select class="form-select" :class="{ 'is-invalid': errors.jenis_kelamin }" v-model="form.jenis_kelamin">
                                                    <option value="L">Laki-laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                            <div v-if="errors.jenis_kelamin" class="alert alert-danger">
                                                {{ errors.jenis_kelamin }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">No Handphone</label>
                                                <input class="form-control" v-model="form.no_hp" :class="{ 'is-invalid': errors.no_hp }" type="text" placeholder="nomor handphone">
                                            </div>
                                            <div v-if="errors.no_hp" class="alert alert-danger">
                                                {{ errors.no_hp }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">Pendidikan</label>
                                                <select class="form-select" :class="{ 'is-invalid': errors.pendidikan }" v-model="form.pendidikan">
                                                    <option value="SD">SD</option>
                                                    <option value="SMP">SMP</option>
                                                    <option value="MTS">MTS</option>
                                                    <option value="SMA">SMA</option>
                                                    <option value="SMK">SMK</option>
                                                    <option value="MA">MA</option>
                                                    <option value="D3">D3</option>
                                                    <option value="S1">S1</option>
                                                    <option value="S2">S2</option>
                                                    <option value="S3">S3</option>
                                                </select>
                                            </div>
                                            <div v-if="errors.pendidikan" class="alert alert-danger">
                                                {{ errors.pendidikan }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">Nomor KTP</label>
                                                <input class="form-control" v-model="form.no_ktp" :class="{ 'is-invalid': errors.no_ktp }" type="text" placeholder="Nomor KTP">
                                            </div>
                                            <div v-if="errors.no_ktp" class="alert alert-danger">
                                                {{ errors.no_ktp }}
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">Asal Sekolah</label>
                                                <input class="form-control" v-model="form.asal_sekolah" :class="{ 'is-invalid': errors.asal_sekolah }" type="text" placeholder="Asal Sekolah">
                                            </div>
                                            <div v-if="errors.asal_sekolah" class="alert alert-danger">
                                                {{ errors.asal_sekolah }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-info shadow-sm rounded-sm" type="submit">UPDATE</button>
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
            customer: Object,
            errors: Object
        },

        //composition API
        setup(props) {

            //define form with reactive
            const form = reactive({
                name: props.customer.name,
                tempat_tgl_lahir: props.customer.tempat_tgl_lahir,
                alamat: props.customer.alamat,
                jenis_kelamin: props.customer.jenis_kelamin,
                no_hp: props.customer.no_hp,
                pendidikan: props.customer.pendidikan,
                no_ktp: props.customer.no_ktp,
                asal_sekolah: props.customer.asal_sekolah
            });

            //method "submit"
            const submit = () => {

                //send data to server
                Inertia.put(`/apps/customers/${props.customer.id}`, {
                    //data
                    name: form.name,
                    tempat_tgl_lahir: form.tempat_tgl_lahir,
                    alamat: form.alamat,
                    jenis_kelamin: form.jenis_kelamin,
                    no_hp: form.no_hp,
                    pendidikan: form.pendidikan,
                    no_ktp: form.no_ktp,
                    asal_sekolah: form.asal_sekolah
                }, {
                    onSuccess: () => {
                        //show success alert
                        Swal.fire({
                            title: 'Success!',
                            text: 'Customer updated successfully.',
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
            };

        }
    }
</script>

<style>

</style>
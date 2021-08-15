<template>
    <div>
        <admin-lte>
            <template #header>
                <h1 class="m-0">Customer</h1>
            </template>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <button
                                        type="button"
                                        @click="tambah"
                                        class="btn btn-primary btn-flat"
                                    >
                                        <i class="fas fa-plus mr-3"></i> Tambah
                                        customer
                                    </button>
                                </div>

                                <div class="card-body">
                                    <div id="tabel-html"></div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- modal -->
            <div class="modal fade" id="input">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Customer</h4>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div id="hidden"></div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Nama"
                                        v-model="form.nama"
                                        :class="{
                                            'is-invalid': form.errors.nama,
                                        }"
                                    />
                                    <div
                                        class="invalid-feedback mb-2"
                                        :class="{
                                            'd-block': form.errors.nama,
                                        }"
                                    >
                                        {{ form.errors.nama }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Telepon</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Telepon"
                                        v-model="form.telepon"
                                        :class="{
                                            'is-invalid': form.errors.telepon,
                                        }"
                                    />
                                    <div
                                        class="invalid-feedback mb-2"
                                        :class="{
                                            'd-block': form.errors.telepon,
                                        }"
                                    >
                                        {{ form.errors.telepon }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Alamat"
                                        v-model="form.alamat"
                                        :class="{
                                            'is-invalid': form.errors.alamat,
                                        }"
                                    />
                                    <div
                                        class="invalid-feedback mb-2"
                                        :class="{
                                            'd-block': form.errors.alamat,
                                        }"
                                    >
                                        {{ form.errors.alamat }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Email"
                                        v-model="form.email"
                                        :class="{
                                            'is-invalid': form.errors.email,
                                        }"
                                    />
                                    <div
                                        class="invalid-feedback mb-2"
                                        :class="{
                                            'd-block': form.errors.email,
                                        }"
                                    >
                                        {{ form.errors.email }}
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label>Tipe Diskon</label>
                                    <select
                                        class="custom-select"
                                        v-model="form.tipe_diskon"
                                        :class="{
                                            'is-invalid':
                                                form.errors.tipe_diskon,
                                        }"
                                    >
                                        <option
                                            class="text-mute"
                                            selected
                                            disabled
                                            value=""
                                        >
                                            Tipe diskon
                                        </option>

                                        <option>Percent</option>
                                        <option>Fix</option>
                                    </select>
                                    <div
                                        class="invalid-feedback mb-2"
                                        :class="{
                                            'd-block': form.errors.satuan,
                                        }"
                                    >
                                        {{ form.errors.satuan }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Diskon</label>
                                    <div
                                        class="input-group"
                                        v-if="form.tipe_diskon == 'Percent'"
                                    >
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                Rp
                                            </span>
                                        </div>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="form.diskon"
                                            :class="{
                                                'is-invalid':
                                                    form.errors.diskon,
                                            }"
                                            placeholder="Fix diskon"
                                        />
                                        <div
                                            class="invalid-feedback mb-2"
                                            :class="{
                                                'd-block': form.errors.diskon,
                                            }"
                                        >
                                            {{ form.errors.diskon }}
                                        </div>
                                    </div>

                                    <div
                                        class="input-group"
                                        v-if="form.tipe_diskon == 'Fix'"
                                    >
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="form.diskon"
                                            :class="{
                                                'is-invalid':
                                                    form.errors.diskon,
                                            }"
                                            placeholder="Persentase diskon"
                                        />
                                        <div class="input-group-append">
                                            <span class="input-group-text"
                                                >%</span
                                            >
                                        </div>
                                        <div
                                            class="invalid-feedback mb-2"
                                            :class="{
                                                'd-block': form.errors.diskon,
                                            }"
                                        >
                                            {{ form.errors.diskon }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label>Foto KTP</label>
                                    <div class="custom-file">
                                        <input
                                            type="file"
                                            class="custom-file-input"
                                            ref="foto_ktp"
                                            :class="{
                                                'is-invalid':
                                                    form.errors.foto_ktp,
                                            }"
                                            v-on:change="fotoChoosen"
                                        />
                                        <label
                                            class="custom-file-label"
                                            for="foto_ktp"
                                            >{{ filename }}</label
                                        >
                                    </div>
                                    <div
                                        class="invalid-feedback mb-2"
                                        :class="{
                                            'd-block': form.errors.foto_ktp,
                                        }"
                                    >
                                        {{ form.errors.foto_ktp }}
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button
                                type="button"
                                class="btn btn-default"
                                data-dismiss="modal"
                            >
                                Close
                            </button>
                            <button
                                type="button"
                                class="btn btn-primary"
                                @click="simpan"
                            >
                                <div v-if="onProgress == true">
                                    <i class="fa fa-spinner fa-spin"></i>Loading
                                </div>
                                <div v-else>Simpan</div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal komen -->

            <!-- /.modal -->
        </admin-lte>
    </div>
</template>

<script scoped>
import AdminLte from "@/Layouts/AdminLte";
import { Inertia } from "@inertiajs/inertia";

export default {
    props: ["customer"],
    components: {
        AdminLte,
    },
    data() {
        return {
            form: this.$inertia.form({
                kode: "",
                nama: "",
                telepon: "",
                alamat: "",
                email: "",
                diskon: "",
                tipe_diskon: "",
                foto_ktp: "",
            }),
            onProgress: false,
        };
    },

    methods: {
        fotoChoosen(event) {
            this.filename = event.target.files[0].name;
        },
        getTable() {
            var html = "";
            var no = 1;
            this.customer.forEach((element) => {
                html += `<tr>
                <td>${no++}</td>
                <td>${element.nama}</td>
                <td>${element.telepon}</td>
                <td>${element.alamat}</td>
                <td>${element.email}</td>
                <td>${element.diskon}</td>
                <td> ${
                    element.tipe_diskon == 0
                        ? '<span class="badge bg-primary">Percent</span>'
                        : '<span class="badge bg-danger">Fix</span>'
                }</td>
                <td> <img src="/ktp/${
                    element.foto_ktp
                }" " width="80px" alt=""></td>
               
               <td>
                <button type="button"  class="btn btn-block btn-default btn-flat edit" 
                data-id="${element.id}"  
                data-nama="${element.nama}" 
                data-telepon="${element.telepon}" 
                data-alamat="${element.alamat}" 
                data-diskon="${element.diskon}" 
                data-tipe_diskon="${element.tipe_diskon}" 
                data-email="${element.email}">Edit</button> 
              <button type="button"
                class="btn btn-block btn-danger btn-flat hapus" data-id="${
                    element.id
                }"><i class="fas fa-trash"></i></button>
                </td>
                
                `;
            });

            $("#tabel-body").html(html);
        },

        simpan() {
            if (this.$refs.foto_ktp) {
                this.form.foto_ktp = this.$refs.foto_ktp.files[0];
            }
            var self = this;
            this.onProgress = true;
            this.form.post(this.route("customer.store"), {
                preserveScroll: true,
                onSuccess: () => {
                    self.onProgress = false;
                    this.form.reset();
                    this.getTable();
                    this.renderGetId();
                    $("#input").modal("hide");
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Berhasil di simpan",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                },
                onError: (errors) => {
                    self.onProgress = false;
                },
            });
        },

        //set dom edit $ hapus
        renderGetId() {
            var self = this;
            $(".edit").click(function () {
                const id = $(this).data("id");

                self.form.kode = id;
                self.form.nama = $(this).data("nama");
                self.form.telepon = $(this).data("telepon");
                self.form.alamat = $(this).data("alamat");
                self.form.email = $(this).data("email");
                self.form.diskon = $(this).data("diskon");
                self.form.tipe_diskon = $(this).data("tipe_diskon");

                $("#input").modal("show");
            });

            $(".hapus").click(function () {
                const id = $(this).data("id");
                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: "",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f00",
                    cancelButtonText: "Batal",
                    cancelButtonColor: "#D0D0D0",
                    confirmButtonText: "Ya",
                }).then((result) => {
                    if (result.value) {
                        if (result.isConfirmed) {
                            Inertia.delete(`/customer/${id}`);
                            this.getTable();
                            this.renderGetId();
                        }
                    }
                });
            });
        },

        tambah() {
            $("#input").modal("show");
        },
    },

    mounted: function () {
        $("#tabel-html").html(` <table
                                        id="tabel"
                                        class="
                                            table table-bordered table-striped
                                        "
                                    >
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Telepon</th>
                                                <th>Email</th>
                                                <th>Alamat</th>
                                                <th>Diskon</th>
                                                <th>Tipe Diskon</th>
                                                <th>Foto</th>

                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            id="tabel-body"
                                        ></tbody>
                                    </table>`);
        this.getTable();
        this.renderGetId();
        $("#tabel").DataTable();
    },
};
</script>

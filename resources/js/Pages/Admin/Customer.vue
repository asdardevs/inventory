<template>
    <div>
        <admin-lte>
            <template #header>
                <h1 class="m-0">Product</h1>
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
                                        produk
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
                            <h4 class="modal-title">Tambah Product</h4>
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
                                    <label>Stok</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Stok"
                                        v-model="form.stok"
                                        :class="{
                                            'is-invalid': form.errors.stok,
                                        }"
                                    />
                                    <div
                                        class="invalid-feedback mb-2"
                                        :class="{
                                            'd-block': form.errors.stok,
                                        }"
                                    >
                                        {{ form.errors.stok }}
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label>Satuan</label>
                                    <select
                                        class="custom-select"
                                        v-model="form.satuan"
                                        :class="{
                                            'is-invalid': form.errors.satuan,
                                        }"
                                    >
                                        <option
                                            class="text-mute"
                                            selected
                                            disabled
                                            value=""
                                        >
                                            Satuan
                                        </option>

                                        <option>Paket</option>
                                        <option>Pcs</option>
                                        <option>Sachet</option>
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
                                    <label>Harga Satuan</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Harga satuan"
                                        v-model="form.harga_satuan"
                                        :class="{
                                            'is-invalid':
                                                form.errors.harga_satuan,
                                        }"
                                    />
                                    <div
                                        class="invalid-feedback mb-2"
                                        :class="{
                                            'd-block': form.errors.harga_satuan,
                                        }"
                                    >
                                        {{ form.errors.harga_satuan }}
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label>Foto</label>
                                    <div class="custom-file">
                                        <input
                                            type="file"
                                            class="custom-file-input"
                                            ref="foto"
                                            :class="{
                                                'is-invalid': form.errors.foto,
                                            }"
                                            v-on:change="fotoChoosen"
                                        />
                                        <label
                                            class="custom-file-label"
                                            for="foto"
                                            >{{ filename }}</label
                                        >
                                    </div>
                                    <div
                                        class="invalid-feedback mb-2"
                                        :class="{
                                            'd-block': form.errors.foto,
                                        }"
                                    >
                                        {{ form.errors.foto }}
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
    props: ["product"],
    components: {
        AdminLte,
    },
    data() {
        return {
            form: this.$inertia.form({
                nama: "",
                stok: "",
                harga_satuan: "",
                satuan: "",
                foto: "",
                kode: "",
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
            this.product.forEach((element) => {
                html += `<tr>
                <td>${no++}</td>
                <td>${element.nama}</td>
                <td>${element.stok}</td>
                <td>${element.harga_satuan}</td>
                <td>${element.satuan}</td>
                <td> <img src="/file/${
                    element.foto
                }" " width="80px" alt=""></td>
                <td>
                <button type="button"  class="btn btn-block btn-default btn-flat edit" 
                data-id="${element.id}"  
                data-nama="${element.nama}" data-stok="${element.stok}" 
                data-harga_satuan="${element.harga_satuan}" 
                data-satuan="${element.satuan}">Edit</button> 
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
            if (this.$refs.foto) {
                this.form.foto = this.$refs.foto.files[0];
            }
            var self = this;
            this.onProgress = true;
            this.form.post(this.route("product.store"), {
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
                self.form.harga_satuan = $(this).data("harga_satuan");
                self.form.satuan = $(this).data("satuan");
                self.form.nama = $(this).data("nama");
                self.form.stok = $(this).data("stok");

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
                            Inertia.delete(`/product/${id}`);
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
                                                <th>Stok</th>
                                                <th>Satuan(unit)</th>
                                                <th>Harga Satuan</th>
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

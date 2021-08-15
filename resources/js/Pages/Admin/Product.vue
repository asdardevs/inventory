<template>
    <div>
        <admin-lte>
            <template #header>
                <h1 class="m-0">Permohonan Product</h1>
            </template>
            <section class="content">
                <!-- <button class="btn btn-primary" @click="tabel">a</button> -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="tempel-tabel"></div>
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
            <div class="modal fade" id="modal-validasi">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                Validasi Permohonan Akun
                            </h4>
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
                            <div class="form-group">
                                <div class="custom-control custom-radio mb-3">
                                    <input
                                        class="custom-control-input"
                                        type="radio"
                                        id="customRadio1"
                                        name="customRadio"
                                        value="1"
                                        v-model="form.status"
                                    />
                                    <label
                                        for="customRadio1"
                                        class="custom-control-label"
                                        >Terima</label
                                    >
                                </div>
                                <div class="custom-control custom-radio">
                                    <input
                                        class="custom-control-input"
                                        type="radio"
                                        id="customRadio2"
                                        name="customRadio"
                                        value="2"
                                        v-model="form.status"
                                    />
                                    <label
                                        for="customRadio2"
                                        class="custom-control-label text-danger"
                                        >Tolak</label
                                    >
                                </div>
                                <div
                                    class="invalid-feedback mb-2"
                                    :class="{
                                        'd-block': form.errors.status,
                                    }"
                                >
                                    {{ form.errors.status }}
                                </div>
                            </div>
                            <hr />
                            <!-- form diterima -->
                            <div id="hidden"></div>

                            <form v-if="form.status == 1">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Username"
                                        v-model="form.username"
                                        :class="{
                                            'is-invalid': form.errors.username,
                                        }"
                                    />
                                    <div
                                        class="invalid-feedback mb-2"
                                        :class="{
                                            'd-block': form.errors.username,
                                        }"
                                    >
                                        {{ form.errors.username }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Password"
                                        v-model="form.password"
                                        :class="{
                                            'is-invalid': form.errors.password,
                                        }"
                                    />
                                    <div
                                        class="invalid-feedback mb-2"
                                        :class="{
                                            'd-block': form.errors.password,
                                        }"
                                    >
                                        {{ form.errors.password }}
                                    </div>
                                </div>
                            </form>

                            <!-- form ditolak -->
                            <form v-if="form.status == 2">
                                <div class="form-group">
                                    <label>Alasan penolakan</label>
                                    <textarea
                                        class="form-control"
                                        rows="3"
                                        placeholder="Deskripsi"
                                        v-model="form.alasan_penolakan"
                                    ></textarea>
                                    <div
                                        class="invalid-feedback mb-2"
                                        :class="{
                                            'd-block':
                                                form.errors.alasan_penolakan,
                                        }"
                                    >
                                        {{ form.errors.alasan_penolakan }}
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
            <div class="modal fade" id="komen">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-danger">
                                Akun ditolak
                            </h4>
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
                            <div class="card">
                                <div class="card-body">
                                    <div id="pesan-penolakan"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button
                                type="button"
                                class="btn btn-default"
                                data-dismiss="modal"
                            >
                                Close
                            </button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </admin-lte>
    </div>
</template>

<script scoped>
import AdminLte from "@/Layouts/AdminLte";

export default {
    props: ["product"],
    components: {
        AdminLte,
    },
    data() {
        return {
            form: this.$inertia.form({
                username: "",
                password: "",
                alasan_penolakan: "",
                status: "",
                id: "",
            }),
            onProgress: false,
        };
    },

    methods: {
        getTable() {
            var html = "";
            var no = 1;
            this.office.forEach((element) => {
                html += `<tr>
                <td>${no++}</td>
                <td>${element.nama}</td>
                <td>${element.email}</td>
                <td>${element.fakultas.nama_fakultas}</td>
                <td>${element.prodi.nama_jurusan}</td>
                <td><a href="/file-sk/${
                    element.file
                }"  target="_blank" class="btn btn-block btn-default btn-flat" ><i class="fas fa-file-download text-danger"></i></a></td>
                <td> ${
                    element.status == null
                        ? '<span class="badge bg-primary">Menunggu</span>'
                        : '<span class="badge bg-danger">Ditolak</span>'
                } </td>

               ${
                   element.status == 2
                       ? ` <td>
                            <div class="row">
                              <div class="col-md-8">
                                <button
                                  type="button"
                                  class="btn btn-block btn-primary btn-flat"
                                  disabled
                                >
                                  Validasi
                                </button>
                              </div>
                              <div class="col-md-4">
                                <button
                                  type="button"
                                  class="btn btn-block btn-default btn-flat komen" data-pesan="${element.pesan}"
                                >
                                  <i class="far fa-comment-dots"></i>
                                </button>
                              </div>
                            </div>
                          </td>`
                       : `<td><button type="button"  class="btn btn-block btn-primary btn-flat validasi" data-id="${element.id}" >Validasi</button> </td>`
               }

                </tr>`;
            });

            $("#tabel-body-permohonan").html(html);
        },
        simpan() {
            var self = this;
            this.onProgress = true;
            this.form.id = $("#get-id").val();
            this.form.post(this.route("permohonan.store"), {
                preserveScroll: true,
                onSuccess: () => {
                    self.onProgress = false;
                    this.form.reset();
                    this.getTable();
                    this.renderGetId();
                    this.renderPeasn();
                    $("#modal-validasi").modal("hide");
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
        renderGetId() {
            $(".validasi").click(function () {
                const id = $(this).data("id");
                $("#hidden").html(
                    `<input type="hidden" id="get-id" value="${id}" />`
                );

                $("#modal-validasi").modal("show");
            });
        },
        renderPeasn() {
            $(".komen").click(function () {
                const pesan = $(this).data("pesan");
                $("#pesan-penolakan").html(pesan);
                $("#komen").modal("show");
            });
        },
    },

    mounted: function () {
        $("#tempel-tabel").html(` <table
                                        id="tabel-permohonan"
                                        class="
                                            table table-bordered table-striped
                                        "
                                    >
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Fakultas</th>
                                                <th>Prodi</th>
                                                <th>SK TUGAS</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            id="tabel-body-permohonan"
                                        ></tbody>
                                    </table>`);
        this.getTable();
        this.renderGetId();
        this.renderPeasn();
        $("#tabel-permohonan").DataTable();
    },
};
</script>

<style scoped>
.buttonload {
    background-color: #04aa6d; /* Green background */
    border: none; /* Remove borders */
    color: white; /* White text */
    padding: 12px 16px; /* Some padding */
    font-size: 16px; /* Set a font size */
}
</style>

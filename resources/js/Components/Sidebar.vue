<template>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-4 sidebar-light-warning">
        <!-- Brand Logo -->
        <inertia-link :href="route('beranda.index')" class="brand-link">
            <img
                src="/lte/dist/img/unm1.png"
                alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3"
                style="opacity: 0.8"
            />
            <span class="brand-text font-weight-light"
                ><span class="font-weight-bold">UNM </span>| Office 365</span
            >
        </inertia-link>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img
                        src="/lte/dist/img/profil.png"
                        class="img-circle elevation-2"
                        alt="User Image"
                    />
                </div>
                <div class="info">
                    <a href="#" class="d-block">Administrator</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul
                    class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview"
                    role="menu"
                    data-accordion="false"
                >
                    <li class="nav-item">
                        <inertia-link
                            :href="route('beranda.index')"
                            class="nav-link"
                            :class="
                                route().current('beranda.*') ? 'active' : ' '
                            "
                        >
                            <i class="nav-icon fas fa-th"></i>
                            <p>Dashboard</p>
                        </inertia-link>
                    </li>
                    <li class="nav-item">
                        <inertia-link
                            :href="route('product.index')"
                            class="nav-link"
                            :class="
                                route().current('product.*') ? 'active' : ' '
                            "
                        >
                            <i class="nav-icon fas fa-file-import"></i>
                            <p>Product</p>
                        </inertia-link>
                    </li>

                    <li class="nav-item">
                        <inertia-link
                            :href="route('dashboard')"
                            class="nav-link text-danger"
                        >
                            <i class="nav-icon fas fa-power-off"></i>
                            <p>Site</p>
                        </inertia-link>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
export default {
    setup() {},
    methods: {
        logout() {
            $.ajax({
                type: "POST",
                url: "{{ url('logout') }}",
                success: function (data) {
                    location.href = "{{url('/')}}";
                },
            });
            // this.$inertia.post(route("logout"));
        },
    },
};
</script>

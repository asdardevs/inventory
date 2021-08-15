<template>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-4 sidebar-light-warning">
        <!-- Brand Logo -->
        <inertia-link :href="route('beranda.index')" class="brand-link">
            <span class="brand-text font-weight-light">Inventory</span>
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
                    <li class="nav-header text-secondary pl-3">Master</li>
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
                            :href="route('customer.index')"
                            class="nav-link"
                            :class="
                                route().current('customer.*') ? 'active' : ' '
                            "
                        >
                            <i class="nav-icon fas fa-users"></i>
                            <p>Customer</p>
                        </inertia-link>
                    </li>

                    <li class="nav-header text-secondary pl-3">
                        Transaksi penjualan
                    </li>

                    <li class="nav-item">
                        <inertia-link
                            :href="route('product.index')"
                            class="nav-link"
                            :class="
                                route().current('product.*') ? 'active' : ' '
                            "
                        >
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Transaksi</p>
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

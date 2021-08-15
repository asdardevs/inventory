<template>
    <div class="wrapper">
        <!-- navbar -->
        <NavBar />
        <!-- sidebar -->
        <SideBar />
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <slot name="header"></slot>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- headerend -->
            <!-- Main content -->
            <slot></slot>

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        <Footer />
        <!-- Main Footer -->
    </div>
</template>

<script>
import Footer from "@/Components/Footer";
import NavBar from "@/Components/Navbar";
import SideBar from "@/Components/Sidebar";
export default {
    components: {
        Footer,
        NavBar,
        SideBar,
    },

    mounted: function () {},
};
</script>

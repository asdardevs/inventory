<template>
    <footer class="main-footer">
        <strong
            >Copyright &copy; 2020-{{ tahun }}
            <a href="#">Universitas Negeri Makassar</a>.</strong
        >
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.0.5
        </div>
    </footer>
</template>

<script>
export default {
    data() {
        return {
            tahun: new Date().getFullYear(),

            // prodis:[]
        };
    },
};
</script>

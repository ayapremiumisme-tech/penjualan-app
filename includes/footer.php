    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Initialize AOS -->
    <script>
        AOS.init();
    </script>

    <!-- Custom JS -->
    <script src="<?= APP_URL; ?>/assets/js/app.js"></script>
    <script src="<?= APP_URL; ?>/assets/js/dashboard.js"></script>
    <script src="<?= APP_URL; ?>/assets/js/chart-config.js"></script>
    <script src="<?= APP_URL; ?>/assets/js/cart.js"></script>
    <script src="<?= APP_URL; ?>/assets/js/checkout.js"></script>
    <script src="<?= APP_URL; ?>/assets/js/realtime-search.js"></script>
    <script src="<?= APP_URL; ?>/assets/js/pagination.js"></script>
    <script src="<?= APP_URL; ?>/assets/js/darkmode.js"></script>
    <script src="<?= APP_URL; ?>/assets/js/validation.js"></script>
    <script src="<?= APP_URL; ?>/assets/js/toast.js"></script>
    <script src="<?= APP_URL; ?>/assets/js/notification.js"></script>
    <script src="<?= APP_URL; ?>/assets/js/sweetalert.js"></script>
    <script src="<?= APP_URL; ?>/assets/js/loading.js"></script>
    <script src="<?= APP_URL; ?>/assets/js/ajax.js"></script>

    <!-- Hide Loader -->
    <script>

        window.addEventListener("load", function () {

            const loader = document.getElementById("loader");

            if(loader)
            {
                loader.style.display = "none";
            }

        });

    </script>

</body>
</html>
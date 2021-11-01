<template>
  <div>
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top  border border-top-0">

        <ul class="navbar-nav mr-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->


            <!-- Nav Item - Alerts -->

            <!-- Nav Item - Messages -->





            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <img class="img-profile rounded-circle" src="/images/16356192660a03952c249e18153058030bd73c6631.jpg">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Obe</span></a>
                <!-- Dropdown - User Information -->

            </li>

        <div class="topbar-divider d-none d-sm-block"></div>
    </ul>
    <ul class="navbar-nav ml-auto mt-4 mr-2">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle optionButtons " href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <span class="d-sm-inline-block  optionButtons">...</span>
            </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in mt-0" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
        </li>

    </ul>
    </nav>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component Exaple App mounted.')
        }
    }
</script>

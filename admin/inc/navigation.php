<style>
    .sidebar li.nav-item * {
        color: white;
    }
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-dark elevation-4 bg-primary text-white">
    <!-- Brand Logo -->
    <a href="<?php echo base_url ?>admin" class="brand-link bg-primary text-sm">
        <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="Store Logo" class="brand-image img-circle elevation-3" style="opacity: .8;width: 2.5rem;height: 2.5rem;max-height: unset">
        <span class="brand-text font-weight-light"><?php echo $_settings->info('short_name') ?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
        <div class="os-resize-observer-host observed">
            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
        </div>
        <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
            <div class="os-resize-observer"></div>
        </div>
        <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
        <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
                <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                    <!-- Sidebar user panel (optional) -->
                    <div class="clearfix"></div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-4">
                        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item dropdown">
                                <a href="./" class="nav-link nav-home">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="<?php echo base_url ?>admin/?page=packages" class="nav-link nav-packages">
                                    <i class="nav-icon fas fa-map-marked"></i>
                                    <p>
                                        Packages
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="<?php echo base_url ?>admin/?page=books" class="nav-link nav-books">
                                    <i class="nav-icon fas fa-th-list"></i>
                                    <p>
                                        Bookings
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="<?php echo base_url ?>admin/?page=inquiries" class="nav-link nav-inquiries">
                                    <i class="nav-icon fas fa-question-circle"></i>
                                    <p>
                                        Inquiries
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="<?php echo base_url ?>admin/?page=review" class="nav-link nav-review">
                                    <i class="nav-icon fas fa-comment-alt"></i>
                                    <p>
                                        Rate & Reviews
                                    </p>
                                </a>
                            </li>
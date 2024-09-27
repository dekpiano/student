        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.html" class="app-brand-link">
                        <img src="<?=base_url('uploads/LogoSchool/LogoSKJ_4.png')?>" style="width:50px" class="img-fluid" alt="">
                        <span class="menu-text fw-bold ms-2">ระบบงานนักเรียน</span>
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboards -->

                    <li class="menu-item <?=$uri->getSegment(1) == "Dashboard" ?"active":""?> ">
                        <a href="<?=base_url('Dashboard')?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-smile"></i>
                            <div class="text-truncate" data-i18n="Support">Dashboards </div>
                        </a>
                    </li>
                    <li class="menu-item <?=$uri->getSegment(1) == "DoGrade" ?"active":""?> ">
                        <a href="<?=base_url('DoGrade/'.session()->get('CheckYearNow'));?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-file"></i>
                            <div class="text-truncate" data-i18n="Support">ดูผลการเรียน</div>
                        </a>
                    </li>

                    <!-- Layouts -->
                    <!-- <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-layout"></i>
                            <div class="text-truncate" data-i18n="Layouts">Layouts</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="layouts-without-menu.html" class="menu-link">
                                    <div class="text-truncate" data-i18n="Without menu">Without menu</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="layouts-without-navbar.html" class="menu-link">
                                    <div class="text-truncate" data-i18n="Without navbar">Without navbar</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="layouts-fluid.html" class="menu-link">
                                    <div class="text-truncate" data-i18n="Fluid">Fluid</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="layouts-container.html" class="menu-link">
                                    <div class="text-truncate" data-i18n="Container">Container</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="layouts-blank.html" class="menu-link">
                                    <div class="text-truncate" data-i18n="Blank">Blank</div>
                                </a>
                            </li>
                        </ul>
                    </li> -->



                    <!-- Misc -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
                    <li class="menu-item">
                        <a href="#"
                            target="_blank" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-support"></i>
                            <div class="text-truncate" data-i18n="Support">Support</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#"
                            target="_blank" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-file"></i>
                            <div class="text-truncate" data-i18n="Documentation">Documentation</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->
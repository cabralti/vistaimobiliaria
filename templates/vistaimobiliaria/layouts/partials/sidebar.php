<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= url('') ?>" class="brand-link text-center">
        <span class="brand-text font-weight-light">Vista Imobiliária</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Clientes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= url('clientes') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ver Todos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= url('clientes/criar') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cadastrar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-house-user"></i>
                        <p>
                            Proprietários
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= url('proprietarios') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ver Todos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= url('proprietarios/criar') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cadastrar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Imovéis
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= url('imoveis') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ver Todos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= url('imoveis/criar') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cadastrar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-contract"></i>
                        <p>
                            Contratos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= url('contratos') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ver Todos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= url('contratos/criar') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cadastrar</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
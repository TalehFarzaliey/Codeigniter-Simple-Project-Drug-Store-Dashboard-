<?php

$parent     = $this->session->userdata("parent");
$activeItem = $this->session->userdata("activeItem");

?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url("assets");?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Sevinc</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Axtar...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>İdarəetmə Paneli</span></a>
            </li>

            <li class="treeview <?php echo ($parent == "drug_folder") ? "active" : ""; ?>">
                <a href="#">
                    <i class="fa fa-bed"></i>
                    <span>Dərmanlar</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu" id="drug_folder">
                    <li class="<?php echo ($activeItem == "drug_category") ? "active" : ""; ?>" id="drug_category">
                        <a href="<?php echo base_url("drugcategory");?>"><i class="fa fa-circle-o"></i> Kategoriyalar</a>
                    </li>
                    <li class="<?php echo ($activeItem == "drug") ? "active" : ""; ?>" id="drug">
                        <a href="<?php echo base_url("drug");?>"><i class="fa fa-circle-o"></i> Dərmanlar</a>
                    </li>
                    <li class="<?php echo ($activeItem == "drug_shop") ? "active" : ""; ?>" id="drug_shop">
                        <a href="<?php echo base_url("drug_shop");?>"><i class="fa fa-circle-o"></i> Sifarişlər</a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
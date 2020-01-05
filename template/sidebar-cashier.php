<aside class="main-sidebar">
    <section class="sidebar">
<div class="user-panel">
        <!-- <div class="pull-left image">
          <img src="dist/img/profile.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
          <!-- Status
          <a href="#"><i class="fa fa-circle text-success"></i> Online
          </a>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- Optionally, you can add icons to the links -->
         <li class="active"><a href="index.php"><i class="fa fa-home"></i> <span>Admin Dashboard</span></a></li>
                       


                        <li class="treeview">
                            <a href="#"><i class="fa fa-cart-plus"></i> <span>Purchase Order</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="po-generate.php">Generate PO</a></li>
                                <li><a href="po-manage.php">Manage PO</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#"><i class="fa fa-cubes"></i> <span>Stock</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <!-- <li><a href="PO-add.php">Add PO</a></li> -->
                                <li><a href="stock-manage.php">In-Stocks</a></li>
                                <li><a href="stock-manage-expired.php">Expired</a></li>
                            </ul>
                        </li>


                        <li class="treeview">
                            <a href="#"><i class="fa fa-shopping-cart"></i> <span>Sales Invoice</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="si-generate.php">Generate SI</a></li>
                                <li><a href="si-manage.php">Manage SI</a></li>
                                <li><a href="si-void.php">Void SI</a></li>
                                <li><a href="si-credits.php">Manage Credits</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#"><i class="fa fa-users"></i> <span>Customer</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="customer-add.php">Add Customer</a></li>
                                <li><a href="customer-manage.php">Manage Customers</a></li>
                                <li><a href="si-credits.php">Manage Credits</a></li>
                            </ul>
                        </li>


                        <li><a href="reports.php"><i class="fa fa-pie-chart"></i> <span>Reports</span></a>
                        </li>

                        <li><a href="#" class="icon-bar" data-toggle="modal" data-target="#modal-default"><i class="fa fa-close"></i> <span>Logout</span></a>
                        </li>
                    </ul>
                </section>
            </aside>

 <nav class="navbar-default navbar-static-side" role="navigation">
    
           


            <div class="sidebar-collapse">

                <ul class="nav" id="side-menu">

                 

                  <li>
                    <a href="{{ URL::to('items') }}"><i class="glyphicon glyphicon-barcode fa-fw"></i> Items</a>
                  </li>

                  <li>
                    <a href="{{ URL::to('customers') }}"><i class="glyphicon glyphicon-user fa-fw"></i> Customers</a>
                  </li>

                  <li>
                    <a href="{{ URL::to('suppliers') }}"><i class="glyphicon glyphicon-user fa-fw"></i> Suppliers</a>
                  </li>    
               
                  <li>
                    <a href="{{ URL::to('salesorders') }}"><i class="glyphicon glyphicon-list fa-fw"></i> Sales Orders</a>
                  </li>
                        
                  <li>
                    <a href="{{ URL::to('purchaseorders') }}"><i class="glyphicon glyphicon-list fa-fw"></i>  Purchase Orders</a>
                  </li>
                
                  
                  
                  <li>
                    <a href="{{ URL::to('paymentmethods') }}"><i class="fa fa-tasks fa-fw"></i>  Payment Methods</a>
                  </li>
                        
                  <li>
                    <a href="{{ URL::to('payments') }}"><i class="fa fa-file fa-fw"></i>  Payments</a>
                  </li>

                  
                
                  <li>
                    <a href="{{ URL::to('stocks') }}"><i class="glyphicon glyphicon-random fa-fw"></i>  Stock</a>
                  </li>

                  <li>
                    <a href="{{ URL::to('locations') }}"><i class="glyphicon glyphicon-home fa-fw"></i>  Stores</a>
                  </li>   


                  <li>
                    <a href="{{ URL::to('erpreports') }}"><i class="glyphicon glyphicon-folder-open fa-fw"></i>  Reports</a>
                  </li>   


                    
                    
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->

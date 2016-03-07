 <nav class="navbar-default navbar-static-side" role="navigation">
    
           


            <div class="sidebar-collapse">

                <ul class="nav" id="side-menu">
                     <li>
                        <a href="{{ URL::to('employees/create') }}"><i class="fa fa-user fa-fw"></i> New Employee </a>
                    </li>

                    <li>
                        <a href="{{ URL::to('employees') }}"><i class="fa fa-users fa-fw"></i> Employees </a>
                    </li>

                     <li>
                        <a href="{{ URL::to('NextOfKins') }}"><i class="fa fa-users fa-fw"></i> Next Of Kins </a>
                    </li>

                     <li>
                        <a href="{{ URL::to('documents') }}"><i class="fa fa-users fa-fw"></i> Employee Documents </a>
                    </li>

                     <li>
                        <a href="{{ URL::to('Appraisals') }}"><i class="fa fa-list fa-fw"></i> Appraisals </a>
                    </li>

                    <li>
                        <a href="{{ URL::to('Properties') }}"><i class="fa fa-list fa-fw"></i> Company Properties </a>
                    </li>

                    <li>
                        <a href="{{ URL::to('occurences') }}"><i class="fa fa-users fa-fw"></i> Employee Occurences </a>
                    </li>

                     <li>
                        <a href="{{ URL::to('reports/employees') }}"><i class="fa fa-folder fa-fw"></i> Reports </a>
                    </li>
                    
                    
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->
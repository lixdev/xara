 <nav class="navbar-default navbar-static-side" role="navigation">
    
           


            <div class="sidebar-collapse">

                <ul class="nav" id="side-menu">

                    <li>
                        <a href="{{ URL::to('payrollReports/selectPeriod') }}"><i class="glyphicon glyphicon-file fa-fw"></i> Leave Applications</a>
                    </li>

                    <li>
                        <a href="{{ URL::to('payrollReports/selectSummaryPeriod') }}"><i class="glyphicon glyphicon-file fa-fw"></i> Leaves Approved</a>
                    </li>

                    <li>
                        <a href="{{ URL::to('payrollReports/selectRemittancePeriod') }}"><i class="glyphicon glyphicon-file fa-fw"></i> Leaves Rejected</a>
                    </li>

                    <li>
                        <a href="{{ URL::to('payrollReports/selectAllowance') }}" ><i class="glyphicon glyphicon-file fa-fw"></i> Allowance Report</a>
                    </li>  

                    <li>
                        <a href="{{ URL::to('payrollReports/selectDeduction') }}" target="_blank"><i class="glyphicon glyphicon-file fa-fw"></i> Deduction Report</a>
                    </li>  

                    
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->
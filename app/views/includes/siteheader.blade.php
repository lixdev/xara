<header id="header">
			<div class="container-center cf">
				<div class="logo">
					<a href="{{URL::to('/')}}"><img src="{{ asset('public/uploads/logo/'.$organization->logo) }}"  alt="Logo Estimation" width="120"/></a>			
				</div><!-- end logo -->
				
				
				<nav id="main-navigation" class="navigation cf ">
					<ul>
						<li>
						    <a  href="{{ URL::to('dashboard')}}" style="color:blue">{{ Lang::get('messages.nav.home') }}<span>Welcome </span></a>
						</li>	
						

						<li><a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:blue">Modules<span>Xara Platform</span></a>
						
						<ul class="dropdown-menu dropdown-user">
                    <?php $organization = Organization::find(Confide::user()->organization_id); ?>
                        @if($organization->is_payroll_active)
                        <li>
                            <a  href="{{ URL::to('hrdashboard')}}">
                                <i class="fa fa-users fa-fw"></i>  {{{ Lang::get('messages.nav.hr') }}}
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a  href="{{ URL::to('payrolldashboard')}}">
                                <i class="fa fa-list fa-fw"></i>  {{{ Lang::get('messages.nav.payroll') }}}
                            </a>
                        </li>
                        <li class="divider"></li>
                        @endif

                        @if($organization->is_erp_active)
                        <li>
                            <a  href="{{ URL::to('erpmgmt')}}">
                                <i class="fa fa-tasks fa-fw"></i>  {{{ Lang::get('messages.nav.erp') }}}
                            </a>
                        </li>
                        <li class="divider"></li>
                        @endif

                        @if($organization->is_cbs_active)
                        <li>
                            <a  href="{{ URL::to('cbsmgmt')}}">
                                <i class="fa fa-qrcode fa-fw"></i>  {{{ Lang::get('messages.nav.cbs') }}}
                            </a>
                        </li>
                        <li class="divider"></li>
                        @endif
                    </ul>
							
						</li>
								
						
						<li><a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:blue">Administration<span>Manage System</span></a>
						
						<ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="{{ URL::to('organizations') }}"><i class="fa fa-home fa-fw"></i>  Organization</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ URL::to('accounts')}}"> <i class="fa fa-file fa-fw"></i>  {{{ Lang::get('messages.nav.accounting') }}} </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ URL::to('system') }}"><i class="fa fa-sign-out fa-fw"></i> System</a>
                        </li>
                    </ul>
						
						
						</li>

			<li><a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:blue">{{ Confide::user()->username}}<span>Logged in user</span></a>
						
						<ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="{{ URL::to('users/profile/'.Confide::user()->id ) }}"><i class="fa fa-user fa-fw"></i>  Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ URL::to('activatedproducts') }}"><i class="fa fa-tags fa-fw"></i>  Upgrade License</a>
                        </li> 
                        <li class="divider"></li>
                        <li>
                            <a class="logout" href="{{ URL::to('users/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
						
						
						</li>
					</ul>
				</nav>
			</div><!-- end container-center -->
		</header>
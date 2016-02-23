<section id="widget-grid" class="">
	<div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3" data-widget-editbutton="true">
			<!-- widget options:
            usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

            data-widget-colorbutton="false"
            data-widget-editbutton="false"
            data-widget-togglebutton="false"
            data-widget-deletebutton="false"
            data-widget-fullscreenbutton="false"
            data-widget-custombutton="false"
            data-widget-collapsed="true"
            data-widget-sortable="false"

            -->
			<header>
				<span class="widget-icon"> <i class="fa fa-table"></i> </span>
				<h2>Users</h2>

			</header>
				<div>
                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->
					<div class="widget-body no-padding">

							<table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
								<thead>
									<tr>
										<th data-hide="phone">Id</th>
										<th data-class="expand">Email</th>
										<th data-hide="phone,tablet">Permissions</th>
										<th data-hide="phone">First Name</th>
										<th data-hide="phone">Last Name</th>
										<th data-hide="phone">Last Login</th>
										<th data-hide="phone">Action</th>
									</tr>
								</thead>
								<tbody>
								@foreach($users as $user)
									<tr>
										<td>{!! $user->id !!}</td>
										<td>{!! $user->email !!}</td>
										<td>{!! $user->permissions !!}</td>
										<td>{!! $user->first_name !!}</td>
										<td>{!! $user->last_name !!}</td>
										<td>{!! $user->last_login !!}</td>
										<td>
											<a href="{!! route('users.edit', [$user->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
											<a href="{!! route('users.delete', [$user->id]) !!}" onclick="return confirm('Are you sure wants to delete this User?')"><i class="glyphicon glyphicon-remove"></i></a>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>

					</div>
				</div>

			</div>

		</article>
	</div>
</section>


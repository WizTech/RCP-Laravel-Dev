<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-green modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Admin User Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ URL::to('rcpadmin/admin_users/update_admin/'.$id)}}" id="editForm" method="post">
                {{ method_field('PATCH') }}
                <div class="modal-body">
                    <ul id="errors">
                    </ul>
                    <div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-lg-4 col-xl-4 col-md-6 col-12 mb-3">
                                    {!! Form::label('Role',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('role_id', $admin_role, $selected_role, ['class' => 'custom-select']) !!}
                                </div>
                                <div class="col-lg-4 col-xl-4 col-md-6 col-12 mb-3">
                                    {!! Form::label('Name',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('name',$admin_user['name'],['class' => 'form-control']) !!}
                                </div>
                                <div class="col-lg-4 col-xl-4 col-md-6 col-12 mb-3">
                                    {!! Form::label('Username',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('username',$admin_user['username'],['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-lg-4 col-xl-4 col-md-6 col-12 mb-3">
                                    {!! Form::label('Email',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('email',$admin_user['email'],['class' => 'form-control']) !!}
                                </div>
                                <div class="col-lg-4 col-xl-4 col-md-6 col-12 mb-3">
                                    {!! Form::label('Password',null,['class' => 'col-form-label']) !!}
                                    {!! Form::password('password',['class' => 'form-control']) !!}
                                </div>
                                <div class="col-lg-4 col-xl-4 col-md-6 col-12 mb-3">
                                    {!! Form::label('Export All Leads',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('export_all_leads',$export_leads,$selected_lead,['class' => 'custom-select']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-lg-4 col-xl-4 col-md-6 col-12 mb-3">
                                    {!! Form::label('Select Campus',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('campus_id[]',$campusSelect,$admin_campuses,
                                        ['class' => 'form-control',
                                        'multiple' => 'multiple']) !!}
                                </div>
                                <div class="col-lg-4 col-xl-4 col-md-6 col-12 mb-3">
                                    {!! Form::label('Status',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('status',$status,$selected_status,['class' => 'custom-select']) !!}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-xs"> Update</button>
                    <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


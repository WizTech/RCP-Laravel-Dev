<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-green modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Campus Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php  $user_id = $user['id']; ?>
            <form action="{{ URL::to('rcpadmin/users/update_user/'.$user_id)}}" id="userEditForm" method="post">
                {{ method_field('PATCH') }}
                <div class="modal-body">
                    <ul id="errors">

                    </ul>
                    <div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-lg-4 col-xl-4 col-md-6 col-12 mb-3">
                                    {!! Form::label('User Type',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('role',['2'=>'Student','3'=>'Landlord'],null,['class' => 'custom-select roleId']) !!}
                                </div>
                                <div class="col-lg-4 col-xl-4 col-md-6 col-12 mb-3">
                                    {!! Form::label('status',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('status',['Active'=>'ACTIVE','Inactive'=>'INACTIVE'],null,['class' => 'custom-select']) !!}
                                </div>
                                <div class="col-lg-4 col-xl-4 col-md-6 col-12 mb-3">
                                    {!! Form::label('Campus',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('campus_id',[$campusSelect],null,['class' => 'custom-select']) !!}
                                    {{--{!! Form::select('campus_id[]',$campusSelect,$user_campuses,
                                                  ['class' => 'custom-select materialSelect', 'multiple']) !!}--}}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-4 col-xl-3 col-md-6 col-12 mb-3">
                                    {{ Form::hidden('id', $user['id']) }}
                                    {!! Form::label('First Name',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('first_name', $user['first_name'] ,['class' => 'form-control']) !!}
                                </div>
                                <div class="col-lg-4 col-xl-3 col-md-6 col-12 mb-3">
                                    {!! Form::label('Last Name',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('last_name', $user['last_name'] ,['class' => 'form-control']) !!}
                                </div>
                                <div class="col-lg-4 col-xl-3 col-md-6 col-12 mb-3">
                                    {!! Form::label('Username',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('name', $user['name'] ,['class' => 'form-control']) !!}
                                </div>
                                <div class="col-lg-4 col-xl-3 col-md-6 col-12 mb-3">
                                    {!! Form::label('Email',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('email', $user['email'] ,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-4 col-xl-3 col-md-6 col-12 mb-3">
                                    {!! Form::label('Password',null,['class' => 'col-form-label']) !!}
                                    {!! Form::password('password',['class' => 'form-control']) !!}

                                </div>
                                <div class="col-lg-4 col-xl-3 col-md-6 col-12 mb-3">
                                    {!! Form::label('Phone Number',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('phone_no', $user['phone_no'] ,['class' => 'form-control']) !!}

                                </div>
                                <div class="col-lg-4 col-xl-3 col-md-6 col-12 mb-3">
                                    {!! Form::label('Fax',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('fax',$user['fax'],['class' => 'form-control']) !!}

                                </div>
                                <div class="col-lg-4 col-xl-3 col-md-6 col-12 mb-3">
                                    {!! Form::label('Address',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('address', $user['address'] ,['class' => 'form-control']) !!}

                                </div>
                            </div>
                        </div>
                        <div class="<?=$user['role'] == '2'?'hide':''?> landlord-form form-group">
                            <div class="form-row">
                                <div class="col-lg-4 col-xl-3 col-md-6 col-12 mb-3">
                                    {!! Form::hidden('id') !!}
                                    {!! Form::label('Which type of Landlord are you ?',null,['class' => 'col-form-label']) !!}

                                    {!! Form::select('type',['Personal'=>'Personal','Company'=>'Company'],null,['class' => 'custom-select']) !!}

                                </div>
                                <div class="col-lg-4 col-xl-3 col-md-6 col-12 mb-3">
                                    {!! Form::label('Free (Applicable only for Landlord)',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('free_trial',['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select']) !!}

                                </div>
                                <div class="col-lg-4 col-xl-3 col-md-6 col-12 mb-3">
                                    {!! Form::label('Premium Landlord',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('preimum',['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select']) !!}

                                </div>
                                <div class="col-lg-4 col-xl-3 col-md-6 col-12 mb-3">
                                    {!! Form::label('Property Email Leads',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('email_leads',['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select']) !!}

                                </div>
                                <div class="col-lg-4 col-xl-3 col-md-6 col-12 mb-3">
                                    {!! Form::label('Landlord\'s Dashboard Link',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('landlord_dashboard_status',['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select']) !!}

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-6 col-xl-4 col-md-6 col-12 mb-3">
                                    {!! Form::label('Company',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('company',null,['class' => 'form-control']) !!}
                                </div>
                                <div class="col-lg-6 col-xl-4 col-md-6 col-12 mb-3">
                                    {!! Form::label('Website',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('website',null,['class' => 'form-control']) !!}
                                </div>
                                <div class="col-lg-6 col-xl-4 col-md-6 col-12 mb-3">
                                    {!! Form::label('Domain',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('domain_name',null,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-4 col-xl-3 col-md-6 col-12 mb-3">
                                    {!! Form::label('Activate Twilio',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('activate_twilio',['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select activate_twilio']) !!}
                                    {!! Form::text('twilio_number',null,['class' => 'form-control hide twilio_number','placeholder' => 'Twilio Number']) !!}
                                </div>
                                <div class="col-lg-4 col-xl-3 col-md-6 col-12 mb-3">
                                    {!! Form::label('Entrata Landlord?',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('is_entrata',['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select is_entrata']) !!}
                                    {!! Form::text('entrata_client_id',null,['class' => 'form-control hide entrata_client_id','placeholder' => 'Client ID']) !!}
                                </div>
                                <div class="col-lg-4 col-xl-3 col-md-6 col-12 mb-3">
                                    {!! Form::label('Yardi Landlord?',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('is_yardi',['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select is_yardi']) !!}
                                    {!! Form::text('yardi_user_id',null,['class' => 'form-control hide yardi_user_id','placeholder' => 'Yardi ID']) !!}
                                </div>
                                <div class="col-lg-4 col-xl-3 col-md-6 col-12 mb-3">
                                    {!! Form::label('Emma Trial Landlord?',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('emma_trial_landlord',['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'],null,['class' => 'custom-select emma_trial_landlord']) !!}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-6 col-xl-4 col-md-6 col-12 mb-3">
                                    {!! Form::label('H1',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('h1',null,['class' => 'form-control']) !!}
                                </div>
                                <div class="col-lg-6 col-xl-4 col-md-6 col-12 mb-3">
                                    {!! Form::label('H2',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('h2',null,['class' => 'form-control']) !!}
                                </div>
                                <div class="col-lg-6 col-xl-4 col-md-6 col-12 mb-3">
                                    {!! Form::label('Meta Title',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('meta_title',null,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-6 col-xl-4 col-md-6 col-12 mb-3">
                                    <div class="input-group">
                                        {!! Form::label('Seo Block',null,['class' => 'input-group-text']) !!}
                                        {!! Form::textarea('seo_block',null,['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-4 col-md-6 col-12 mb-3">
                                    <div class="input-group">
                                        {!! Form::label('About Details',null,['class' => 'input-group-text']) !!}
                                        {!! Form::textarea('about_details',null,['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-4 col-md-6 col-12 mb-3">
                                    <div class="input-group">{!! Form::label('Meta Description',null,['class' => 'input-group-text']) !!}
                                        {!! Form::textarea('meta_description',null,['class' => 'form-control']) !!}</div>

                                </div>
                            </div>
                            {{ csrf_field() }}
                        </div>
                        {{--<div class="form-group">
                            {!! Form::submit($buttonText,['class'=>'btn btn-flat btn-success btn-lg btn-block']) !!}
                        </div>--}}
                    </div>
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-xs"> Update</button>
                    <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('select.roleId').on('change', function () {
            if ($(this).val() == '3') {
                $('.landlord-form').removeClass('hide');
            } else {
                $('.landlord-form').addClass('hide');
            }

        });
        $('select.activate_twilio').on('change', function () {
            if ($(this).val() == 'ACTIVE') {
                $('.twilio_number').removeClass('hide');
            } else {
                $('.twilio_number').addClass('hide');
            }

        });
        $('select.is_entrata').on('change', function () {
            if ($(this).val() == 'ACTIVE') {
                $('.entrata_client_id').removeClass('hide');
            } else {
                $('.entrata_client_id').addClass('hide');
            }

        });
        $('select.is_yardi').on('change', function () {
            if ($(this).val() == 'ACTIVE') {
                $('.yardi_user_id').removeClass('hide');
            } else {
                $('.yardi_user_id').addClass('hide');
            }

        });
    });
    $(window).load(function () {
        $('select.roleId').trigger('change');
        $('select.activate_twilio').trigger('change');
        $('select.is_entrata').trigger('change');
        $('select.is_yardi').trigger('change');
    })
</script>

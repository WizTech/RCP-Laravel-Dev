<div class="modal fade" id="campusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-green modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Campus Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php  $campus_id = $campus['id']; ?>
            <form action="{{ URL::to('rcpadmin/campus/update_campus/'.$campus_id)}}" id="campusEditForm" method="post">
                {{ method_field('PATCH') }}
                <div class="modal-body">
                    <ul id="errors">

                    </ul>
                    <div>
                        <div class="form-group">
                            <div class="form-row">


                                <div class="col-md-4 mb-3">
                                    {!! Form::label('Campus Name',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('name',$campus['name'],['class' => 'form-control','data-role'=>"tagsinput"]) !!}
                                </div>

                                <div class="col-md-4 mb-3">
                                    {!! Form::label('Campus Title',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('title',$campus['title'],['class' => 'form-control']) !!}
                                </div>
                                <div class="input-field col s12">
                                    {!! Form::label('Address',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('address',$campus['address'],['class' => 'form-control']) !!}
                                </div>
                                <div class="col-md-4 mb-3">
                                    {!! Form::label('H1',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('h1',$campus['h1'],['class' => 'form-control']) !!}
                                </div>

                                <div class="col-md-4 mb-3">
                                    {!! Form::label('H2',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('h2',$campus['h2'],['class' => 'form-control']) !!}
                                </div>


                                <div class="input-field col s12">
                                    {!! Form::label('Meta Title',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('meta_title',$campus['meta_title'],['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-row">
                                {{--<div class="col-md-4 mb-4">
                                  {!! Form::select('campus_linked[]',['1'=>'madison','2'=>'marquette'],null,['class' => 'custom-select chosen','multiple','data-placeholder'=>"Campus Linked" ]) !!}
                                </div>--}}
                                <div class="col-md-4 mb-4">
                                    {!! Form::label('Campus Linked',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('campus_linked[]',$campusSelect,$linked_campuses,
                                        ['class' => 'form-control',
                                        'multiple' => 'multiple']) !!}

                                </div>
                                <div class="col-md-3 mb-3">
                                    {!! Form::label('Featured Landlord',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('featured_landlord',$usersSelect,null,['class' => 'custom-select']) !!}
                                </div>
                                <div class="col-md-2 mb-2">
                                    {!! Form::label('Phone',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('phone',$campus[''],['class' => 'form-control']) !!}

                                </div>
                                <div class="col-md-3 mb-3">
                                    {!! Form::label('Make Live?',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('live',[''=>'Make Live?','Active'=>'ACTIVE','Inactive'=>'INACTIVE'],null,['class' => 'custom-select']) !!}
                                </div>
                                <div class="col-md-3 mb-3">
                                    {!! Form::label('Rating?',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('rating',[''=>'Rating?','Active'=>'ACTIVE','Inactive'=>'INACTIVE'],null,['class' => 'custom-select']) !!}
                                </div>
                                <div class="col-md-3 mb-3">
                                    {!! Form::label('Show Premium Banner?',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('premium_banner',[''=>'Show Premium Banner?','Active'=>'ACTIVE','Inactive'=>'INACTIVE'],null,['class' => 'custom-select']) !!}
                                </div>
                                <div class="col-md-3 mb-3">
                                    {!! Form::label('Allow Immitation Email?',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('immitation_email',['Active'=>'ACTIVE','Inactive'=>'INACTIVE'],null,['class' => 'custom-select']) !!}
                                </div>
                                <div class="col-md-3 mb-3">
                                    {!! Form::label('Status',null,['class' => 'col-form-label']) !!}
                                    {!! Form::select('status',[''=>'Status','Active'=>'ACTIVE','Inactive'=>'INACTIVE'],null,['class' => 'custom-select']) !!}

                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-4 mb-4">
                                    {!! Form::label('Facebook tracking pixel number',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('facebook_tracking',$campus['facebook_track_code'],['class' => 'form-control']) !!}

                                </div>
                                <div class="col-md-4 mb-4">
                                    {!! Form::label('Housing Fair Link',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('housing_link',$campus['housing_link'],['class' => 'form-control']) !!}

                                </div>

                                <div class="col-md-4 mb-4">
                                    {!! Form::label('Campus Short Name',null,['class' => 'col-form-label']) !!}
                                    {!! Form::text('short_name',$campus['short_name'],['class' => 'form-control']) !!}

                                </div>

                            </div>

                            <div class="form-row">
                                <div class="col-md-6 mb-6" id="addToList-plugin">
                                    {!! Form::label('Campus Abbreviations',null,['class' => 'input-group-text']) !!}
                                    {!! Form::text('new-abbreviation',$campus['campus_abbrevation'],['class' => 'form-control']) !!}

                                </div>
                                <div class="col-md-6 mb-6" id="addToListZip-plugin">
                                    {!! Form::label('Campus Zipcode(s)',null,['class' => 'input-group-text']) !!}
                                    {!! Form::text('new-zipcode',$campus['zip_codes'],['class' => 'form-control']) !!}

                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    {!! Form::label('Meta Description',null,['class' => 'input-group-text']) !!}
                                    {!! Form::textarea('meta_description', $campus['meta_description'],['class' => 'form-control']) !!}

                                </div>
                                <div class="col-md-6 mb-6">
                                    {!! Form::label('Seo Block',null,['class' => 'input-group-text']) !!}
                                    {!! Form::textarea('seo_block',$campus['seo_block'],['class' => 'form-control']) !!}

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


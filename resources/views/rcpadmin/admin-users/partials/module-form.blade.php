@if (isset($admin_modules) && count($admin_modules) > 0)
    <table class="table">
        <thead>
        <tr>
            <th>Modules</th>
            <th colspan="5" class="text-center">Permissions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($admin_modules as $module)
            <div id="input-checkboxes" class="section">
                <tr>
                    <td><h6 class="header">{{$module['title']}}</h6></td>
                    @if (isset($modules_options) && count($modules_options) > 0)
                        <ul>
                            @foreach($modules_options as $option)
                                @php
                                    $checked = '';
                                     $permissions =  $modules_permissions;
                                     if($permissions):
                                       foreach($permissions as $access){
                                        if($access['admin_id'] == $admin_user['id'] && $access['module_id'] == $module['id'] && $option['id'] == $access['module_option_id']){
                                           $checked = 'checked';
                                           break;
                                        }else{
                                           $checked = '';
                                        }
                                       }
                                     endif;
                                @endphp
                                <td>
                                    <input {{$checked}} type="checkbox" name="options[]"
                                           value="{{$module['id']}},{{$option['id']}}"
                                           class="filled-in-{{$module['id']}}-{{$option['id']}}"
                                           id="filled-in-box-{{$module['id']}}-{{$option['id']}}"/>
                                    <label for="filled-in-box-{{$module['id']}}-{{$option['id']}}">{{$option['name']}}</label>
                                </td>
                            @endforeach
                        </ul>
                    @endif
                </tr>
            </div>
        @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="input-field col s12">
            {!! Form::submit('Save',['class'=>'btn btn-primary btn-sm']) !!}
        </div>
    </div>
@endif
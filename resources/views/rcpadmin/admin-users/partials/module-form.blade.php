@if (isset($admin_modules) && count($admin_modules) > 0)
  @foreach($admin_modules as $module)
    <div id="input-checkboxes" class="section">
      <h4 class="header">{{$module['title']}}</h4>
      <div class="row">
        <div class="col s12 m8 l9">

          @if (isset($modules_options) && count($modules_options) > 0)
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

              <p>
                <input {{$checked}} type="checkbox" name="options[]" value="{{$module['id']}},{{$option['id']}}" class="filled-in-{{$module['id']}}-{{$option['id']}}" id="filled-in-box-{{$module['id']}}-{{$option['id']}}"/>
                <label for="filled-in-box-{{$module['id']}}-{{$option['id']}}">{{$option['name']}}</label>
              </p>
            @endforeach
          @endif

        </div>

      </div>
    </div>
  @endforeach
  <div class="row">
    <div class="input-field col s12">

      {!! Form::submit($buttonText,['class'=>'btn cyan waves-effect waves-light right']) !!}
    </div>
  </div>
@endif
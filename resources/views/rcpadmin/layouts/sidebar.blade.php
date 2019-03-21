<nav>
  <ul class="metismenu" id="menu">
    @if($modules)
      @foreach($modules as $module)
        <li class="{{ ( $current_controller == $module['controller']) ? 'active': 'dd'}}"><a
            href="{{ url('rcpadmin/').'/'.$module['slug'] }}"
            class="waves-effect waves-cyan"><i
              class="ti-{{$module['icon']}}"></i> <span>{{$module['title']}}</span></a></li>
      @endforeach

      <li>
        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-view-list"></i><span>Settings</span></a>
        <ul class="collapse">
          <li class="child-element"><a href="{{ url('rcpadmin/').'/block_email'}}">Block Emails</a>
          </li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/block_ip'}}">Block IP</a>
          </li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/unsubcribers'}}">Unsubcribers</a>
          </li>
        </ul>
      </li>
    @endif


  </ul>
</nav>
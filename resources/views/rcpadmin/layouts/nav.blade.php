<!-- START LEFT SIDEBAR NAV-->
<aside id="left-sidebar-nav">
  <ul id="slide-out" class="side-nav fixed leftside-navigation">
    <li class="user-details cyan darken-2">
      <div class="row">
        <div class="col col s4 m4 l4">
          <img src="{{ env('THEME_ASSETS') }}images/img1.jpg" alt=""
               class="circle responsive-img valign profile-image">
        </div>
        <div class="col col s8 m8 l8">
          <ul id="profile-dropdown" class="dropdown-content">
            <li><a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                  class="mdi-hardware-keyboard-tab"></i> Logout</a>
            </li>
          </ul>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#"
             data-activates="profile-dropdown">{{ Auth::user()->name }}<i
              class="mdi-navigation-arrow-drop-down right"></i></a>
          <p class="user-roal">{{ Auth::user()->role->name }}</p>
        </div>
      </div>
    </li>

    @if($modules)
      @foreach($modules as $module)
        @if($module['controller'] == 'CampusController')
          <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i
                class="mdi-editor-insert-comment"></i> Campus Manager</a>
            <div class="collapsible-body">
              <ul>
                <li class="child-element"><a href="{{ url('rcpadmin/').'/campus/index'}}">Listing</a>
                </li>
                <li class="child-element"><a href="{{ url('rcpadmin/').'/campus/renting'}}">Renting Question</a>
                </li>
                <li class="child-element"><a href="{{ url('rcpadmin/').'/campus/neighborhood'}}">Neighborhood</a>
                </li>
                <li class="child-element"><a href="{{ url('rcpadmin/').'/campus/destination'}}">Destination</a>
                </li>

              </ul>
            </div>
          </li>
        @else

          <li class="bold {{ ( $current_controller == $module['controller']) ? 'active': ''}}"><a
              href="{{ url('rcpadmin/').'/'.$module['slug'] }}"
              class="waves-effect waves-cyan"><i
                class="mdi-action-{{$module['icon']}}"></i> {{$module['title']}}</a></li>
        @endif
      @endforeach

        <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i
                    class="mdi-editor-insert-comment"></i> Content Managment</a>
          <div class="collapsible-body">
            <ul>
              <li class="child-element"><a href="{{ url('rcpadmin/').'/news'}}">News</a>
              </li>
              <li class="child-element"><a href="{{ url('rcpadmin/').'/testimonials'}}">Testimonials</a>
              </li>
              <li class="child-element"><a href="{{ url('rcpadmin/').'/careertype'}}">Careers Type</a>
              </li>
              <li class="child-element"><a href="{{ url('rcpadmin/').'/career'}}">Careers</a>
              </li>
              <li class="child-element"><a href="{{ url('rcpadmin/').'/careerslider'}}">Career Slider</a>
              </li>
              <li class="child-element"><a href="{{ url('rcpadmin/').'/campus-insight'}}">Campus Insight</a>
              </li>
              <li class="child-element"><a href="{{ url('rcpadmin/').'/resources'}}">Resources</a> </li>
              <li class="child-element"><a href="{{ url('rcpadmin/').'/simple-keyword-text'}}">Simpe Keyword Text</a> </li>
            </ul>
          </div>
        </li>

		<li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i
                                class="mdi-editor-insert-comment"></i> Application Stats </a>
                    <div class="collapsible-body">
                        <ul>
                           <li class="child-element"><a href="{{ url('rcpadmin/').'/app-users'}}">App Users</a>
                            </li>
                            <li class="child-element"><a href="{{ url('rcpadmin/').'/visits'}}">Visits</a>
                            </li>
                            <li class="child-element"><a href="{{ url('rcpadmin/').'/app-leads'}}">App Leads</a>
                            </li>
                            <li class="child-element"><a href="{{ url('rcpadmin/').'/app-favorites'}}">App Favorites</a>
                            </li>
                            <li class="child-element"><a href="{{ url('rcpadmin/').'/screen-visits'}}">Screen Visits</a>
                            </li>
         		    <li class="child-element"><a href="{{ url('rcpadmin/').'/time-on-app'}}">Time On App</a>
                            </li>
                            <li class="child-element"><a href="{{ url('rcpadmin/').'/bounce-rate'}}">Bounce Rate</a>
                            </li>                        
			</ul>
                    </div>
                </li>

      <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i
            class="mdi-editor-insert-comment"></i> Settings</a>
        <div class="collapsible-body">
          <ul>
            <li class="child-element"><a href="{{ url('rcpadmin/').'/block_email'}}">Block Emails</a>
            </li>
            <li class="child-element"><a href="{{ url('rcpadmin/').'/block_ip'}}">Block IP</a>
            </li>
            <li class="child-element"><a href="{{ url('rcpadmin/').'/unsubcribers'}}">Unsubcribers</a>
            </li>

          </ul>
        </div>
      </li>
    @endif

  </ul>
  <a href="#" data-activates="slide-out"
     class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i
      class="mdi-navigation-menu"></i></a>
</aside>
<!-- END LEFT SIDEBAR NAV-->
<!-- //////////////////////////////////////////////////////////////////////////// -->

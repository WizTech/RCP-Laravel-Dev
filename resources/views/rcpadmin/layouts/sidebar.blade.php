<nav>
  <ul class="metismenu" id="menu">
    @if($modules)
      @foreach($modules as $module)

        @if($module['slug'] == 'feature')
          <li>
            <a href="javascript:void(0)" aria-expanded="true"><i
                class="ti-view-list"></i><span>Feature Manager</span></a>
            <ul class="collapse">
              <li class="child-element"><a href="{{ url('rcpadmin/').'/feature/1'}}">Unit Features</a></li>
              <li class="child-element"><a href="{{ url('rcpadmin/').'/feature/2'}}">Utilities</a></li>
              <li class="child-element"><a href="{{ url('rcpadmin/').'/feature/3'}}">Property Features</a></li>
              <li class="child-element"><a href="{{ url('rcpadmin/').'/feature/4'}}">Outdoor Space</a></li>
              <li class="child-element"><a href="{{ url('rcpadmin/').'/feature/5'}}">Other</a></li>

            </ul>
          </li>
        @elseif($module['slug'] == 'entrata')
          <li>
            <a href="javascript:void(0)" aria-expanded="true"><i
                class="ti-view-list"></i><span>Entrata Manager</span></a>
            <ul class="collapse">
              <li class="child-element"><a href="{{ url('rcpadmin/').'/entrata'}}">Listing</a>

            </ul>
          </li>
        @else
          <li
            class="{{ ( $current_controller == $module['controller']) ? 'active '.$module['controller']: 'dd'.$module['controller']}}">
            <a
              href="{{ url('rcpadmin/').'/'.$module['slug'] }}"
              class="waves-effect waves-cyan"><i
                class="ti-{{$module['icon']}}"></i> <span>{{$module['title']}}</span></a></li>
        @endif;
      @endforeach

      <li>
        <a href="javascript:void(0)" aria-expanded="true"><i
            class="ti-view-list"></i><span>Content Manager</span></a>
        <ul class="collapse">
          <li class="child-element"><a href="{{ url('rcpadmin/').'/pages'}}">Pages</a></li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/news'}}">News</a></li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/testimonials'}}">Testimonials</a>
          </li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/careertype'}}">Careers Type</a>
          </li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/career'}}">Careers</a>
          </li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/careerslider'}}">Career Slider</a></li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/landing-page'}}">Landing Page</a></li>

          <li class="child-element"><a href="{{ url('rcpadmin/').'/campus-insight'}}">Campus Insight</a>
          </li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/resources'}}">Resources</a>
          </li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/simple-keyword-text'}}">Simpe Keyword
              Text</a></li>
        </ul>
      </li>
      <li>
        <a href="javascript:void(0)" aria-expanded="true"><i
            class="ti-view-list"></i><span>Stats</span></a>
        <ul class="collapse">
          <li class="child-element"><a href="{{ url('rcpadmin/').'/email-leads'}}">Email Leads</a>

          <li class="child-element"><a href="{{ url('rcpadmin/').'/phone-leads'}}">Phone Leads</a></li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/landlord-site-leads'}}">Landlord Site Leads</a></li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/landlord-total-leads'}}">Landlord Total Leads</a>
          </li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/student-views'}}">Student Views</a></li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/property-feeds'}}">Property Feeds</a></li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/users-count'}}">Users Count</a></li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/properties-count'}}">Properties Count</a></li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/active-properties'}}">Active Properties</a></li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/export-landlord-active-properties'}}">Landlord Active
              Properties</a></li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/sublease-track'}}">Sublease Track</a></li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/top-spots'}}">Top Spots</a></li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/imitation-email'}}">Imitation Email</a></li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/expiring-property'}}">Property Expiring</a></li>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/leads-per-company'}}">Leads Per Company</a></li>

        </ul>

      </li>
      <li>
        <a href="javascript:void(0)" aria-expanded="true"><i
            class="ti-view-list"></i><span>Application Stats</span></a>
        <ul class="collapse">
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
      </li>

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
      <li>
        <a href="javascript:void(0)" aria-expanded="true"><i
            class="ti-view-list"></i><span>App Folio Manager</span></a>
        <ul class="collapse">
          <li class="child-element"><a href="{{ url('rcpadmin/').'/rentlinx-listing'}}">Listing</a>
          <li class="child-element"><a href="{{ url('rcpadmin/').'/unapproved'}}">Unapproved</a></li>
        </ul>
      </li>


    @endif

  </ul>
</nav>
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
                <a href="javascript:void(0)" aria-expanded="true"><i
                            class="ti-view-list"></i><span>Content Manager</span></a>
                <ul class="collapse">
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
                    <li class="child-element"><a href="{{ url('rcpadmin/').'/resources'}}">Resources</a>
                    </li>
                    <li class="child-element"><a href="{{ url('rcpadmin/').'/simple-keyword-text'}}">Simpe Keyword
                            Text</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0)" aria-expanded="true"><i
                            class="ti-view-list"></i><span>Application States</span></a>
                <ul class="collapse">
                    <li class="child-element"><a href="{{ url('rcpadmin/').'/app-users'}}">App Users</a>
                    </li>
                    <li class="child-element"><a href="{{ url('rcpadmin/').'/visits'}}">Visits</a>
                    </li>
                    <li class="child-element"><a href="{{ url('rcpadmin/').'/app-leads'}}">App Leads</a>
                    </li>
                    <li class="child-element"><a href="{{ url('rcpadmin/').'/app-favourites'}}">App Favourites</a>
                    </li>
                    <li class="child-element"><a href="{{ url('rcpadmin/').'/screen-visits'}}">Screen Visits</a>
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
        @endif


    </ul>
</nav>
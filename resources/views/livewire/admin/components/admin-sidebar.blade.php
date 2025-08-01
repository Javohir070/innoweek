<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr"></h6>
                    <ul>
                        <li class="{{ Request::routeIs('admin.home.*') ? 'active' : '' }}"><a href="{{ route('admin.home') }}"><i data-feather="grid"></i><span>Bosh sahifa</span></a></li>
                    </ul>
                </li>

                @role('admin', 'super-admin', 'moderator')
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Loyihalar boshqaruvi</h6>
                    <ul>
                        <li class="{{ Request::routeIs('admin.companies.*') ? 'active' : '' }}"><a href="{{ route('admin.companies.index') }}"><i data-feather="users"></i><span>Tashkilotlar ro'yxati</span></a></li>
                        <li class="{{ Request::routeIs('admin.projects.*') ? 'active' : '' }}"><a href="{{ route('admin.projects.index') }}"><i data-feather="folder"></i><span>Loyihalar ro'yxati</span></a></li>
                    </ul>
                </li>
                @endrole

                @role('admin', 'super-admin', 'organizer')
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Povilonlar boshqaruvi</h6>
                    <ul>
                        <li class="{{ Request::routeIs('admin.pa.*') ? 'active' : '' }}"><a href="{{ route('admin.pa.index') }}"><i data-feather="map"></i><span>Pavilionlar ro'yxati</span></a></li>

                        <li class="{{ Request::routeIs('admin.ap.*') ? 'active' : '' }}"><a href="{{ route('admin.ap.index') }}"><i data-feather="briefcase"></i><span>Loyihalar ro'yxati</span></a></li>
                    </ul>
                </li>
                @endrole

                @role('admin', 'super-admin', 'valiantor', 'publisher')
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Kontent boshqaruvi</h6>
                    <ul>
                        <li class="{{ Request::routeIs('admin.about.*') ? 'active' : '' }}"><a href="{{ route('admin.about.info', ['data_id' => 1]) }}"><i data-feather="rss"></i><span>Veb sayt ma'lumotlari</span></a></li>

                        <li class="{{ Request::routeIs('admin.statistic.*') ? 'active' : '' }}"><a href="{{ route('admin.statistic.index') }}"><i data-feather="rss"></i><span>Statistika ro'yxati</span></a></li>

                        <li class="{{ Request::routeIs('admin.live.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.live.index') }}"><i data-feather="rss"></i><span>Live</span></a>
                        </li>

                        <li class="{{ Request::routeIs('admin.nc.*') ? 'active' : '' }}"><a href="{{ route('admin.nc.index') }}"><i data-feather="file-text"></i><span>Kategoriyalar ro'yxati</span></a></li>

                        <li class="{{ Request::routeIs('admin.news.*') ? 'active' : '' }}"><a href="{{ route('admin.news.index') }}"><i data-feather="rss"></i><span>Yangiliklar ro'yxati</span></a></li>

                        <li class="{{ Request::routeIs('admin.gallery.*') ? 'active' : '' }}"><a href="{{ route('admin.gallery.index') }}"><i data-feather="book-open"></i><span>Foto/Video Galereya</span></a></li>

                        <li class="{{ Request::routeIs('admin.speakers.*') ? 'active' : '' }}"><a href="{{ route('admin.speakers.index') }}"><i data-feather="book-open"></i><span>Spikerlar ro'yxati</span></a></li>

                        <li class="{{ Request::routeIs('admin.schedules.*') ? 'active' : '' }}"><a href="{{ route('admin.schedules.index') }}"><i data-feather="book-open"></i><span>Tadbirlar ro'yxati</span></a></li>

                        <li class="{{ Request::routeIs('admin.offers.*') ? 'active' : '' }}"><a href="{{ route('admin.offers.index') }}"><i data-feather="book-open"></i><span>Takliflar ro'yxati</span></a></li>

                    </ul>
                </li>
                @endrole

                @role('admin', 'super-admin', 'chacker')
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Mehmonlar boshqaruvi</h6>
                    <ul>
                        <li class="{{ Request::routeIs('admin.guests.*') ? 'active' : '' }}"><a href="{{ route('admin.guests.index') }}"><i data-feather="user"></i><span>Mehmonlar ro'yxati</span></a></li>

                        <li class="{{ Request::routeIs('admin.guests.*') ? 'active' : '' }}"><a href="{{ route('admin.guests.checkers') }}"><i data-feather="user"></i><span>Valyantorlar ro'yxati</span></a></li>

                        <li class="{{ Request::routeIs('admin.events.*') ? 'active' : '' }}"><a href="{{ route('admin.events.members') }}"><i data-feather="book-open"></i><span>Tadbir Mehmonlari</span></a></li>
                    </ul>
                </li>
                @endrole

                @role('admin', 'super-admin')
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Tizim boshqaruvi</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);" class="{{ Request::routeIs('admin.ud.*') || Request::routeIs('admin.users.*') ? 'subdrop active' : '' }}"><i data-feather="user"></i><span>Xodimlar boshqaruvi</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a class="{{ Request::routeIs('admin.ud.*') ? 'active' : '' }}" href="{{ route('admin.ud.index') }}">Loyiha boshqarmalari </a></li>
                                <li><a class="{{ Request::routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">Moderatorlar boshqaruvi </a></li>
                            </ul>
                        </li>

                        <li class="submenu">
                            <a href="javascript:void(0);" class="{{ Request::routeIs('admin.pt.*') || Request::routeIs('admin.pc.*') ? 'subdrop active' : '' }}">
                                <i data-feather="layers"></i><span>Loyihalar boshqaruvi</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a class="{{ Request::routeIs('admin.pt.*') ? 'active' : '' }}" href="{{ route('admin.pt.index') }}"><span>Loyiha turlari</span></a>
                                <li><a class="{{ Request::routeIs('admin.pc.*') ? 'active' : '' }}" href="{{ route('admin.pc.index') }}"><span>Loyiha yo'nalishlari</span></a>
                            </ul>
                        </li>
                        </li>
                    </ul>
                </li>
                @endrole

                <li class="submenu-open">
                    <h6 class="submenu-hdr">Yordam</h6>
                    <ul>
                        <li><a href="javascript:void(0);"><i data-feather="file-text"></i><span>Foydalanuvchi
                                    yo'riqnomasi</span></a></li>
                        <li><a href="javascript:void(0);"><i data-feather="lock"></i><span>Tizim yangiliklari</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGATION</li>
        <li class="{{ request()->is('/') ? 'active' : ''}}"><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li class="{{ request()->is('guru') ? 'active' : ''}}"><a href="/guru"><i class="fa fa-book"></i> <span>Guru</span></a></li>
        <li class="{{ request()->is('siswa') ? 'active' : ''}}"><a href="/siswa"><i class="fa fa-book"></i> <span>Siswa</span></a></li>
        <li class="{{ request()->is('user') ? 'active' : ''}}"><a href="/user"><i class="fa fa-book"></i> <span>User</span></a></li>
</ul>

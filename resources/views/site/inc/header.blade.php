<header class="section page-header">
    <div class="rd-navbar-wrap rd-navbar-corporate">
        <nav class="rd-navbar" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-fullwidth" data-xl-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-device-layout="rd-navbar-static" data-md-stick-up-offset="130px" data-lg-stick-up-offset="100px" data-stick-up="true" data-sm-stick-up="true" data-md-stick-up="true" data-lg-stick-up="true" data-xl-stick-up="true">
            <div class="rd-navbar-collapse-toggle" data-rd-navbar-toggle=".rd-navbar-collapse">
                <span></span>
            </div>
            <div class="rd-navbar-inner">
                <div class="rd-navbar-panel">
                    <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap">
                        <span></span>
                    </button>
                    <div class="rd-navbar-brand">
                        <a class="brand-name" href="{{ url('') }}">
                            <img class="logo-default" src="{{ url('logo.png') }}" alt="{{ config('app.name') }}" width="208" height="46" title="VIP Imóveis da Caixa">
                            <img class="logo-inverse" src="{{ url('logo.png') }}" alt="{{ config('app.name') }}" width="208" height="46" title="VIP Imóveis da Caixa">
                        </a>
                    </div>
                </div>
                <div class="rd-navbar-aside-center">
                    <div class="rd-navbar-nav-wrap">
                        <ul class="rd-navbar-nav">
                            <li class="active">
                                <a href="{{ url('') }}">Home</a>
                            </li>
                            @for($i = 0; $i <= 30; $i++)
                                <li>&nbsp;</li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

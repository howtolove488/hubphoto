<header>
  <div class="logo">
    <a href="index.html"><img src="img/logo.png" title="Magnetic" alt="Magnetic"/></a>
  </div><!-- end logo -->

  <div id="menu_icon"></div>
  <nav>
    <ul>
      <li>{{ link_to('/', '<i class="fa fa-home"></i> Home', 'class': current_class is defined ? 'select' : '') }}</li>
      <li>{{ link_to('/do-uong', '<i class="fa fa-coffee"></i> Đồ uống', 'class': current_class is defined ? 'select' : '') }}</li>
      <li>{{ link_to('/mon-an-vat', image('/img/icon/fastfood.svg')~' '~'Món ăn vặt', 'class': current_class is defined ? 'select' : '') }}</li>
      <li>{{ link_to('/mon-an-gia-dinh', '<i class="fa fa-cutlery"></i> Món ăn gia đình', 'class': current_class is defined ? 'select' : '') }}</li>
      <li>{{ link_to('/mon-an-theo-mua', '<i class="fa fa-leaf"></i> Món ăn theo mùa', 'class': current_class is defined ? 'select' : '') }}</li>
      <li>{{ link_to('/dac-san-vung-mien', '<i class="fa fa-globe"></i> Đặc sản các miền', 'class': current_class is defined ? 'select' : '') }}</li>
      <li>{{ link_to('/streetfood', '<i class="fa fa-street-view"></i> Street food', 'class': current_class is defined ? 'select' : '') }}</li>
    </ul>
  </nav><!-- end navigation menu -->

  <div class="footer clearfix">
    <ul class="social clearfix">
      <li><a href="#" class="fb" data-title="Facebook"></a></li>
      <li><a href="#" class="google" data-title="Google +"></a></li>
      <li><a href="#" class="behance" data-title="Behance"></a></li>
      <!--<li><a href="#" class="twitter" data-title="Twitter"></a></li>
      <li><a href="#" class="dribble" data-title="Dribble"></a></li>-->
      <li><a href="#" class="rss" data-title="RSS"></a></li>
    </ul><!-- end social -->

    <div class="rights">
      <p>©2014 magnetic by Pixelhint.com</p>
      <p>Editor <a href="">Hubphoto.io</a></p>
    </div><!-- end rights -->
  </div ><!-- end footer -->
</header><!-- end header -->
{{ get_content() }}

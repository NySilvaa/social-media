<aside id="asideDesktop">
    <header>
        <h2 class="logo txt_white"><i class='bx bxl-sketch align_box'></i> Social Media</h2>
    </header>

    <div class="actions">
        <ul class="menu_aside">
            <li><a href="#" class="txt_soft-ligth" data-status="chat"><i class="bx bx-message-rounded txt_white"></i> Messages</a> <span class="notifications txt_white">1</span></li>
            <li><a href="comunity" class="txt_soft-ligth" data-status="comunity"><i class='bx bx-group txt_white'></i> People</a></li>
            <li><a href="/social-media/" class="txt_soft-ligth" data-status="feed"><i class='bx bxs-news txt_white'></i> Feed</a> <span class="notifications txt_white">1</span></li>
            <li><a href="profile" class="txt_soft-ligth" data-status="profile"><i class="bx bx-user txt_white"></i> Profile</a></li>
        </ul>
    </div><!-- /.actions -->

    <div class="explore">
        <ul class="menu_aside">
            <li><a href="#" class="txt_soft-ligth" data-status="pages"><i class='bx bx-news'></i> Pages</a></li>
            <li><a href="#" class="txt_soft-ligth" data-status="events"><i class="bx bx-envelope"></i> Events</a></li>
            <li><a href="#" class="txt_soft-ligth" data-status="recomendations"><i class='bx bx-like'></i> Recomendations</a></li>
            <li><a href="#" class="txt_soft-ligth" data-status="saved"><i class='bx bx-bookmark'></i> Saved</a></li>
            <li><a href="#" class="txt_soft-ligth" data-status="memories"><i class='bx bx-folder-plus'></i> Memories</a></li>
        </ul>
    </div><!-- /.explore -->  

    <a href="?logoff" class="logoff txt_soft-ligth"><i class='bx bx-power-off txt_white'></i> Logoff</a>
</aside>    

<!-- O componente aside_mobile é para o menu que fica disponível apenas os ícones, ou seja, 
para dispositivos móveis e para usuários que desejam ampliar a tela do feed. Para o carregamento normal,
será mostrado o componente acima, ele será o principal. -->

<aside id="asideMobile" class="aside_mobile">
    <header>
        <h2 class="logo txt_white"><i class='bx bxl-sketch align_box'></i></h2>
    </header>

    <div class="actions">
        <ul class="menu_aside">
            <li><a href="#" class="txt_soft-ligth"><i class="bx bx-message-rounded txt_white"></i></a></li>
            <li><a href="#" class="txt_soft-ligth"><i class="bx bx-envelope txt_white"></i> </a></li>
            <li><a href="comunity" class="txt_soft-ligth"><i class='bx bx-group txt_white'></i> </a></li>
            <li class="active"><a href="/social-media/" class="txt_soft-ligth"><i class='bx bxs-news txt_white'></i> </a></li>
            <li><a href="profile" class="txt_soft-ligth"><i class="bx bx-user txt_white"></i></a></li>
        </ul>
    </div><!-- /.actions -->

    <div class="explore">
        <ul class="menu_aside">
            <li><a href="#" class="txt_soft-ligth"><i class='bx bx-news'></i></a></li>
            <li><a href="#" class="txt_soft-ligth"><i class="bx bx-envelope"></i></a></li>
            <li><a href="#" class="txt_soft-ligth"><i class='bx bx-like'></i></a></li>
            <li><a href="#" class="txt_soft-ligth"><i class='bx bx-bookmark'></i></a></li>
            <li><a href="#" class="txt_soft-ligth"><i class='bx bx-folder-plus'></i></a></li>
        </ul>
    </div><!-- /.explore -->  

    <a href="?logoff" class="logoff txt_soft-ligth"><i class='bx bx-power-off txt_white'></i></a>
</aside> 

<div class="loading_box" id="loading_box">
        <svg height="108px" width="108px" viewBox="0 0 128 128" class="loader">
            <defs>
            <clipPath id="loader-eyes">
                <circle transform="rotate(-40,64,64) translate(0,-56)" r="8" cy="64" cx="64" class="loader__eye1"></circle>
                <circle transform="rotate(40,64,64) translate(0,-56)" r="8" cy="64" cx="64" class="loader__eye2"></circle>
            </clipPath>
            <linearGradient y2="1" x2="0" y1="0" x1="0" id="loader-grad">
                <stop stop-color="#000" offset="0%"></stop>
                <stop stop-color="#fff" offset="100%"></stop>
            </linearGradient>
            <mask id="loader-mask">
                <rect fill="url(#loader-grad)" height="128" width="128" y="0" x="0"></rect>
            </mask>
            </defs>
            <g stroke-dasharray="175.93 351.86" stroke-width="12" stroke-linecap="round">
            <g>
                <rect clip-path="url(#loader-eyes)" height="64" width="128" fill="hsl(193,90%,50%)"></rect>
                <g stroke="hsl(193,90%,50%)" fill="none">
                <circle transform="rotate(180,64,64)" r="56" cy="64" cx="64" class="loader__mouth1"></circle>
                <circle transform="rotate(0,64,64)" r="56" cy="64" cx="64" class="loader__mouth2"></circle>
                </g>
            </g>
            <g mask="url(#loader-mask)">
                <rect clip-path="url(#loader-eyes)" height="64" width="128" fill="hsl(223,90%,50%)"></rect>
                <g stroke="hsl(223,90%,50%)" fill="none">
                <circle transform="rotate(180,64,64)" r="56" cy="64" cx="64" class="loader__mouth1"></circle>
                <circle transform="rotate(0,64,64)" r="56" cy="64" cx="64" class="loader__mouth2"></circle>
                </g>
            </g>
            </g>
        </svg>
    </div>
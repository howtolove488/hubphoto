        <div class="container">
            {{ image('/img/405.png', ['alt': 'Error 405', 'title': 'Error 405']) }}
            <h1>Not Allowed Access !</h1>
            <div class="group-link">
            {{ link_to('/authentication', '<i class="fa fa-user"></i> Auth', 'title': 'Login') }}
            {{ link_to('/', '<i class="fa fa-home"></i> Home', 'title': 'Back to home') }}
            </div>
        </div>
    </body>
</html>

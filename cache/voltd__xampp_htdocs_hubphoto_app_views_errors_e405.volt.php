        <div class="container">
            <?= $this->tag->image(['/img/405.png', ['alt' => 'Error 405', 'title' => 'Error 405']]) ?>
            <h1>Not Allowed Access !</h1>
            <div class="group-link">
            <?= $this->tag->linkTo(['/authentication', '<i class="fa fa-user"></i> Auth', 'title' => 'Login']) ?>
            <?= $this->tag->linkTo(['/', '<i class="fa fa-home"></i> Home', 'title' => 'Back to home']) ?>
            </div>
        </div>
    </body>
</html>

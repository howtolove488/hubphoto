        <div class="container">
            <?= $this->tag->image(['/img/404.png', ['alt' => 'Error 404', 'title' => 'Error 404']]) ?>
            <h1>Page Not Found !</h1>
            <div class="group-link">
            <?= $this->tag->linkTo(['/', '<i class="fa fa-home"></i> Home', 'title' => 'Back to home']) ?>
            </div>
        </div>
    </body>
</html>

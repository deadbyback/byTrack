<?php

use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<style type="text/css">
    body {
        color: #0f0f0f;
        background-color: #3286C6;
        background-size: cover;
    }
</style>
<div class="site-index">
    <div class="jumbotron" >

        <h1><?= Yii::t('app', 'Hello!')?></h1>

        <p class="lead"><?= Yii::t('app', 'Welcome to bug tracking service.')?></p>
        <p><?= Html::a(Yii::t('app', 'Welcome to byTrack!'), ['/'], ['class' => 'btn btn-lg btn-success'])?></p>

        </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>
        <div class="carousel">
        <?php echo \yii\bootstrap\Carousel::widget([
            'items' => [[
                'content' => '<img class="center-block" src="Pictures/programmist-razrabotchik.jpg" alt="Workers" width="1024" height="800" >',
                'caption' => '<h3>We keep up with the times</h3><p>We give only the right tools for our clients</p>',
                'options' => ['class' => 'my-class']
            ],
            [
                'content' => '<img class="center-block" src="Pictures/uspeh.jpg" alt="success" width="1024" height="800">',
                'caption' => '<h3>Way to success</h3><p>Together we will achieve results</p>',
            ],
            [
                'content' => '<img class="center-block" src="Pictures/f.png" alt="Finish" width="1024" height="800">',
                'caption' => '<h3>Long way</h3><p>Whatever the way to the top, we will reach it</p>',
            ],
            [
                'content' => '<img class="center-block" src="Pictures/133197.jpg" alt="Together" width="1024" height="800">',
                'caption' => '<h3>Together</h3><p>Let\'s go through the hard way of working together</p>',
            ],
            ],
            'options' => ['class' => 'carousel slide', 'data-interval' => '6000', ],
            'controls' => [
            '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>',
            '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
        ],
            ]); ?>
        </div>



    </div>
</div>
<!-- TODO: сделать плавный скролл, либо БЛОЧНЫЙ. -->
<script>
    /*var anchors = [];
    var currentAnchor = -1;
    var isAnimating  = false;

    $(function(){

        function updateAnchors() {
            anchors = [];
            $('.div').each(function(i, element){
                anchors.push( $(element).offset().top );
            });
        }

        $('body').on('mousewheel', function(e){
            e.preventDefault();
            e.stopPropagation();
            if( isAnimating ) {
                return false;
            }
            isAnimating  = true;
            // Increase or reset current anchor
            if( e.originalEvent.wheelDelta >= 0 ) {
                currentAnchor--;
            }else{
                currentAnchor++;
            }
            if( currentAnchor > (anchors.length - 1)
                || currentAnchor < 0 ) {
                currentAnchor = 0;
            }
            isAnimating  = true;
            $('html, body').animate({
                scrollTop: parseInt( anchors[currentAnchor] )
            }, 500, 'swing', function(){
                isAnimating  = false;
            });
        });

        updateAnchors();

    });*/
</script>
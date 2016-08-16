<html>
    <head>
            <meta http-equiv="Content-type" content="text/html; charset=utf-8">
            <title>Galleriffic | Thumbnail rollover effects and slideshow crossfades</title>
            <link rel="stylesheet" href="<?php echo getURL();?>uploadfile/css/basic.css" type="text/css" />
            <link rel="stylesheet" href="<?php echo getURL();?>uploadfile/css/galleriffic-2.css" type="text/css" />
            <script type="text/javascript" src="<?php echo getURL();?>uploadfile/js/jquery-1.3.2.js"></script>
            <script type="text/javascript" src="<?php echo getURL();?>uploadfile/js/jquery.galleriffic.js"></script>
            <script type="text/javascript" src="<?php echo getURL();?>uploadfile/js/jquery.opacityrollover.js"></script>
            <!-- We only want the thunbnails to display when javascript is disabled -->
            <script type="text/javascript">
                    document.write('<style>.noscript { display: none; }</style>');
            </script>
            <style>
                #gallery{
                    position: relative;
                }
                #action{
                    width: auto;
                    position: absolute;
                    left: 216px;
                    top: -6px;
                }
                #action span{
                    display: block;
                    float: left;
                    padding: 5px;
                    background-color: #60BF60;
                    margin-right: 10px;
                    cursor: pointer;
                    font-size: 13px;
                    font-family:Arial, Helvetica, sans-serif;
                }
                #action span:hover{
                    color: red;
                    text-decoration: underline;
                }
            </style>
            <script>
                $(function(){
                    $('#delete').click(function(){
                        $.post("<?php echo getURL();?>admin/upload/deleteFile",{'url':$('#gallery .download a').attr('href'),'thum':$('#gallery .download a').attr('thumfile')},function(data){
                            if(data == 'true')
                                document.location.reload();
                        });
                    });

                    $('#select').click(function(){
                        parent.getImage($('#gallery .download .image_url').text(),$('#gallery .download .thum_url').text());
                    });
                });
            </script>
    </head>
    <body>
            <div id="page">
                    <div id="container">
                            <!-- Start Advanced Gallery Html Containers -->
                            <div id="gallery" class="content">
                                    <div id="controls" class="controls"></div>
                                    <div id="action"><span id="select">Chọn</span><span id="delete">Xóa</span></div>
                                    <div class="slideshow-container">
                                            <div id="loading" class="loader"></div>
                                            <div id="slideshow" class="slideshow"></div>
                                    </div>
                                    <!-- hien thi them thong tin chi tiet -->
                                    <div id="caption" style="display:none;" class="caption-container"></div>
                                    
                            </div>
                            <div id="thumbs" class="navigation">
                                    <ul class="thumbs noscript">
                                        <?php  
                                            $uploaddir = Yii::getPathOfAlias('webroot').'/uploadfile/images/uploads/';
                                            /*$files1 = scandir($uploaddir);
                                            print_r($files1); */
                                            ?> 
                                            <?php
                                            //Kiểm tra tính hợp lệ của đường dẫn
                                            if (is_dir($uploaddir) ) {
                                                    //Thực hiện mở thư mục
                                                    $open_dir = opendir($uploaddir);
                                                    //Duyệt qua thư mục và file
                                                    while (($file = readdir($open_dir)) !== false) {
                                                        if($file != '.' && $file != '..') {  // skip self and parent pointing directories
                                                            $fullpath = getURL().'uploadfile/images/uploads/'.$file;
                                                            //Thực hiện thao tác trên file ?>
                                                            <li>
                                                                    <a class="thumb" name="leaf" href="<?php echo $fullpath;?>" title="<?php $file;?>">
                                                                            <img src="<?php echo $fullpath;?>" alt="<?php echo $file;?>" />
                                                                    </a>
                                                                    <div class="caption">
                                                                            <div class="download">
                                                                                    <a href="<?php echo $uploaddir.$file;?>" thumfile="<?php echo Yii::getPathOfAlias('webroot').'/uploadfile/images/thums/'.$file;?>">Download Original</a>
                                                                                    <span class="thum_url"><?php echo 'uploadfile/images/thums/'.$file;?></span>
                                                                                    <span class="image_url"><?php echo 'uploadfile/images/uploads/'.$file;?></span>
                                                                            </div>
                                                                            <div class="image-title"><?php $file;?></div>
                                                                            <div class="image-desc">Description</div>
                                                                    </div>
                                                            </li>
                                            <?php
                                                        }
                                                    }
                                                    closedir($open_dir);
                                                } else {
                                                    if (is_link($uploaddir)) {
                                                        print "link '$uploaddir' is skipped\n";
                                                        return;
                                                    }
                                                    //Thực hiện thao tác khác
                                                }
                                            ?>                                             
                                    </ul>
                            </div>
                            <div style="clear: both;"></div>
                    </div>
            </div>            
            <script type="text/javascript">
                    jQuery(document).ready(function($) {
                            // We only want these styles applied when javascript is enabled
                            $('div.navigation').css({'width' : '300px', 'float' : 'left'});
                            $('div.content').css('display', 'block');

                            // Initially set opacity on thumbs and add
                            // additional styling for hover effect on thumbs
                            var onMouseOutOpacity = 0.67;
                            $('#thumbs ul.thumbs li').opacityrollover({
                                    mouseOutOpacity:   onMouseOutOpacity,
                                    mouseOverOpacity:  1.0,
                                    fadeSpeed:         'fast',
                                    exemptionSelector: '.selected'
                            });

                            // Initialize Advanced Galleriffic Gallery
                            var gallery = $('#thumbs').galleriffic({
                                    delay:                     2500,
                                    numThumbs:                 12,
                                    preloadAhead:              10,
                                    enableTopPager:            true,
                                    enableBottomPager:         true,
                                    maxPagesToShow:            7,
                                    imageContainerSel:         '#slideshow',
                                    controlsContainerSel:      '#controls',
                                    captionContainerSel:       '#caption',
                                    loadingContainerSel:       '#loading',
                                    renderSSControls:          true,
                                    renderNavControls:         true,
                                    playLinkText:              'Play Slideshow',
                                    pauseLinkText:             'Pause Slideshow',
                                    prevLinkText:              '&lsaquo; Previous Image',
                                    nextLinkText:              'Next Image &rsaquo;',
                                    nextPageLinkText:          'Next &rsaquo;',
                                    prevPageLinkText:          '&lsaquo; Prev',
                                    enableHistory:             false,
                                    autoStart:                 false,
                                    syncTransitions:           true,
                                    defaultTransitionDuration: 900,
                                    onSlideChange:             function(prevIndex, nextIndex) {
                                            // 'this' refers to the gallery, which is an extension of $('#thumbs')
                                            this.find('ul.thumbs').children()
                                                    .eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
                                                    .eq(nextIndex).fadeTo('fast', 1.0);
                                    },
                                    onPageTransitionOut:       function(callback) {
                                            this.fadeTo('fast', 0.0, callback);
                                    },
                                    onPageTransitionIn:        function() {
                                            this.fadeTo('fast', 1.0);
                                    }
                            });
                    });
            </script>
    </body>
</html>
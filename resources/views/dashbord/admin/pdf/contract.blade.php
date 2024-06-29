<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <link href="{{asset('assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/custome/fonts.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/custome/extra.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&family=Tajawal:wght@500;700&display=swap" rel="stylesheet">
    <style>
        h1, h2, h3, h4, h5, h6, p, div, ul, li a, input, button, label, span, option, th, tr, i {
            font-family: 'Cairo', sans-serif !important;
            line-height: 1.7;
            text-align: right; /* Adjust text alignment */
        }
    </style>
    <style type="text/css">
        /* Add RTL-specific styles here */
        /* Adjust CSS properties as needed */
    </style>
</head>
<body id="printdiv">
<section class="main-body">
    <div class="print_forma  col-xs-12 ">
        <div class="piece-box no-padding"  >
            <div class="piece-body">
                <div class="col-xs-12 " >

                    <?php
                    $text_suggest = trim($content);
                    $textAr_suggest = explode("\n", $text_suggest);
                    $text_suggest = array_filter($textAr_suggest, 'trim');
                    ?>
                    <ul class="stylish-list" style="list-style-type: none;">
                        <?php
                        foreach($text_suggest as $line_sugg) { ?>
                        <li><?=str_replace("\n","",str_replace("\r","",$line_sugg))?></li>
                        <?php } ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>

<?
    $mysqli = new mysqli('localhost', '', '', '');
    $mysqli->query("set session character_set_connection=utf8;");
    $mysqli->query("set session character_set_results=utf8;");
    $mysqli->query("set session character_set_client=utf8;");
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <title>해누닷미</title>
    <!-- BASIC JS/CSS SOURCE IMPORT (FROM HAENU CDN) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.4/cjs/popper.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootoast@1.0.1/dist/bootoast.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootoast@1.0.1/dist/bootoast.min.css">
    <!-- BASIC JS/CSS SOURCE IMPORT (FROM OTHERS) -->
    <link href="//fonts.googleapis.com/css2?family=Black+Han+Sans&family=Nanum+Gothic:wght@400;700;800&family=Catamaran:wght@900&family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"/>
    <!-- BASIC SITE CSS -->
    <script>
        const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: Dark)').matches console.log(prefersDark);
    </script>
    <style>
        @media (prefers-color-scheme: dark) {
            body{
                background-color: #212529 !important;
            }
            .header .title{
                color: #5b95e3 !important;
            }
            .search-ico{
                color: white !important;
            }
            .search{
                color: white !important;
                background-color: #5b95e3 !important;
            }
            .search:focus{
                border-color: white !important;
            }
        }
        @media screen and (max-width: 576px) {
            .search-wrapper{
                margin-top: 30px !important;
            }
        }
        .catamaran{ font-family: 'Catamaran', sans-serif; }
        .blackhansans{ font-family: 'Black Han Sans', sans-serif; }
        body{
            background-color: #5b95e3;
        }
        .header{
            margin-top: 30px;
            margin-bottom: 10px;
        }
        .header .title{
            max-width: 1200px;
            width: 100vw;
            margin: 0 auto;
            text-align: left;
            color: white;
            font-weight: 900;
            font-size: 1.5em;
            position: relative;
            padding: 0 15px;
        }
        .haenucom{
            width: 28px;
            height: 28px;
            position: absolute;
            top: 3px;
            right: 10px;
        }
        .search-wrapper{
            margin-top: 100px;
        }
        .search:focus{
            outline: 0;
            border: 2px solid darkblue;
        }
        .search{
            width: 100%;
            height: 40px;
            border: 0;
            border-radius: 10px;
            margin-top: 10px;
            padding: 0 40px 0 10px;
        }
        .smallico{
            width: 30px;
            height: 30px;
            margin-right: 5px;
            background-color: white;
            border-radius: 15px;
            cursor: pointer;
        }
        .selected{
            border: 3px solid darkorange;
        }
        .search-ico{
            position: absolute;
            top: 51px;
            right: 25px;
            color: #5b95e3;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title catamaran">HAENU.ME<a href="//haenu.com"><img class="haenucom" src="haenu.com.png" alt="haenu.com"></a></div>
    </div>

    <div class="wrapper">
        <div class="container">
            <div class="row search-wrapper">
                <div class="col-md-2 col-lg-3"></div>
                <div class="col-sm-12 col-md-8 col-lg-6">
                    <div class="search-choose">
                        <span><img id="google" class="smallico selected" src="google.png" alt="google"></span>
                        <span><img id="naver" class="smallico" src="naver.png" alt="naver"></span>
                        <span><img id="daum" class="smallico" style="padding: 2px 0 2px 3px" src="daum.png" alt="daum"></span>
                        <span><img id="link" class="smallico" src="link.png" alt="link"></span>
                    </div>
                    <i class="fas fa-search search-ico"></i>
                    <input class="search noto" type="text">
                </div>
            </div>
        </div>
    </div>
</body>
<?
    $q1 = "SELECT * FROM me";
    $res1 = $mysqli->query($q1);
?>

<script>
    function isMobile() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    }
    $(document).on("keydown", function(e){
        // search function (daum)
        if((e.keyCode == 68 && e.altKey)){
            if(!$("#daum").hasClass('selected')){ $("#daum").addClass('selected'); }
            if($("#naver").hasClass('selected')){ $("#naver").removeClass('selected'); }
            if($("#google").hasClass('selected')){ $("#google").removeClass('selected'); }
            if($("#link").hasClass('selected')){ $("#link").removeClass('selected'); }
            $(".search").focus();
            return false;
        }
        // search function (google)
        if((e.keyCode == 71 && e.altKey)){
            if(!$("#google").hasClass('selected')){ $("#google").addClass('selected'); }
            if($("#naver").hasClass('selected')){ $("#naver").removeClass('selected'); }
            if($("#daum").hasClass('selected')){ $("#daum").removeClass('selected'); }
            if($("#link").hasClass('selected')){ $("#link").removeClass('selected'); }
            $(".search").focus();
            return false;
        }
        // search function (naver)
        if((e.keyCode == 78 && e.altKey)){
            if(!$("#naver").hasClass('selected')){ $("#naver").addClass('selected'); }
            if($("#google").hasClass('selected')){ $("#google").removeClass('selected'); }
            if($("#daum").hasClass('selected')){ $("#daum").removeClass('selected'); }
            if($("#link").hasClass('selected')){ $("#link").removeClass('selected'); }
            $(".search").focus();
            return false;
        }
        // search function (link)
        if((e.keyCode == 76 && e.altKey)){
            if(!$("#link").hasClass('selected')){ $("#link").addClass('selected'); }
            if($("#google").hasClass('selected')){ $("#google").removeClass('selected'); }
            if($("#daum").hasClass('selected')){ $("#daum").removeClass('selected'); }
            if($("#naver").hasClass('selected')){ $("#naver").removeClass('selected'); }
            $(".search").focus();
            return false;
        }
        if($(".search").is(":focus")){
            if(e.keyCode == 13){
                var search = $(".search").val();
                if(search == ''){
                    bootoast.toast({
                        message: '검색어를 입력해주세요',
                        type: 'danger',
                        position: 'top'
                    });
                    return false;
                }
                if($("#google").hasClass('selected')){
                    location.href="https://www.google.com/search?q=" + search;
                }
                if($("#naver").hasClass('selected')){
                    location.href="https://search.naver.com/search.naver?query=" + search;
                }
                if($("#daum").hasClass('selected')){
                    location.href="https://search.daum.net/search?q=" + search;
                }
                if($("#link").hasClass('selected')){
                    location.href="//" + search;
                }
            }
            return e;
        }

        if(e.keyCode == 32){
            $(".search").focus();
            return false;
        }

        <?
            while($data1 = mysqli_fetch_array($res1, MYSQLI_BOTH)){
                $key = $data1['num'];
                $basic = $data1['basic'];
                $alt = $data1['alt'];
                $shift = $data1['shift'];
                $esc = $data1['esc'];
                // esc
                if($esc != null){
                    echo "if(e.keyCode == $key && !e.altKey && !e.shiftKey && e.keyCode == 27){ event.keyCode = 0; event.returnValue = false; location.href=\"$esc\"; }";
                }
                // basic
                if($basic != null){
                    echo "if(e.keyCode == $key && !e.altKey && !e.shiftKey && e.keyCode != 27){ event.keyCode = 0; event.returnValue = false; location.href=\"$basic\"; }";
                }
                // alt
                if($alt != null){
                    echo "if(e.keyCode == $key && e.altKey && !e.shiftKey && e.keyCode != 27){ event.keyCode = 0; event.returnValue = false; location.href=\"$alt\"; }";
                }
                // shift
                if($shift != null){
                    echo "if(e.keyCode == $key && !e.altKey && e.shiftKey && e.keyCode != 27){ event.keyCode = 0; event.returnValue = false; location.href=\"$shift\"; }";
                }
            }
        ?>
    });

    $(document).ready(function(){
        $("#daum").click(function(){
            if(!$("#daum").hasClass('selected')){ $("#daum").addClass('selected'); }
            if($("#naver").hasClass('selected')){ $("#naver").removeClass('selected'); }
            if($("#google").hasClass('selected')){ $("#google").removeClass('selected'); }
            if($("#link").hasClass('selected')){ $("#link").removeClass('selected'); }
            return false;
        });
        $("#naver").click(function(){
            if(!$("#naver").hasClass('selected')){ $("#naver").addClass('selected'); }
            if($("#google").hasClass('selected')){ $("#google").removeClass('selected'); }
            if($("#daum").hasClass('selected')){ $("#daum").removeClass('selected'); }
            if($("#link").hasClass('selected')){ $("#link").removeClass('selected'); }
            return false;
        });
        $("#google").click(function(){
            if(!$("#google").hasClass('selected')){ $("#google").addClass('selected'); }
            if($("#naver").hasClass('selected')){ $("#naver").removeClass('selected'); }
            if($("#daum").hasClass('selected')){ $("#daum").removeClass('selected'); }
            if($("#link").hasClass('selected')){ $("#link").removeClass('selected'); }
            return false;
        })
        $("#link").click(function(){
            if(!$("#link").hasClass('selected')){ $("#link").addClass('selected'); }
            if($("#google").hasClass('selected')){ $("#google").removeClass('selected'); }
            if($("#daum").hasClass('selected')){ $("#daum").removeClass('selected'); }
            if($("#naver").hasClass('selected')){ $("#naver").removeClass('selected'); }
            return false;
        });
        $(".search-ico").click(function(){
            var search = $(".search").val();
            if(search == ''){
                bootoast.toast({
                    message: '검색어를 입력해주세요',
                    type: 'danger',
                    position: 'top'
                });
                return false;
            }
            if($("#google").hasClass('selected')){
                location.href="https://www.google.com/search?q=" + search;
            }
            if($("#naver").hasClass('selected')){
                location.href="https://search.naver.com/search.naver?query=" + search;
            }
            if($("#daum").hasClass('selected')){
                location.href="https://search.daum.net/search?q=" + search;
            }
            if($("#link").hasClass('selected')){
                location.href="//" + search;
            }
        })
    });

    if(isMobile()){
        $(".search").focus();
    }

</script>
</html>

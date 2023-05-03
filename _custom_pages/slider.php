<?php

require '../wp-load.php';

if (!is_user_logged_in()) {
    exit('Please login');
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slider</title>

    <style>
        /*! CSS Used from: https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css */
        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        h2,
        h3 {
            margin-top: 0;
            margin-bottom: .5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        h2 {
            font-size: calc(1.325rem + .9vw);
        }

        @media (min-width:1200px) {
            h2 {
                font-size: 2rem;
            }
        }

        h3 {
            font-size: calc(1.3rem + .6vw);
        }

        @media (min-width:1200px) {
            h3 {
                font-size: 1.75rem;
            }
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        a {
            color: #0d6efd;
            text-decoration: underline;
        }

        a:hover {
            color: #0a58ca;
        }

        img {
            vertical-align: middle;
        }

        button {
            border-radius: 0;
        }

        button:focus:not(:focus-visible) {
            outline: 0;
        }

        button {
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
        }

        button {
            text-transform: none;
        }

        [type=button],
        button {
            -webkit-appearance: button;
        }

        [type=button]:not(:disabled),
        button:not(:disabled) {
            cursor: pointer;
        }

        .container {
            width: 100%;
            padding-right: var(--bs-gutter-x, .75rem);
            padding-left: var(--bs-gutter-x, .75rem);
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width:576px) {
            .container {
                max-width: 540px;
            }
        }

        @media (min-width:768px) {
            .container {
                max-width: 720px;
            }
        }

        @media (min-width:992px) {
            .container {
                max-width: 960px;
            }
        }

        @media (min-width:1200px) {
            .container {
                max-width: 1140px;
            }
        }

        @media (min-width:1400px) {
            .container {
                max-width: 1320px;
            }
        }

        .carousel {
            position: relative;
        }

        .carousel-inner {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .carousel-inner::after {
            display: block;
            clear: both;
            content: "";
        }

        .carousel-item {
            position: relative;
            display: none;
            float: left;
            width: 100%;
            margin-right: -100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            transition: transform .6s ease-in-out;
        }

        @media (prefers-reduced-motion:reduce) {
            .carousel-item {
                transition: none;
            }
        }

        .carousel-item.active {
            display: block;
        }

        .carousel-fade .carousel-item {
            opacity: 0;
            transition-property: opacity;
            transform: none;
        }

        .carousel-fade .carousel-item.active {
            z-index: 1;
            opacity: 1;
        }

        .carousel-indicators {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 2;
            display: flex;
            justify-content: center;
            padding: 0;
            margin-right: 15%;
            margin-bottom: 1rem;
            margin-left: 15%;
            list-style: none;
        }

        .carousel-indicators [data-bs-target] {
            box-sizing: content-box;
            flex: 0 1 auto;
            width: 30px;
            height: 3px;
            padding: 0;
            margin-right: 3px;
            margin-left: 3px;
            text-indent: -999px;
            cursor: pointer;
            background-color: #fff;
            background-clip: padding-box;
            border: 0;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
            opacity: .5;
            transition: opacity .6s ease;
        }

        @media (prefers-reduced-motion:reduce) {
            .carousel-indicators [data-bs-target] {
                transition: none;
            }
        }

        .carousel-indicators .active {
            opacity: 1;
        }

        .carousel-caption {
            position: absolute;
            right: 15%;
            bottom: 1.25rem;
            left: 15%;
            padding-top: 1.25rem;
            padding-bottom: 1.25rem;
            color: #fff;
            text-align: center;
        }

        .carousel-dark .carousel-indicators [data-bs-target] {
            background-color: #000;
        }

        .carousel-dark .carousel-caption {
            color: #000;
        }

        .d-block {
            display: block !important;
        }

        .w-100 {
            width: 100% !important;
        }

        .mb-1 {
            margin-bottom: .25rem !important;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        /*! CSS Used from: https://fuelcycle.com/wp-content/themes/starter-theme-1.x/assets/css/homepage.css?ver=6.2 ; media=screen */
        @media screen {
            #tabbed-slider {
                margin-top: 120px;
                padding: 0 30px;
            }

            @media (max-width: 767px) {
                #tabbed-slider {
                    padding: 0;
                }
            }

            #tabbed-slider .carousel {
                height: 100%;
            }

            #tabbed-slider .carousel .carousel-inner {
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .tab-icon {
                position: absolute;
            }

            @media (max-width: 767px) {
                .tab-icon {
                    position: unset;
                }
            }

            .tab-icon.active {
                display: block;
            }

            .tab-icon.hidden {
                display: none;
            }

            .tabbed-slider-heading {
                font-size: 36px;
                line-height: 111.1111111111%;
                margin-bottom: 30px;
            }

            @media (max-width: 1199px) {
                .tabbed-slider-heading {
                    font-size: 30px;
                    text-align: center;
                }
            }

            .tabbed-slider-button-wrapper {
                margin-bottom: 45px;
            }

            @media (max-width: 1199px) {
                .tabbed-slider-button-wrapper {
                    margin-bottom: 58px;
                    text-align: center;
                }
            }

            .tabbed-slider-wrapper {
                box-shadow: rgba(0, 0, 0, 0.2) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.2) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;
                border-radius: 10px;
                margin-bottom: 30px;
                padding-left: 40px;
                padding-right: 40px;
                padding-bottom: 65px;
                padding-top: 35px;
            }

            @media (max-width: 767px) {
                .tabbed-slider-wrapper {
                    border-radius: 0;
                }
            }

            .tabs-images-wrapper {
                display: grid;
            }

            @media (min-width: 1200px) {
                .tabs-images-wrapper {
                    grid-template-columns: 1fr 1fr;
                    grid-gap: 30px;
                }
            }

            @media (max-width: 1199px) {
                .tabs-images-wrapper {
                    padding: 0 36px;
                }
            }

            @media (max-width: 767px) {
                .tabs-images-wrapper {
                    text-align: center;
                }
            }

            @media (max-width: 1199px) {
                .tabs-images-wrapper .tabbed-left {
                    display: none;
                }
            }

            .single-tab-wrapper {
                display: grid;
                grid-template-columns: 75px 1fr;
            }

            @media (max-width: 767px) {
                .single-tab-wrapper {
                    grid-template-columns: 1fr;
                }
            }

            @media (min-width: 1200px) {
                .single-tab-wrapper--carousel {
                    display: none;
                }
            }

            .single-tab-wrapper--carousel.hidden {
                display: none;
            }

            .single-tab-text a,
            .single-tab-text a:hover,
            .single-tab-text a:visited,
            .single-tab-text a:active {
                color: #212529 !important;
            }

            .single-tab-icon {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .single-tab-icon img {
                width: 100%;
                height: 100%;
                max-height: 26px;
                max-width: 30px;
                margin-top: 8px;
            }

            @media (max-width: 767px) {
                .single-tab-icon img {
                    margin-top: 0;
                }
            }

            #tabbed-slider .carousel-item {
                position: unset;
            }

            #tabbed-slider .carousel-caption {
                position: unset;
            }

            @media (min-width: 1200px) {
                #tabbed-slider .carousel-caption {
                    position: absolute;
                    right: 5%;
                    left: 5%;
                }
            }

            #tabbed-slider .carousel-indicators {
                margin-bottom: -3px;
            }

            .tab-subtitle {
                text-transform: uppercase;
                color: #e85948;
                letter-spacing: 2px;
                font-size: 13px;
                line-height: 1;
            }

            .tab-title {
                font-size: 24px;
                line-height: 28px;
                margin-bottom: 14px;
            }

            @media (max-width: 1199px) {
                .tab-title {
                    margin-bottom: 8px;
                }
            }

            .tab-paragraph {
                font-size: 16px;
                line-height: 112.5%;
            }

            @media (max-width: 1199px) {
                .tab-paragraph {
                    padding-bottom: 34px;
                    font-size: 14px;
                }
            }

            #tabbed-slider .carousel-indicators button {
                width: 7px;
                height: 7px;
                border-radius: 50%;
                margin-right: 10px;
                margin-left: 10px;
                opacity: 0.2;
            }

            #tabbed-slider .carousel-caption p {
                font-size: 16px;
            }

            .carousel-indicators .active {
                opacity: 0.5 !important;
            }
        }

        /*! CSS Used from: https://fuelcycle.com/wp-content/themes/starter-theme-1.x/assets/css/site.css?ver=6.2 ; media=screen */
        @media screen {
            h2 {
                font-family: "Greycliff Medium", "Open Sans", sans-serif;
                font-weight: 500;
                font-size: 32px;
                line-height: 40px;
                color: #49494b;
            }

            h3 {
                font-family: "Greycliff Medium", "Open Sans", sans-serif;
                font-size: 24px;
            }

            p {
                font-family: "Greycliff Medium", "Open Sans", sans-serif;
                font-weight: 500;
                font-size: 16px;
                line-height: 26px;
                color: #49494b;
            }

            a {
                text-decoration: none !important;
            }

            a:hover {
                text-decoration: none !important;
                color: #613f97 !important;
            }

            .main-btn {
                border: #e85948;
                background-color: #e85948 !important;
                min-width: 151px;
                padding-bottom: 16px !important;
                padding-top: 14px !important;
                padding-left: 25px;
                padding-right: 25px;
                border-radius: 4px !important;
                justify-self: center;
                box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
                display: inline-block;
                font-family: "Greycliff", "Open Sans", sans-serif !important;
                font-size: 14px !important;
                line-height: 1 !important;
                text-align: center !important;
                color: #ffffff !important;
                text-decoration: none !important;
                white-space: nowrap !important;
                transition: all 1s;
            }

            .main-btn:hover {
                background-color: #613f97 !important;
                color: white !important;
                transition: all 1s;
            }

            .container-1088 {
                max-width: 1088px !important;
            }

            .horizontal-line-clean {
                max-width: 100%;
                border-top: 1px solid rgba(73, 73, 75, 0.2);
            }
        }

        /*! CSS Used fontfaces */
        @font-face {
            font-family: "Greycliff Medium";
            src: url(https://fuelcycle.com/wp-content/themes/starter-theme-1.x/assets/fonts/GreycliffCF-Medium.otf);
            font-weight: medium;
        }

        @font-face {
            font-family: "Greycliff";
            src: url(https://fuelcycle.com/wp-content/themes/starter-theme-1.x/assets/fonts/GreycliffCF-Regular.otf);
            font-weight: normal;
        }

        body {

            font-family: "Greycliff Medium", "Open Sans", sans-serif;
        }
    </style>
</head>

<body>



    <section id="tabbed-slider">
        <div class="container container-1088 tabbed-slider-wrapper">
            <!-- <h2 class="tabbed-slider-heading">
                The FC Market Research Cloud™
            </h2>
            <div class="tabbed-slider-button-wrapper">
                <a href="/market-research-cloud/" class="main-btn tabbed-slider-button">
                    Discover more
                </a>
            </div> -->
            <div class="tabs-images-wrapper">
                <div class="tabbed-left">
                    <div class="mb-1"></div>
                    <div class="horizontal-line-clean"></div>
                    <div class="mb-4"></div>
                    <div class="single-tab-wrapper single-tab-wrapper--tab">
                        <div class="single-tab-icon">
                            <img src="https://fuelcycle.com/wp-content/uploads/2021/12/group-icon.svg" alt="" class="tab-icon tab-icon-color active">
                            <img src="https://fuelcycle.com/wp-content/uploads/2022/02/community-icon-disabled.svg" alt="" class="tab-icon tab-icon-gray hidden">
                        </div>
                        <div class="single-tab-text">
                            <a href="/community/">
                                <span class="tab-subtitle">FC Community</span>
                                <h3 class="tab-title">
                                    Stay connected with your key audiences
                                </h3>
                                <p class="tab-paragraph">
                                    Capture real-time feedback with surveys, discussions, diary studies, and live chats with an enterprise-grade hub built for constant customer engagement.
                                </p>
                            </a>
                        </div><a href="/community/">
                        </a>
                    </div>
                    <div class="mb-3"></div>
                    <div class="horizontal-line-clean"></div>
                    <div class="mb-4"></div>
                    <div class="single-tab-wrapper single-tab-wrapper--tab">
                        <div class="single-tab-icon">
                            <img src="https://fuelcycle.com/wp-content/uploads/2021/12/ignition-icon.svg" alt="" class="tab-icon tab-icon-color hidden">
                            <img src="https://fuelcycle.com/wp-content/uploads/2022/02/ignition-icon-disabled.svg" alt="" class="tab-icon tab-icon-gray active">
                        </div>
                        <div class="single-tab-text">
                            <a href="/ignition/">
                                <span class="tab-subtitle">FC Ignition</span>
                                <h3 class="tab-title">
                                    Get immediate answers to pressing questions
                                </h3>
                                <p class="tab-paragraph">
                                    Agile quantitative insight tools and advanced analytics deliver actionable intelligence.
                                </p>
                            </a>
                        </div><a href="/ignition/">
                        </a>
                    </div>
                    <div class="mb-3"></div>
                    <div class="horizontal-line-clean"></div>
                    <div class="mb-4"></div>
                    <div class="single-tab-wrapper single-tab-wrapper--tab">
                        <div class="single-tab-icon">
                            <img src="https://fuelcycle.com/wp-content/uploads/2021/12/marketplace-icon.svg" alt="" class="tab-icon tab-icon-color hidden">
                            <img src="https://fuelcycle.com/wp-content/uploads/2022/02/exchange-icon-disabled.svg" alt="" class="tab-icon tab-icon-gray active">
                        </div>
                        <div class="single-tab-text">
                            <a href="/fc-exchange/">
                                <span class="tab-subtitle">FC Exchange</span>
                                <h3 class="tab-title">
                                    Unify all your insights in the cloud
                                </h3>
                                <p class="tab-paragraph">
                                    Build your own market research suite with solutions from the FCX app store.
                                </p>
                            </a>
                        </div><a href="/fc-exchange/">
                        </a>
                    </div>
                    <div class="mb-3"></div>
                    <div class="horizontal-line-clean"></div>
                </div>
                <div class="tabbed-right">
                    <div id="carouselExampleIndicators" class="carousel slide carousel-dark carousel-fade" data-bs-ride="carousel" data-bs-interval="false">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-label="Slide 1">
                            </button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class="" aria-label="Slide 2">
                            </button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" class="" aria-label="Slide 3">
                            </button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="https://fuelcycle.com/wp-content/uploads/2022/10/Screen-Shot-2022-10-28-at-1.44.27-PM.png" alt="">
                                <div class="carousel-caption">
                                    <p>
                                        Understand key drivers of purchase intent to increase revenue &amp; adoption
                                    </p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="https://fuelcycle.com/wp-content/uploads/2022/06/IGNITION.png" alt="">
                                <div class="carousel-caption">
                                    <p>
                                        Quantitative insight tools and advanced analytics
                                    </p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="https://fuelcycle.com/wp-content/uploads/2022/06/FCX.png" alt="">
                                <div class="carousel-caption">
                                    <p>
                                        The marketplace for market research tools
                                    </p>
                                </div>
                            </div>
                            <div class="single-tab-wrapper single-tab-wrapper--carousel">
                                <div class="single-tab-icon">
                                    <img src="https://fuelcycle.com/wp-content/uploads/2021/12/group-icon.svg" alt="" class="tab-icon tab-icon-color active">
                                </div>
                                <div class="single-tab-text">
                                    <a href="/community/">
                                        <span class="tab-subtitle">FC Community</span>
                                        <h3 class="tab-title">
                                            Stay connected with your key audiences
                                        </h3>
                                        <p class="tab-paragraph">
                                            Capture real-time feedback with surveys, discussions, diary studies, and live chats with an enterprise-grade hub built for constant customer engagement.
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="single-tab-wrapper single-tab-wrapper--carousel hidden">
                                <div class="single-tab-icon">
                                    <img src="https://fuelcycle.com/wp-content/uploads/2021/12/ignition-icon.svg" alt="" class="tab-icon tab-icon-color active">
                                </div>
                                <div class="single-tab-text">
                                    <a href="/ignition/">
                                        <span class="tab-subtitle">FC Ignition</span>
                                        <h3 class="tab-title">
                                            Get immediate answers to pressing questions
                                        </h3>
                                        <p class="tab-paragraph">
                                            Agile quantitative insight tools and advanced analytics deliver actionable intelligence.
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="single-tab-wrapper single-tab-wrapper--carousel hidden">
                                <div class="single-tab-icon">
                                    <img src="https://fuelcycle.com/wp-content/uploads/2021/12/marketplace-icon.svg" alt="" class="tab-icon tab-icon-color active">
                                </div>
                                <div class="single-tab-text">
                                    <a href="/fc-exchange/">
                                        <span class="tab-subtitle">FC Exchange</span>
                                        <h3 class="tab-title">
                                            Unify all your insights in the cloud
                                        </h3>
                                        <p class="tab-paragraph">
                                            Build your own market research suite with solutions from the FCX app store.
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
        window.addEventListener('DOMContentLoaded', function() {

            const singleTabs = document.querySelectorAll('.single-tab-wrapper--tab')
            const singleTabsIconsColor = document.querySelectorAll('.single-tab-wrapper--tab .tab-icon-color')
            const singleTabsIconsGray = document.querySelectorAll('.single-tab-wrapper--tab .tab-icon-gray')
            const singleTabsImages = document.querySelectorAll('#tabbed-slider .carousel-item')
            const carouselIndicators = document.querySelectorAll('#tabbed-slider .carousel-indicators button')
            const singleTabsCarousel = document.querySelectorAll('.single-tab-wrapper--carousel')

            singleTabsCarousel.forEach((tab, index) => {
                if (index) {
                    tab.classList.add('hidden')
                }
            })

            for (const [index, tab] of singleTabs.entries()) {
                tab.addEventListener('mouseenter', function() {
                    singleTabsIconsColor.forEach((icon) => {
                        icon.classList.remove('active')
                        icon.classList.add('hidden')
                    })
                    singleTabsIconsGray.forEach((icon) => {
                        icon.classList.remove('hidden')
                        icon.classList.add('active')
                    })
                    singleTabsImages.forEach((image) => {
                        image.classList.remove('active')
                    })
                    carouselIndicators.forEach((indicator) => {
                        indicator.classList.remove('active')
                    })

                    singleTabsIconsGray[index].classList.add('hidden')
                    singleTabsIconsGray[index].classList.remove('active')

                    singleTabsIconsColor[index].classList.add('active')
                    singleTabsIconsColor[index].classList.remove('hidden')

                    singleTabsImages[index].classList.add('active')

                    carouselIndicators[index].classList.add('active')
                })
            }

            for (const [index, indicator] of carouselIndicators.entries()) {
                indicator.addEventListener('click', function() {
                    console.log('clicked')
                    singleTabsIconsColor.forEach((icon) => {
                        icon.classList.remove('active')
                        icon.classList.add('hidden')
                    })
                    singleTabsIconsGray.forEach((icon) => {
                        icon.classList.remove('hidden')
                        icon.classList.add('active')
                    })
                    singleTabsImages.forEach((image) => {
                        image.classList.remove('active')
                    })
                    carouselIndicators.forEach((indicator) => {
                        indicator.classList.remove('active')
                    })
                    singleTabsCarousel.forEach((tab) => {
                        tab.classList.add('hidden')
                    })

                    singleTabsIconsGray[index].classList.add('hidden')
                    singleTabsIconsGray[index].classList.remove('active')

                    singleTabsIconsColor[index].classList.add('active')
                    singleTabsIconsColor[index].classList.remove('hidden')

                    singleTabsImages[index].classList.add('active')

                    carouselIndicators[index].classList.add('active')

                    singleTabsCarousel[index].classList.remove('hidden')
                })
            }

        });
    </script>
</body>

</html>
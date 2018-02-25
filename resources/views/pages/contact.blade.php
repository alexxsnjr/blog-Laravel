@extends('layouts.layout')

@section('content')
    <section class="pages container">
        <div class="page page-contact">
            <h1 class="text-capitalize">contact us</h1>
            <p>Nam in maximus arcu, ac aliquam tellus. Donec vestibulum ipsum nunc, at placerat ante posuere non. Integer at dui a lacus suscipit elementum id non massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc eu neque eros. Ut eu quam justo.</p>
            <div class="divider-2" style="margin:25px 0;"></div>
            <div class="form-contact">
                <form action="#">
                    <div class="input-container container-flex space-between">
                        <input type="text" placeholder="Your Name" class="input-name">
                        <input type="text" placeholder="Email" class="input-email">
                    </div>
                    <div class="input-container">
                        <input type="text" placeholder="Subject" class="input-subject">
                    </div>
                    <div class="input-container">
                        <textarea name="" id="" cols="30" rows="10" placeholder="Your Message"></textarea>
                    </div>
                    <div class="send-message">
                        <a href="#" class="text-uppercase c-green">send message</a>
                    </div>
                </form>
            </div>

        </div>
    </section>


    <section class="footer">
        <footer>
            <div class="container">
                <figure class="logo"><img src="img/logo.png" alt=""></figure>
                <nav>
                    <ul class="container-flex space-center list-unstyled">
                        <li><a href="index.html" class="text-uppercase c-white">home</a></li>
                        <li><a href="about.html" class="text-uppercase c-white">about</a></li>
                        <li><a href="archive.html" class="text-uppercase c-white">archive</a></li>
                        <li><a href="contact.html" class="text-uppercase c-white">contact</a></li>
                    </ul>
                </nav>
                <div class="divider-2"></div>
                <p>Nunc placerat dolor at lectus hendrerit dignissim. Ut tortor sem, consectetur nec hendrerit ut, ullamcorper ac odio. Donec viverra ligula at quam tincidunt imperdiet. Nulla mattis tincidunt auctor.</p>
                <div class="divider-2" style="width: 80%;"></div>
                <p>© 2017 - Zendero. All Rights Reserved. Designed & Developed by <span class="c-white">Agencia De La Web</span></p>
                <ul class="social-media-footer list-unstyled">
                    <li><a href="#" class="fb"></a></li>
                    <li><a href="#" class="tw"></a></li>
                    <li><a href="#" class="in"></a></li>
                    <li><a href="#" class="pn"></a></li>
                </ul>
            </div>
        </footer>
    </section>
@endsection
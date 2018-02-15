<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cupon Tours</title>

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/index.css">

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/general.js"></script>
    <script src="js/index.js"></script>
    <script src="js/header.js"></script>
</head>
<body>
<div class="scroll-to-top" id="btn-scroll-top" onclick="topFunction()">
    <i class="fa fa-angle-double-up"></i>
</div>
<div class="home-banner"></div>
<div class="main-container">

    <?php include_once 'views/header.php'; ?>

    <div class="body-container">
        <section class="search-tabs main-section">
            <div class="sec-container">
                <ul>
                    <li class="selected"><i class="fa fa-building"></i><a href="#" id="sec-hotels">HOTELS</a></li>
                    <li><i class="fa fa-suitcase"></i><a href="#" id="sec-tours">TOURS</a></li>
                    <li><i class="fa fa-car"></i><a href="#" id="sec-car-rent">CAR RENT</a></li>
                    <li><i class="fa fa-ship"></i><a href="#" id="sec-cruises">CRUISES</a></li>
                </ul>

                <section class="sec-search selected" id="sec-hotels">
                    <div class="sec-title">FIND HOTELS</div>
                </section>

                <section class="sec-search" id="sec-tours">
                    <div class="sec-title">FIND TOURS</div>
                </section>

                <section class="sec-search" id="sec-car-rent">
                    <div class="sec-title">FIND CAR RENT</div>
                </section>

                <section class="sec-search" id="sec-cruises">
                    <div class="sec-title">FIND CRUISES</div>
                </section>
            </div>
        </section>

        <section class="home-info main-section">
            <div class="sec-container">
                <table width="100" id="tbl-home-info" border="0">
                    <tr>
                        <td colspan="3">Be Born Again</td>
                        <td rowspan="8" width="40%">
                            <img src="images/about-us-1.jpg" id="img-about-us" alt="about us">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><h2>We are exploore</h2></td>
                    </tr>
                    <tr>
                        <td colspan="3">Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut eim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex commodo consequat uisas aute irure dolor ullamco laboris nisi in reprehenderit.</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-long-arrow-right"></i>First Class Flights</td>
                        <td><i class="fa fa-long-arrow-right"></i>Handpicked Hotels</td>
                        <td><i class="fa fa-long-arrow-right"></i>Accesibility managment</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-long-arrow-right"></i>5 Star Accommodations</td>
                        <td><i class="fa fa-long-arrow-right"></i>Accesibility managment</td>
                        <td><i class="fa fa-long-arrow-right"></i>+120 Premium city tours</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-long-arrow-right"></i>Inclusive Packages</td>
                        <td><i class="fa fa-long-arrow-right"></i>10 Languages available</td>
                        <td><i class="fa fa-long-arrow-right"></i>Handpicked Hotels</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-long-arrow-right"></i>Latest Model Vehicles</td>
                        <td><i class="fa fa-long-arrow-right"></i>+120 Premium city tours</td>
                        <td><i class="fa fa-long-arrow-right"></i>10 Languages available</td>
                    </tr>
                </table>

                <div class="col-buttons">
                    <div id="btn-purchase-now">PURCHASE NOW</div>
                    <div id="btn-exploore-more">EXPLOORE MORE</div>
                </div>
            </div>
        </section>

        <section class="pack-and-go main-section">
            <div class="sec-container">
                <div class="sec-section">
                    <h3>PACK AND GO</h3>
                    <h1>AWESOME TOURS</h1>

                    <section class="tour-articles">
                        <article class="info-tour">
                            <div class="img-container">
                                <div class="shadowing"></div>
                                <img src="images/tour-miami.jpg" alt="">
                                <div class="tour-name">
                                    <span>MIAMI / ORLANDO / BAHAMAS</span>
                                    <i class="fa fa-plus"></i>
                                </div>
                            </div>

                            <div class="tour-statistics">
                                <div class="seen">
                                    <i class="fa fa-eye"></i>
                                    <span class="seen-counter">38</span>
                                </div>
                                <div class="likes">
                                    <i class="fa fa-heart"></i>
                                    <span class="likes-counter">1</span>
                                </div>
                            </div>

                            <div class="tour-description">
                                <div class="tour-price currency"><i class="fa fa-dollar"></i> 1298</div>
                                <div class="tour-details">9 días 8 noches</div>
                                <div class="buttons">
                                    <div class="read-more">Read More</div>
                                    <div class="add-to-list">Add to List</div>
                                </div>
                            </div>
                        </article>

                        <article class="info-tour">
                            <div class="img-container">
                                <div class="shadowing"></div>
                                <img src="images/tour-cancun.jpg" alt="">
                                <div class="tour-name">
                                    <span>CANCUN</span>
                                    <i class="fa fa-plus"></i>
                                </div>
                            </div>

                            <div class="tour-statistics">
                                <div class="seen">
                                    <i class="fa fa-eye"></i>
                                    <span class="seen-counter">41</span>
                                </div>
                                <div class="likes">
                                    <i class="fa fa-heart"></i>
                                    <span class="likes-counter">2</span>
                                </div>
                            </div>

                            <div class="tour-description">
                                <div class="tour-price currency"><i class="fa fa-dollar"></i> 1298</div>
                                <div class="tour-details">5 días 4 noches. Todo incluido</div>
                                <div class="buttons">
                                    <div class="read-more">Read More</div>
                                    <div class="add-to-list">Add to List</div>
                                </div>
                            </div>
                        </article>

                        <article class="info-tour">
                            <div class="img-container">
                                <div class="shadowing"></div>
                                <img src="images/tour-vegas.jpg" alt="">
                                <div class="tour-name">
                                    <span>LAS VEGAS</span>
                                    <i class="fa fa-plus"></i>
                                </div>
                            </div>

                            <div class="tour-statistics">
                                <div class="seen">
                                    <i class="fa fa-eye"></i>
                                    <span class="seen-counter">21</span>
                                </div>
                                <div class="likes">
                                    <i class="fa fa-heart"></i>
                                    <span class="likes-counter">0</span>
                                </div>
                            </div>

                            <div class="tour-description">
                                <div class="tour-price currency"><i class="fa fa-dollar"></i> 1298</div>
                                <div class="tour-details">5 días 4 noches. Todo incluido. 2 adultos 2 menores</div>
                                <div class="buttons">
                                    <div class="read-more">Read More</div>
                                    <div class="add-to-list">Add to List</div>
                                </div>
                            </div>
                        </article>
                    </section>
                </div>
            </div>
        </section>

        <section class="tour-videos main-section">
            <div class="sec-container">
                <div class="video-desc">
                    <h1>Hay un gran mundo alla afuera que no te puedes perder!</h1>
                    <h4>vamos explorar</h4>
                    <p>Contamos con una amplia variedad de destinos y experincias alrededor del mundo que tienes que empezar a disfrutar y no te las puedes perder</p>
                    <div id="btn-read-more">Read More</div>
                </div>
                <div class="video-link">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/HXwJDjcRTgo" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </section>

        <section class="recommended-hotels main-section">
            <div class="sec-container">
                <h3>GUARANTEED QUALITY</h3>
                <h1>RECOMMENDED HOTELS</h1>

                <div class="hotel-list">
                    <div class="hotel-item">
                        <div class="img-container">
                            <div class="shadowing"></div>
                            <img src="images/hotel-1.jpg" alt="">
                        </div>

                        <div class="tour-description">
                            <div class="tour-price currency"><i class="fa fa-dollar"></i> 120</div>
                            <div class="tour-details"><b>Per Night.</b><br> Hotel exclusivo para compras, frente al mall mas grande de la florida.</div>
                            <div class="buttons">
                                <div class="read-more">Read More</div>
                            </div>
                        </div>

                        <div class="tour-statistics">
                            <div class="seen">
                                <i class="fa fa-eye"></i>
                                <span class="seen-counter hidden">49</span>
                            </div>
                            <div class="likes">
                                <i class="fa fa-heart"></i>
                                <span class="likes-counter hidden">0</span>
                            </div>
                            <div class="share">
                                <i class="fa fa-share-alt"></i>
                            </div>
                            <div class="location">
                                <i class="fa fa-map-marker"></i>
                            </div>
                        </div>
                    </div>

                    <div class="hotel-item">
                        <div class="img-container">
                            <div class="shadowing"></div>
                            <img src="images/hotel-2.jpg" alt="">
                        </div>

                        <div class="tour-description">
                            <div class="tour-price currency"><i class="fa fa-dollar"></i> 199</div>
                            <div class="tour-details"><b>Per Night.</b><br>  Hotel para relajarse frente al mar.</div>
                            <div class="buttons">
                                <div class="read-more">Read More</div>
                            </div>
                        </div>

                        <div class="tour-statistics">
                            <div class="seen">
                                <i class="fa fa-eye"></i>
                                <span class="seen-counter hidden">50</span>
                            </div>
                            <div class="likes">
                                <i class="fa fa-heart"></i>
                                <span class="likes-counter hidden">0</span>
                            </div>
                            <div class="share">
                                <i class="fa fa-share-alt"></i>
                            </div>
                            <div class="location">
                                <i class="fa fa-map-marker"></i>
                            </div>
                        </div>
                    </div>

                    <div class="hotel-item">
                        <div class="img-container">
                            <div class="shadowing"></div>
                            <img src="images/hotel-3.jpg" alt="">
                        </div>

                        <div class="tour-description">
                            <div class="tour-price currency"><i class="fa fa-dollar"></i> 130</div>
                            <div class="tour-details"><b>Per Night.</b><br>  Hotel a escasos minutos de los parques de diversiones</div>
                            <div class="buttons">
                                <div class="read-more">Read More</div>
                            </div>
                        </div>

                        <div class="tour-statistics">
                            <div class="seen">
                                <i class="fa fa-eye"></i>
                                <span class="seen-counter hidden">57</span>
                            </div>
                            <div class="likes">
                                <i class="fa fa-heart"></i>
                                <span class="likes-counter hidden">0</span>
                            </div>
                            <div class="share">
                                <i class="fa fa-share-alt"></i>
                            </div>
                            <div class="location">
                                <i class="fa fa-map-marker"></i>
                            </div>
                        </div>
                    </div>

                    <div class="hotel-item">
                        <div class="img-container">
                            <div class="shadowing"></div>
                            <img src="images/hotel-4.jpg" alt="">
                        </div>

                        <div class="tour-description">
                            <div class="tour-price currency"><i class="fa fa-dollar"></i> 250</div>
                            <div class="tour-details"><b>Per Night, Per Person.</b><br>  Un paradisiaco hotel todo incluido frente al mar</div>
                            <div class="buttons">
                                <div class="read-more">Read More</div>
                            </div>
                        </div>

                        <div class="tour-statistics">
                            <div class="seen">
                                <i class="fa fa-eye"></i>
                                <span class="seen-counter hidden">35</span>
                            </div>
                            <div class="likes">
                                <i class="fa fa-heart"></i>
                                <span class="likes-counter hidden">0</span>
                            </div>
                            <div class="share">
                                <i class="fa fa-share-alt"></i>
                            </div>
                            <div class="location">
                                <i class="fa fa-map-marker"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="commentaries main-section">
            <div class="sec-container">
                <h3>RELAX AND ENJOY</h3>
                <h1>HAPPY TRAVELER</h1>

                <div class="nav-btn prev" id="btn-prev">&#60</div>
                <div class="nav-btn next" id="btn-next">&#62</div>

                <div class="carrousel-content">

                    <div class="comments">
                        <section class="comment">
                            <div class="odd">

                                    <div class="comment-bg">
                                        <img src="images/cover-image-1.jpg" alt="">
                                    </div>
                                    <div class="profile-pic-odd">
                                        <img src="images/avatar-1.jpg" alt="">
                                    </div>
                                    <div class="profile-name">
                                        Sandara Park
                                    </div>
                                    <div class="profile-location">
                                        Roma, Italy
                                    </div>
                                    <div class="profile-desc">
                                        " <br>
                                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
                                        <br> "
                                    </div>

                            </div>

                            <div class="even">

                                    <div class="comment-bg">
                                        <img src="images/cover-image-2.jpg" alt="">
                                    </div>
                                    <div class="profile-pic-even">
                                        <img src="images/avatar-2.jpg" alt="">
                                    </div>
                                    <div class="profile-name">
                                        Kown Jiyong
                                    </div>
                                    <div class="profile-location">
                                        London, England
                                    </div>
                                    <div class="profile-desc">
                                        " <br>
                                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
                                        <br> "
                                    </div>

                            </div>

                        </section>

                        <section class="comment">
                            <div class="odd">

                                    <div class="comment-bg">
                                        <img src="images/cover-image-3.jpg" alt="">
                                    </div>

                                    <div class="profile-pic-odd">
                                        <img src="images/avatar-3.jpg" alt="">
                                    </div>
                                    <div class="profile-name">
                                        Taylor Rose
                                    </div>
                                    <div class="profile-location">
                                        Paris, France
                                    </div>
                                    <div class="profile-desc">
                                        " <br>
                                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
                                        <br> "
                                    </div>

                            </div>

                            <div class="even">

                                    <div class="comment-bg">
                                        <img src="images/cover-image-4.jpg" alt="">
                                    </div>
                                    <div class="profile-pic-even">
                                        <img src="images/avatar-4.jpg" alt="">
                                    </div>
                                    <div class="profile-name">
                                        John Smith
                                    </div>
                                    <div class="profile-location">
                                        New York, USA
                                    </div>
                                    <div class="profile-desc">
                                        " <br>
                                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
                                        <br> "
                                    </div>

                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>

        <section class="news-updates main-section">
            <div class="sec-container">
                <h3>EXPLORATIONAL STORIES</h3>
                <h1>NEWS AND UPDATES</h1>



            </div>
        </section>

        <section class="footer main-section">
            <div class="sec-container">
                <img src="images/logo.png" alt="" class="footer-logo">

                <div class="footer-container">
                    <div class="contact-us">
                        <h3>Contact Us</h3>
                        <p><i class="fa fa-map-marker"></i> 132, My Street, Kingston, New York 12401</p>
                        <p><i class="fa fa-phone"></i> +1 754 217 8325</p>
                        <p><i class="fa fa-envelope-o"></i> info@cupontours.com</p>
                        <p>Sign up for our mailing list to get latest updates and offers.</p>
                        <div class="subscribe">
                            <input id="txt-subscribe-email" title="txt-subscribe-email" placeholder="Email address">
                            <div class="btn-send-subscribe"><i class="fa fa-check"></i></div>
                        </div>
                    </div>

                    <div class="book-now">
                        <h3>Book Now</h3>
                        <div>
                            <div class="vineta"></div><div>Flight</div>
                        </div>
                        <div>
                            <div class="vineta"></div><div>Tours</div>
                        </div>
                        <div>
                            <div class="vineta"></div><div>Packages</div>
                        </div>
                        <div>
                            <div class="vineta"></div><div>Transfer</div>
                        </div>
                        <div>
                            <div class="vineta"></div><div>Car Rent</div>
                        </div>
                        <div>
                            <div class="vineta"></div><div>Cruises</div>
                        </div>
                    </div>

                    <div class="exploore">
                        <h3>Exploore</h3>
                        <div>Miami / Orlando / Bahamas</div>
                        <div>Cancun</div>
                        <div>Las Vegas</div>
                        <div>Tokyo City</div>
                        <div>Paris City</div>
                        <div>New York City</div>
                    </div>

                    <div class="top-deals">
                        <h3>Top Deals</h3>
                        <div>SAWGRASSGRAND HOTEL</div>
                        <div>RAMADA MARCO POLO</div>
                        <div>RADISSON ORLANDO</div>
                        <div>CANCUN BAY RESORT</div>
                    </div>

                    <div class="destinations">
                        <h3>Destinations</h3>
                        <div class="dest-container">
                            <div class="dest-item">
                                <img src="images/dest1.jpg" alt="">
                                <div class="foreground"></div>
                            </div>
                            <div class="dest-item">
                                <img src="images/dest2.jpg" alt="">
                                <div class="foreground"></div>
                            </div>
                            <div class="dest-item">
                                <img src="images/dest3.jpg" alt="">
                                <div class="foreground"></div>
                            </div>
                            <div class="dest-item">
                                <img src="images/dest4.jpg" alt="">
                                <div class="foreground"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>


</body>
</html>
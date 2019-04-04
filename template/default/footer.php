<?php
/**
 * Created by PhpStorm.
 * User: zikku
 * Date: 16.04.2018
 * Time: 15:27
 */
//echo '<pre>'; var_dump($this->abstract);echo '</pre>';die;
?>
<footer class="wrapper style1 align-center">
    <div id="contacts" class="contacts">

        <div itemscope="" itemtype="http://schema.org/Organization">
            <h3>Бренд <span itemprop="name">ACHR</span></h3>

            <div class="address" itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">

                <div>Мы находимся в Москве по адресу:
                    <br><span itemprop="postalCode">107589</span>, <span itemprop="addressLocality">Москва</span>
                    <br><span itemprop="streetAddress"><?php echo $this->address; ?></span></div>

                <div>Наш E-mail: <a href="<?php echo $this->abstract[1]['desc']; ?>" itemprop="email"><?php echo $this->abstract[1]['desc']; ?></a>
                    <br>Наш телефон: <a href="tel:<?php echo str_replace(array(' ', '(', ')', '-'), '', $this->phone)?>"> <strong itemprop="telephone"><?php echo $this->phone; ?></strong></a>
                </div>

            </div>
        </div>

        <div class="menu-footer">
            <a href="/#dealer-map">Хочу купить</a>
            <a href="/garantiya">Гарантия</a>
            <a href="/dealer">Дилерам</a>
        </div>

    </div>
    <div>
        <p>&copy; 2018 <a href="/">ACHR</a>.</p>
    </div>
</footer>

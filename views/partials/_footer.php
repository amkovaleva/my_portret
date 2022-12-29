<?php
$lan_dir = 'app/index';
?>
<footer class="footer">
    <div class="footer__wrap container">
        <div class="footer__content">
            <div class="footer__address">
                <div class="address">
                    <b class="address__heading">
                        <?= Yii::t($lan_dir, 'address') ?>
                    </b>
                    <div class="address__content">
                        <?= Yii::t($lan_dir, 'address_string') ?>
                    </div>
                </div>
            </div>
            <div class="footer__contacts">
                <div class="footer__channel">
                    <a class="channel channel--phone" href="tel:+79109681674">+7 (910) 968-16-74</a>
                </div>
                <div class="footer__channel">
                    <a class="channel channel--email" href="mailto:alinastart@gmail.com">alinastart@gmail.com</a>
                </div>
                <div class="footer__channel">
                    <a class="channel channel--facebook" href="https://www.facebook.com/sekatsky.alina/">sekatsky.alina</a>
                </div>
                <div class="footer__channel">
                    <a class="channel channel--instagram" href="https://www.instagram.com/sekatski">sekatski</a>
                </div>
            </div>
            <div class="footer__policy">
                <a class="channel channel--no-icon channel--simpler" href="#"><?= Yii::t($lan_dir, 'privacy_policy') ?></a>
            </div>
            <div class="footer__terms">
                <a class="channel channel--no-icon channel--simpler" href="#"><?= Yii::t($lan_dir, 'terms_policy')  ?></a>
            </div>
        </div>
        <div class="footer__logo emblem">
            <?= Yii::t($lan_dir, 'footer_fio')  ?>
        </div>
    </div>
    <div class="footer__title">
        <a class="footer__year">Sekatski © 2023</a>
    </div>
</footer>
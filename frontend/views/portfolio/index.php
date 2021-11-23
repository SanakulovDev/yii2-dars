<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var \common\models\Portfolio $email
 */
?>

<section class="contact" id="contact">
    <div class="max-width">
        <h2 class="title">Contact me</h2>
        <div class="contact-content">
            <div class="column left">
                <div class="text"> Get in Touch</div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti maiores aut ad, odit voluptatum
                    quod unde quaerat enim vero dolorem.</p>
                <div class="icons">
                    <div class="row">
                        <i class="fas fa-user"></i>
                        <div class="info">
                            <div class="head">Name</div>
                            <div class="sub-title">Sherali Jo'rayev</div>
                        </div>
                    </div>

                    <div class="row">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="info">
                            <div class="head">Address</div>
                            <div class="sub-title">Tachkent, Uzbekistan</div>
                        </div>
                    </div>

                    <div class="row">
                        <i class="fas fa-envelope"></i>
                        <div class="info">
                            <div class="head">Email</div>
                            <div class="sub-title">abs@gmal.com</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column right">
                <div class="text">Message</div>
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="fields">
                    <div class="field name">
                        <?= $form->field($email, 'username')->textInput() ?>
                    </div>

                    <div class="field email">
                        <?= $form->field($email, 'email')->textInput() ?>
                    </div>
                </div>
                <div class="field">
                    <?= $form->field($email, 'subject')->textInput() ?>
                </div>

                <div class="field textarea">
                    <?= $form->field($email, 'content')->textarea() ?>
                </div>
                <div class="button">
                    <button type="submit">Send messege</button>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
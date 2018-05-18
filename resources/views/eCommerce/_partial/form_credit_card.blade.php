<div class="panel-heading display-table">
    <div class="row display-tr">
        <h3 class="panel-title display-td radio-group">

            <input type="radio" id="f-option" name="paymentWay" value="CREDIT_CARD" checked>
            <label for="f-option">Credit Card</label>
            <div class="check"></div>

            <span class="safemoney">
                      Safe money transfer using your bank account.Visa, maestro, discover, american express.
                    </span>
        </h3>
        <div class="display-td">
            <img class="img-responsive pull-right"
                 src="http://i76.imgup.net/accepted_c22e0.png">

        </div>
    </div>
</div>
<div class="panel-body">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="cardNumber">Credit Card Number</label>
                    <div class="input-group">
                        <input id="card-number" type="text" class="form-control cardNumber" name="cardNumber"
                               placeholder="Valid Card Number" autocomplete="cc-number"
                               onkeypress="return checkDigit(event)"
                               value=""
                               data-encrypt="cardnumber"
                               autofocus/>
                        <span class="input-group-addon credit-card">
                                                  <i class="fa fa-check" aria-hidden="true"></i>
                                                </span>
                    </div>
                    <span id="card_error"></span>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-xs-6 col-md-6 ">
                <div class="form-group">
                    <label for="cardCVC">CV CODE
                        <i class="fa fa-question-circle-o color-green"
                           aria-hidden="true"></i>
                    </label>

                    <div class="input-group">
                        <input id="card-ccv"
                               type="tel"
                               class="form-control cardCVC"
                               name="cardCVC"
                               placeholder="CVC"
                               data-encrypt="cvv"
                               autocomplete="cc-csc"/>
                        <span class="input-group-addon cv-code">
                                                  <i class="fa fa-credit-card" aria-hidden="true"></i>
                                                </span>
                    </div>
                    <span id="cvc_error"></span>


                </div>
            </div>
            <div class="col-xs-3 col-md-3">
                <div class="form-group">
                    <label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span
                                class="visible-xs-inline">EXP</span> DATE</label>
                    <input id="cart-exp-month"
                           type="tel"
                           class="form-control"
                           name="cardExpiry_month"
                           placeholder="MM"
                           data-encrypt="month"
                           autocomplete="cc-exp"/>
                    <span id="cardExpiryM_error"></span>
                </div>
            </div>
            <div class="col-xs-3 col-md-3">
                <div class="form-group">
                    <label for="cardExpiry"><span class="hidden-xs">&nbsp;</span><span
                                class="visible-xs-inline">&nbsp;</span>&nbsp;</label>
                    <input id="cart-exp-year"
                           type="tel"
                           class="form-control"
                           name="cardExpiry"
                           data-encrypt="year"
                           placeholder="YYYY"
                           autocomplete="cc-exp"/>
                    <span id="cardExpiryY_error"></span>
                </div>
            </div>
        </div>
</div>

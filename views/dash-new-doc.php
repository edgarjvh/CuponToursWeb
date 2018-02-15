<div class="new-document">
    <div class="title"><p class="new-doc-title">New Document<i class="fa fa-window-close-o"></i></p></div>

    <section class="invoice-header">
        <section class="customer-info">
            <div class="title">Customer Info</div>
            <div class="select-customer">
                <span class="label">Select Customer</span>
                <select name="cbo-select-customer" id="cbo-select-customer" title="cbo-select-customer">
                    <option value="0">Select your customer</option>
                </select>
                <i class="fa fa-plus" id="add-new-customer"></i>
            </div>
            <div class="new-customer">
                <div class="row row-1">
                    <span class="label">Alias</span>
                    <input type="text" id="txt-customer-alias" class="customer-info" title="Alias" name="txt-customer-alias" placeholder="Your customer's alias" disabled>
                    <span class="label">Name</span>
                    <input type="text" id="txt-customer-name" class="customer-info" title="Name" name="txt-customer-name" placeholder="Your customer's name" disabled>
                </div>
                <div class="row row-2">
                    <span class="label">E-mail</span>
                    <input type="text" id="txt-customer-email" class="customer-info" title="E-mail" name="txt-customer-email" placeholder="Your customer's email" disabled>
                    <span class="label">Phone Number</span>
                    <input type="text" id="txt-customer-phone-number" class="customer-info" title="Phone Number" name="txt-customer-phone-number" placeholder="Your customer's phone number" disabled>
                </div>
                <div class="row row-3">
                    <span class="label">Address</span>
                    <input type="text" id="txt-customer-address" class="customer-info" title="Address" name="txt-customer-address" placeholder="Your customer's address" disabled>
                </div>
            </div>
        </section>

        <section class="invoice-info">
            <div class="row row-1">
                <div class="title">Invoice Number</div>
                <input type="text" id="txt-invoice-number" title="Number" name="txt-invoice-number" placeholder="Number">
            </div>
            <div class="row row-2">
                <div class="title">Invoice Date</div>
                <input type="text" id="txt-invoice-date" title="Date" name="txt-invoice-date" placeholder="Date (yyyy-mm-dd)" maxlength="10">
            </div>
            <div class="row row-3">
                <div class="title">Invoice Due Days</div>
                <input type="text" id="txt-invoice-due-days" title="Due Days" name="txt-invoice-due-days" placeholder="Due Days" maxlength="4">
            </div>

        </section>
    </section>

    <section class="invoice-items">
        <section class="tbl">
            <div class="thead">
                <div class="row title">
                    <div class="col-1">Ítem</div>
                    <div class="col-2">Qty</div>
                    <div class="col-3">Description</div>
                    <div class="col-4">Unit Price</div>
                    <div class="col-5">Total Amount</div>
                    <div class="col-6">Tax</div>
                    <div class="col-7"></div>
                </div>
            </div>
            <div class="tbody">
                <div class="row">
                    <div class="col col-1">
                        1
                    </div>
                    <div class="col col-2">
                        <input type="text" id="txt-item-qty" name="txt-item-qty" title="Quantity" placeholder="quantity">
                    </div>
                    <div class="col col-3">
                        <input type="text" id="txt-item-desc" name="txt-item-desc" title="Description" placeholder="description">
                    </div>
                    <div class="col col-4 money">
                        <input type="text" id="txt-item-price" name="txt-item-price" title="Unit Price" placeholder="unit price">
                    </div>
                    <div class="col col-5 money">
                        <input type="text" id="txt-item-total" name="txt-item-total" title="Total Amount" placeholder="total amount" readonly>
                    </div>
                    <div class="col col-6">
                        <input type="checkbox" id="cbox-item-tax" name="cbox-item-tax" title="Tax">
                    </div>
                    <div class="col col-7">
                        <i id="delete" class="fa fa-times"></i>
                    </div>
                </div>
            </div>

            <div class="tfoot">
                <div class="row add-item title">
                    add new item
                </div>
            </div>
        </section>
    </section>

    <section class="invoice-footer">
        <section class="payment-info">
            <div class="title">Payment Info</div>
            <div class="payment-details">
                <div class="row">
                    <span class="label">Card Type</span>
                    <div class="card-type">
                        <input type="radio" id="cbox-visa" name="rbtn-tdc" title="VISA">
                        <label for="cbox-visa"><span class="fa fa-cc-visa"></span>Visa</label>
                        <input type="radio" id="cbox-mastercard" name="rbtn-tdc" title="MASTERCARD">
                        <label for="cbox-mastercard"><span class="fa fa-cc-mastercard"></span>Master Card</label>
                        <input type="radio" id="cbox-amex" name="rbtn-tdc" title="AMERICAN EXPRESS">
                        <label for="cbox-amex"><span class="fa fa-cc-amex"></span>American Express</label>
                        <input type="radio" id="cbox-diners" name="rbtn-tdc" title="DINERS CLUB">
                        <label for="cbox-diners"><span class="fa fa-cc-diners-club"></span>Diners Club</label>
                        <input type="radio" id="cbox-discover" name="rbtn-tdc" title="DISCOVER">
                        <label for="cbox-discover"><span class="fa fa-cc-discover" title=""></span>Discover</label>
                    </div>
                </div>
                <div class="row">
                    <span class="label">Card Holder</span>
                    <input type="text" id="txt-card-holder" name="txt-card-holder" title="Card Holder" placeholder="card holder">
                </div>
                <div class="row">
                    <span class="label">Card Number</span>
                    <input type="text" id="txt-card-number" name="txt-card-number" title="Card Number" placeholder="card number" maxlength="20">
                </div>
                <div class="row">
                    <span class="label">Card Expiration Date</span>
                    <input type="text" id="txt-card-expiration-date" name="txt-card-expiration-date" title="Card Expiration Date" placeholder="card expiration date (mm-yy)" maxlength="5">
                </div>
                <div class="row">
                    <span class="label">Card CVV</span>
                    <input type="text" id="txt-card-cvv" name="txt-card-cvv" title="Card CVV" placeholder="card cvv" maxlength="4">
                </div>
                <div class="row">
                    <span class="label">Address</span>
                    <input type="text" id="txt-card-address" name="txt-card-address" title="Card Address" placeholder="card address">
                </div>
            </div>
        </section>

        <section class="invoice-totals">
            <div class="row money">
                <div class="title">Sub Total</div>
                <span id="txt-subtotal">0.00</span>
            </div>
            <div class="row money">
                <div class="title">Tax <input type="text" id="txt-tax-value" name="txt-tax-value" title="Tax" placeholder="Tax" value="0.00" maxlength="5" /> %</div>
                <span id="txt-tax-amount">0.00</span>
            </div>
            <div class="row money">
                <div class="title">Total</div>
                <span id="txt-total">0.00</span>
            </div>
        </section>
    </section>

    <section class="invoice-observations">
        <section class="observations">
            <div class="title">Observations</div>
            <textarea class="observations-text" id="txt-invoice-observations" placeholder="place the observations here" rows="20"></textarea>
        </section>
    </section>

    <section class="buttons">
        <div class="btn-proceed">Proceed</div>
    </section>
</div>
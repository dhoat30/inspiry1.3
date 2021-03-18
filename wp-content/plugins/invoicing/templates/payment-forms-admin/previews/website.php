<?php
/**
 * Displays a website preview in the payment form editor
 *
 * This template can be overridden by copying it to yourtheme/invoicing/payment-forms-admin/previews/website.php.
 *
 * @version 1.0.19
 */

defined( 'ABSPATH' ) || exit;

?>

<label class="d-block w-100">
    <span v-html="form_element.label"></span>
    <span class='text-danger' v-if='form_element.required'> *</span>
    <input class='form-control' type='url' :placeholder='form_element.placeholder'>
    <small v-if='form_element.description' class='form-text text-muted' v-html='form_element.description'></small>
</label>

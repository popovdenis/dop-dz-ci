<h2>Purchase</h2>

<?php //$segments = array('item', url_title($item->name, 'dash', true), $item->id); ?>
<?php $segments = array('items', 'details', $item->id); ?>
<p>To purchase &ldquo;<?php echo anchor($segments, $item->name); ?>&rdquo;, enter your email address below and click
    through to pay with PayPal. Upon confirmation of your payment, we will email you your download link to the address
    you enter below.</p>

<?php
echo form_open('items/purchase/' . $item->id);
echo validation_errors('<p class="error">', '</p>');
?>
<p>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email"/> &nbsp;
    <input type="submit" value="Pay $<?php echo $item->price; ?> via PayPal"/>
</p>
</form>
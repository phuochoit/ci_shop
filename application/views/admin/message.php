<?php if(isset($messages) && !empty($messages)):?>
<div class="nNote nInformation hideit">
    <p><strong>Notification: </strong> <?php print $messages; ?></p>
</div>
<?php endif;?>
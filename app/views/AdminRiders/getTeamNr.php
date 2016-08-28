<select class="text-all form-control"  name="number">
    <?php for ($i = $tpl['team']['number_from']; $i <= $tpl['team']['number_to']; $i++) {
        ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        <?php
    }
    ?>
</select>
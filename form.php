<?php

class Form
{
    public function input($name, $label)
    {
        return "<div class='form-group'>
                    <label for='$name'>$label</label>
                    <input type='text' class='form-control' name='$name' id='$name'>
                </div>";
    }

    public function submit($label)
    {
        return "<button type='submit' class='btn btn-primary'>$label</button>";
    }
}

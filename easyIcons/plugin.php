<?php


class easyIcons extends Plugin
{

    public function init()
    {
        $this->dbFields = array(
            'turnoncss' => '',
            'csstype' => ''
        );
    }

    public function form()
    {


        $html = "

 
    <div style='width:100%;background:#fafafa;padding:10px;box-sizing:boder-box;border:solid 1px #ddd;'>

<style>
code{
font-weight:bold;
color:white;background:red;display:block;width:100%;padding:10px;
    border:solid 1px;}
</style>
    
     <p  style='margin:0;margin-bottom:5px;padding:0;'>1.Go to page <a href='https://fontawesome.com/search' target='_blank'>Font Awesome</a> or <a href='https://iconscout.com/unicons/explore/line' target='_blank'>UniCons</a></p>
    <p style='margin:0;margin-bottom:5px;padding:0;'>2.Paste code icon and make own size and color like example</p>
    <p style='margin:0;margin-bottom:5px;padding:0'>3.This shortocode works <b style='color:red;font-weight:bold;'>only</b> on normal page content</p>
    <b style='margin-bottom:5px;display:block;'>Click to copy:</b>
    <code  onclick='copyclick()' id='example'>[ei icon='fa-solid fa-house' size='60px' color='red']</code>

<script>
function copyclick(){
// Get the text field
var copyText = document.getElementById('example');

 
 
navigator.clipboard.writeText(copyText.innerHTML);

// Alert the copied text
alert('Copied the text: ' + copyText.innerHTML);

    };
</script>
    </div>
    
<hr style='margin-top:20px;margin-bottom:20px;opacity:0.3;'>

    <form method='POST'>
    <h3 style='margin:0;margin-top:10px;'>Include CSS on header?</h3>

    <select name='turnoncss' class='turnoncss' style='width:100%;padding:10px;margin:10px 0;box-sizing:border-box;background:#fff;border:solid 1px #ddd;'>
    <option name='yes' " . ($this->getValue('turnoncss') === 'yes' ? 'selected' : '') . ">yes</option>
    <option name='no' " . ($this->getValue('turnoncss') === 'no' ? 'selected' : '') . ">no</option>
    </select>

    <h3 style='margin:0;margin-top:10px;'>Select Font Type</h3>
    <select name='csstype' class='csstype' style='width:100%;padding:10px;margin:10px 0;box-sizing:border-box;background:#fff;border:solid 1px #ddd;'>
<option value='fontawesome' " . ($this->getValue('csstype') === 'fontawesome' ? 'selected' : '') . ">Font Awesome </option>
<option value='unicons' " . ($this->getValue('csstype') === 'unicons' ? 'selected' : '') . ">UniCons </option>
    </select>


    <input name='save-easyicon' value='Save Option 💾' type='submit' style='border:solid 1px #000;background:#000;padding:10px 15px;color:#fff;display:block;margin-top:20px;'>
    </form>

    <hr style='margin-top:20px;margin-bottom:20px;opacity:0.3;'>
    ";

        $html .= '<div id="paypal" style="margin-top:10px; background: #fafafa; border:solid 1px #ddd; padding: 10px;box-sizing: border-box; text-align: center;">
    <p style="margin-bottom:10px;">If you want to see new plugins, buy me a ☕ :)</p>
    <a href="https://www.paypal.com/donate/?hosted_button_id=TW6PXVCTM5A72"><img alt="" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0"></a>
</div>';


        return $html;
    }


    public function siteHead()
    {


        if ($this->getValue('turnoncss') == 'yes') {

            if ($this->getValue('csstype') === 'fontawesome') {
                echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />';
            } else {
                echo '<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">';
            };
        };
    }




    public function pageBegin()
    {

        $pattern = "/\[ei\sicon\W(.*)\W\ssize=\W(.*)\W color=\W(.*)\W]/i";



        global $page;

        ///shortbox create
        $newcontent = preg_replace_callback(
            $pattern,
            function ($match) {
                $match[1] = substr(str_replace("'", "", htmlspecialchars_decode($match[1])), 0);
                return "<i class='$match[1]' style='font-size: $match[2]; color: $match[3];'></i>";
            },
            $page->content()
        );


        global $page;
        $page->setField('content', $newcontent);
    }
};

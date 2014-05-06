        </div>
    <div class="panelClear"></div>
    </div> <!-- panelContainer -->
<?php

if ($footer != $root){ // checks if the $footer is empty
    include $footer;
} else {
    echo '</body>
          </html>
         ';
}

?>

<?php

  date_default_timezone_set('Etc/GMT');
  $timezoneOffset = 1;

  if (!empty($_COOKIE['timezone_offset']) || isset($_GET['set_timezone'])) {
    $timezoneCookie = isset($_GET['set_timezone']) ? intval($_GET['set_timezone']) : intval($_COOKIE['timezone_offset']);

    if ($timezoneCookie >= -14 && $timezoneCookie <= 12) {
      setcookie('timezone_offset', $timezoneCookie);
      $timezoneOffset = $timezoneCookie;
    }
  }

  $theTime = time() + ($timezoneOffset*3600);

  list($hour, $minute, $second) = explode(':', date('g:i:s', $theTime));

  $offsetHours = $hour * 3600 + $minute * 60 + $second -1;
  $offsetMinutes = $minute * 60 + $second -1;
  $offsetSeconds = $second -1;

  $rotateHours = ($hour*60+$minute) * 360 / 720;
  $rotateMintues = $minute * 360 / 60;
  $rotateSeconds = $second * 360 / 60;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>CSS-only Clock</title>
    <style>@import "clock.css";</style>
    <style>
    /* setting current time */
    #hour.hand {
      -moz-transform: rotate(<?php echo $rotateHours; ?>deg);
      -o-transform: rotate(<?php echo $rotateHours; ?>deg);
      -webkit-animation-delay: <?php echo -$offsetHours; ?>s;
    }
    #min.hand {
      -moz-transform: rotate(<?php echo $rotateMintues; ?>deg);
      -o-transform: rotate(<?php echo $rotateMintues; ?>deg);
      -webkit-animation-delay: <?php echo -$offsetMinutes; ?>s;
    }
    #sec.hand {
      -moz-transform: rotate(<?php echo $rotateSeconds; ?>deg);
      -o-transform: rotate(<?php echo $rotateSeconds; ?>deg);
      -webkit-animation-delay: <?php echo -$offsetSeconds; ?>s;
    }
    </style>
  </head>
  <body>
    <?php if(!isset($_GET['hide'])): ?>
    <h1>CSS-only Clock</h1>
    <?php endif; ?>

    <div id="clock">
      <div id="hour" class="hand"></div>
      <div id="min" class="hand"></div>
      <div id="sec" class="hand"></div>

      <div id="indicators">
        <!-- div*60 -->
        <div></div><div></div><div></div><div></div>
        <div></div><div></div><div></div><div></div>
        <div></div><div></div><div></div><div></div>
        <div></div><div></div><div></div><div></div>
        <div></div><div></div><div></div><div></div>
        <div></div><div></div><div></div><div></div>
        <div></div><div></div><div></div><div></div>
        <div></div><div></div><div></div><div></div>
        <div></div><div></div><div></div><div></div>
        <div></div><div></div><div></div><div></div>
        <div></div><div></div><div></div><div></div>
        <div></div><div></div><div></div><div></div>
        <div></div><div></div><div></div><div></div>
        <div></div><div></div><div></div><div></div>
        <div></div><div></div><div></div><div></div>
      </div> <!-- /#indicators -->
    </div> <!-- /#clock -->

    <?php if(!isset($_GET['hide'])): ?>
    <form>
      <label for="set_timezone">Set Timezone:</label>
      <select id="set_timezone" name="set_timezone" onchange="this.form.submit()">
      <?php
          for($i = -14; $i <= 12; $i++) {
            echo '  <option value="'.$i.'"'.($timezoneOffset == $i ? ' selected' : '').'>UTC/GMT '.($i>=0?'+':'').$i."</option>\n      ";
          }
        ?></select>
      <noscript><input type="submit" value="change" /></noscript>
    </form>

    <div id="info">
      <p>
        Proof of concept for a <strong>CSS-only clock</strong>. Currently best viewed with
        <a href="http://google.com/chrome/" title="Get Chrome" target="_blank">Google Chrome</a> or
        <a href="http://apple.com/safari/" title="Get Safari" target="_blank">Safari</a>.
        Firefox and Opera users will see a static clock and everyone else gets
        <a href="ie8.png" title="How this looks like in IE8">something funny</a>.
      </p>
      <p>
        Wrong time? &ndash; Adjust it in the upper right corner.
      </p>
      <p>
        <cite>made by <a href="http://www.julianwachholz.ch/">Julian Wachholz</a></cite>
      </p>
      <p class="hide">
        <a href="?hide" rel="nofollow,noindex">hide this text</a>
      </p>
    </div>
    <?php endif; ?>

    <script>var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=true;g.src=('https:'==location.protocol?'https://ssl':'http://www')+'.google-analytics.com/ga.js';s.parentNode.insertBefore(g,s);})(document,'script');</script>
  </body>
</html>

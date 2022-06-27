
<!-- This element shall be wrapped inside a <form> element for the value of 'date' to be submitted correctly -->

<div class="calendar">


    <!-- The input element that should get submitted along with the form -->
    <input type="date" name="date" class="calendar-input" id="calendar-input" />

    <!-- Overlay to select the year month -->
    <div class="calendar-overlay calendar-style">

        <!-- Header -->
        <div class="calendar-header">
            <button type="button" class="button calendar-header-btn" id="calendar-yr-left"><i class="las la-chevron-left"></i></button>
            <span class="calendar-header-text" id="calendar-overlay-year-text">N/A</span>
            <button type="button" class="button calendar-header-btn" id="calendar-yr-right"><i class="las la-chevron-right"></i></button>
        </div>

        <!-- Month Select -->
        <?php
            $MONTHS = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

            foreach( $MONTHS as $idx => $mon )
                echo "<button type='button' class='button calendar-mon calendar-mon" . ($idx + 1) . "'>$mon</button>";
        ?>
    </div>


    <!-- Section for selecting months by < or > arrow -->
    <div class="calendar-header">
        <button type="button" class="button calendar-header-btn" id="calendar-left"><i class="las la-chevron-left"></i></button>
        <button type="button" class="button calendar-header-text" id="calendar-header-text">N/A</button>
        <button type="button" class="button calendar-header-btn" id="calendar-right"><i class="las la-chevron-right"></i></button>
    </div>


    <!-- "Actual calendar grid" -->
    <!-- Day of Week Row -->
    <?php
        $DAY_OF_WEEK = array(
            "sunday"=>"Sun", 
            "monday"=>"Mon", 
            "tuesday"=>"Tue", 
            "wednesday"=>"Wed", 
            "thursday"=>"Thur", 
            "friday"=>"Fri", 
            "saturday"=>"Sat"
        );
        foreach( $DAY_OF_WEEK as $full => $short ) echo "<span class='calendar-dow calendar-$full'>$short</span>";
    ?>


    <!-- Calendar grids -->
    <?php
        for ($i = 1; $i <= 42; $i++) echo "<span class='calendar-grid calendar-grid$i'></span>";
    ?>
</div>
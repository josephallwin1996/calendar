<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="./css/dashboard1.css" rel="stylesheet" >
      
        <title>Dashboard</title>
        </head>
    <body>
    <div id="dashboard">
    <div id="sidebar">
        <!-- Sidebar content like icons and labels -->
        <div class="icon">DS</div>
        <div class="icon">Search</div>
        <div class="icon">Recent events bookings</div>
        <div class="icon">Performance</div>
        <div class="icon">Upcoming events</div>
        <div class="icon">Payment History</div>
    </div>
    
    <div id="main-content">
        <div id="search-bar">
            <!-- Search bar elements -->
            <input type="text" placeholder="Search...">
            <button>Go</button>
        </div>
        
        <div id="recent-events">
            <!-- Recent events content -->
            <h3>Recent events bookings</h3>
            <p>26 bookings</p>
            <div class="event">
                <img src="grow-your-career.jpg" alt="Grow your career">
                <div class="event-info">
                    <h4>Grow your career</h4>
                    <p>Johnny Bennett</p>
                    <span>+99</span>
                </div>
            </div>
            <div class="event">
                <img src="how-to-start-up.jpg" alt="How to start up">
                <div class="event-info">
                    <h4>How to start up</h4>
                    <p>Success Stories</p>
                    <span>+99</span>
                </div>
            </div>
            <div class="event">
                <img src="dorisla-cunningshawm.jpg" alt="Dorisla Cunningshawm">
                <div class="event-info">
                    <h4>Dorisla Cunningshawm</h4>
                    <p>Author of "The Power of Now"</p>
                    <span>+99</span>
                </div>
            </div>
        </div>
        
        <div id="performance-chart">
            <!-- Performance chart -->
            <h3>Performance</h3>
            <p>2019 Aug - 2020 Aug</p>
            <div class="chart">
                <!-- Chart elements -->
            </div>
            <div class="legend">
                <!-- Legend elements -->
                <div class="legend-item">
                    <div class="legend-color" style="background-color: blue;"></div>
                    <p>Events</p>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background-color: red;"></div>
                    <p>Lectures</p>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background-color: green;"></div>
                    <p>Awards</p>
                </div>
            </div>
        </div>
        
        <div id="upcoming-events">
            <!-- Upcoming events calendar -->
            <h3>Upcoming events</h3>
            <p>5 events</p>
            <div class="calendar">
                <!-- Calendar elements -->
                <div class="month">
                    <button><</button>
                    <p>Aug</p>
                    <button>></button>
                </div>
                <div class="weekdays">
                    <p>S</p>
                    <p>M</p>
                    <p>T</p>
                    <p>W</p>
                    <p>T</p>
                    <p>F</p>
                    <p>S</p>
                </div>
                <div class="days">
                    <p>29</p>
                    <p>30</p>
                    <p>31</p>
                    <p>01</p>
                    <p>02</p>
                    <p>03</p>
                    <p>04</p>
                    <!-- More days -->
                </div>
            </div>
        </div>
        
        <div id="payment-history">
            <!-- Payment history content -->
            <h3>Payment History</h3>
            <p>$83 total</p>
            <div class="payment">
                <div class="payment-info">
                    <p>Received</p>
                    <p>Receipt</p>
                </div>
                <div class="payment-amount">
                    <p>+99</p>
                </div>
            </div>
            <div class="payment">
                <div class="payment-info">
                    <p>Poker Grand</p>
                    <p>Receipt</p>
                </div>
                <div class="payment-amount">
                    <p>-16</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
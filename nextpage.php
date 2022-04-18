<?php
session_start();
$user = $_SESSION['user'];
$pass = $_SESSION['pass'];
$conn = mysqli_connect('remotemysql.com', '2v6B9Eu4Wc', '926XBu3pHs', '2v6B9Eu4Wc');
$query = "SELECT * from patient where username = '$user' and pass = '$pass' ";
$query_run = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($query_run);
$name = $data['fname'] . " " . $data['lname'];
$pat_id = $data['patient_id'];

if (isset($_POST['submit'])) {
    $select = $_POST['select'];
    $_SESSION['select'] = $select;
    $query = "SELECT * from doctor where doc_spec = '$select'";
    $query_run = mysqli_query($conn, $query);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/nextpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="maindata">
        <div class="nav">
            <div class="company">
                <img src="g10.svg" alt="" class="logo">
                <h1 class="dr">Dr. <span class="care">Care</span></h1>
            </div>
            <div class="log">
                <a href="#" class="upcoming">Appointments</a>
                <a href="#" class="logout">Logout</a>
            </div>
        </div>
        <h1 class="nameofuser">Welcome, <?php echo $name ?></h1>
        <form method="post">
            <p class="sele">Select the Specialization you want
                <select name="select">
                    <option value="Cardiologist">Cardiologist</option>
                    <option value="Urologist">Urologist</option>
                    <option value="Psychiatrist">Psychiatrist</option>
                    <option value="Nutrition & Dietetics">Nutrition & Dietetics</option>
                    <option value="Physiotherapist">Physiotherapist</option>
                    <option value="Neurologist">Neurologist</option>
                </select>
                <button name="submit" class="submit" id="submit"> Submit</button>
            </p>
        </form>
        <div class="cardcenter">
            <?php
            $total = mysqli_num_rows($query_run);
            if ($total == 0) {
            ?>
                <h1>Current no Doctor is available</h1>
            <?php
            }
            while ($result = mysqli_fetch_assoc($query_run)) {
                $data = $result['doctor_id'];
                $img_query = "SELECT * from images where doc_id = '$data' ";
                $img_query_run = mysqli_query($conn, $img_query);
                $fetch = mysqli_fetch_assoc($img_query_run);
            ?>
                <div class="card">
                    <a href="#" class="card__container">
                        <div class='card__img' style='background-image: url(imag/<?php echo $fetch['img'] ?>);'> </div>
                    </a>
                    <div class="card__info">
                        <span class="card__category"><?php echo $result['doc_name'] ?></span>
                        <h3 class="card__title"><?php echo $result['doc_spec'] ?></h3>
                        <span class="card__by"><?php echo $result['doc_address'] ?></span>
                        <button class="toform">Book Now</button>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
    <form action="#" method="POST" class="apoint">
        <h1 class="appoint">Appointment Form</h1>
        <p>Select Doctor: <select required name="select_name">
                <?php
                $query = "SELECT * from doctor where doc_spec = '$select'";
                $query_run = mysqli_query($conn, $query);
                while ($result = mysqli_fetch_assoc($query_run)) {
                ?> <option value="<?php echo $result['doc_name'] ?>"><?php echo $result['doc_name'] ?></option>
                <?php }
                ?>
            </select> </p>
        <p class="radiotag">Select Timing : <input type="radio" name="time" id="time" value="2.00 pm" checked> 2.00 pm
            <input type="radio" name="time" id="time" value="3.00 pm"> 3.00 pm <input type="radio" name="time" id="time" value="4.00 pm"> 4.00 pm
        </p>
        <p class="date">Select Date: <input type="date" name="date" id="date" required></p>
        <div class="btnout2">
            <button id="back">Go back</button>
            <button id="sub" name="submitdata">Submit</button>
        </div>
    </form>
    <?php
    if (isset($_POST['submitdata'])) {
        $name = $_POST['select_name'];
        $time = $_POST['time'];
        $date = $_POST['date'];
        $new_select = $_SESSION['select'];
        $conn = mysqli_connect('localhost:3306', 'root', '', 'project');
        $query = "SELECT doctor_id from doctor where doc_spec = '$new_select' and doc_name like'$name'";
        $query_run = mysqli_query($conn, $query);
        $result = mysqli_fetch_assoc($query_run);
        $doc = $result['doctor_id'];
        $query3 = "INSERT INTO appointment (pat_id,doc_id,date,time) values ('$pat_id','$doc','$date','$time')";
        $query_run3 = mysqli_query($conn, $query3);
    }

    ?>
    <div id="data">
        <?php
        $conn = mysqli_connect('localhost:3306', 'root', '', 'project');
        $query = "SELECT date,time,doc_name,doc_address,doc_spec from appointment,doctor where pat_id ='$pat_id' and doc_id = doctor_id ORDER BY date";
        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) == 0) {
        ?>
            <h1>No appointment had been booked yet</h1>
        <?php
        }
        while ($appoint_data = mysqli_fetch_assoc($query_run)) {
        ?>
            <section class="contain">
                <div class="uper">
                    <p class="date">Appointment on: <?php echo $appoint_data['date'] ?></p>
                    <p class="time">Timming: <?php echo $appoint_data['time'] ?></p>
                </div>
                <p class="doc"> With Doctor <b><?php echo $appoint_data['doc_name'] ?></b> for <b><?php echo $appoint_data['doc_spec'] ?></b></p>
                <p class="address">At <?php echo $appoint_data['doc_address'] ?></p>
            </section>
        <?php
        }
        ?>
        <div class="closetag">
            <button class="closeit">Close</button>
        </div>
    </div>
    <div class="optn">
        <p>Do you want to leave?</p>
        <div class="btnout">
            <button id="cancel">Cancel</button>
            <button id="yes">Yes</button>
        </div>
    </div>
    <script>
        document.querySelector('.logout').addEventListener('click', function() {
            document.querySelector('.maindata').style = "opacity:0.5;"
            document.querySelector('.optn').style = "display:block;";

        });
        document.querySelector('.upcoming').addEventListener('click', function() {
            document.querySelector('.maindata').style = "opacity:0.5;"
            document.querySelector('#data').style = "display:block;";

        });
        document.querySelector('.closeit').addEventListener('click', function() {
            document.querySelector('.maindata').style = "opacity:1;"
            document.querySelector('#data').style = "display:none;";

        });
        var allbut = document.querySelectorAll('.toform');
        for (var i = 0; i < allbut.length; i++) {
            allbut[i].addEventListener('click', function() {
                document.querySelector('.maindata').style = "opacity:0.5;"
                document.querySelector('.apoint').style = "display:block;";
            });
        }

        document.querySelector('#cancel').addEventListener('click', function() {
            document.querySelector('.optn').style = "display:none;"
            document.querySelector('.maindata').style = "opacity:1;"
        });
        document.querySelector('#back').addEventListener('click', function() {
            document.querySelector('.apoint').style = "display:none;"
            document.querySelector('.maindata').style = "opacity:1;"
        });
        document.querySelector('#yes').addEventListener('click', function() {
            document.querySelector('.maindata').style = "opacity:1;"
            window.location.href = "index.php";
        });
        document.querySelector('.toform').addEventListener('Click', function() {

        });
    </script>
</body>

</html>
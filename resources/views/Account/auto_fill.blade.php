
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="c0p2pQfjuaQA2N1U5E0N7VrbMQwAT4pwE1n9hn1c">
    <title>testing</title>
    <!-- Styles -->
    <link media="all" type="text/css" rel="stylesheet" href="http://app-grad.mmsu.edu.ph/css/bootstrap.css">
    <link media="all" type="text/css" rel="stylesheet" href="http://app-grad.mmsu.edu.ph/css/jquery-ui.css">
    <link media="all" type="text/css" rel="stylesheet" href="http://app-grad.mmsu.edu.ph/css/jquery-ui.structure.css">
    <link media="all" type="text/css" rel="stylesheet" href="http://app-grad.mmsu.edu.ph/css/jquery-ui.theme.css">
    <link media="all" type="text/css" rel="stylesheet" href="http://app-grad.mmsu.edu.ph/css/personal.css">
    <!-- Scripts -->
    <script>
        window.Laravel = {"csrfToken":"c0p2pQfjuaQA2N1U5E0N7VrbMQwAT4pwE1n9hn1c"}    </script>
</head>
<body>

<form method="POST" action="http://app-grad.mmsu.edu.ph/form" accept-charset="UTF-8"><input name="_token" type="hidden" value="c0p2pQfjuaQA2N1U5E0N7VrbMQwAT4pwE1n9hn1c">
    <div class="form-group ">
        <div class="row">
            <div class="col-md-4">
                <label for="Student Number">Student Number</label>
                <input id="std" class="form-control" required="required" placeholder="Student Number" name="student_number" type="text">

            </div>
            <div class="col-md-8">
                <div>&nbsp;</div>
                <div id="err" style="display: none" class="alert alert-warning">You have already applied before just edit and print you application by
                    <a href="http://app-grad.mmsu.edu.ph/print">clicking me</a></storng></span>
                </div>
                <div id="er" style="display: none" class="alert alert-warning">Student Number to short must be seven or nine characters</div>
                <div id="er11" style="display: none" class="alert alert-warning">Wrong format of student number</div>
                <div id="er2" style="display: none" class="alert alert-warning">Student Number does not exist</div>
            </div>
        </div>

    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-4 col-md-4 ">
                <label for="Last Name">Last Name</label>
                <input class="form-control" required="required" placeholder="Last Name" id="lname" name="lname" type="text">
            </div>
            <div class="col-sm-4 col-md-4 ">
                <label for="First Name">First Name</label>
                <input class="form-control" required="required" placeholder="First Name" id="fname" name="fname" type="text">

            </div>
            <div class="col-sm-4 col-md-4 ">
                <label for="Middle Name">Middle Name</label>
                <input class="form-control" placeholder="Middle Name" id="mname" name="mname" type="text">

            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <input id="col" name="college" type="hidden">
            <div class="col-md-4 col-sm-4" id="de">
                <div class="form-group">
                    <input id="deg" name="degree" type="hidden">

                    <label for="Degree">Degree</label>
                    <select class="form-control" required="required" id="deg" disabled="disabled" name="degref"><option value="1">BS in Agriculture</option><option value="2">BS in Agricultural Engineering</option><option value="3">BS in Forestry</option><option value="4">BS in Development Communication</option><option value="5">BS in Home Technology</option><option value="6">BS in Marine Biology</option><option value="7">BS in Mathematics</option><option value="8">BS in Computer Science</option><option value="9">BS in Biology</option><option value="10">BS in Environmental Science</option><option value="11">AB in Sociology</option><option value="12">AB in English Studies (CA)</option><option value="13">BS in Accountancy</option><option value="14">BS in Economics</option><option value="15">BS in Business Administration (MM)</option><option value="16">BS in Agricultural Technology</option><option value="17">BS in Cooperative Management</option><option value="18">Bachelor in Secondary Education (English)</option><option value="19">Bachelor in Elementary Education</option><option value="20">BS in Civil Engineering</option><option value="21">BS in Electrical Engineering</option><option value="22">BS in Mechanical Engineering</option><option value="23">BS in Chemical Engineering</option><option value="24">BS in Ceramic Engineering</option><option value="25">BS in Computer Engineering</option><option value="26">BS in Electronics Engineering</option><option value="27">BS in Fisheries</option><option value="28">BS in Nursing</option><option value="29">BS in Physical Therapy</option><option value="30">BS in Pharmacy</option><option value="31">BS in Industrial Education</option><option value="32">BS in Industrial Technology</option><option value="33">Doctor of Philosophy</option><option value="34">Doctor of Education</option><option value="35">Master of Arts in Education</option><option value="36">Master of Education</option><option value="37">Master of Arts in Public Administration</option><option value="38">Master in Public Administration</option><option value="39">Master of Science in Rural Development</option><option value="40">Master of Rural Development</option><option value="41">Master of Arts in Nursing</option><option value="42">Master in Nursing</option><option value="43">Master of Science in Agriculture</option><option value="44">Master of Agriculture</option><option value="45">Master of Science in Agroforestry</option><option value="46">Graduate Diploma</option><option value="47">Short-Term Programs</option><option value="48">Bachelor of Agricultural Technology</option><option value="49">Diploma of Agricultural Technology</option><option value="50">Forest Ranger</option><option value="51">Technical Homemaking</option><option value="52">Associate  in Home Technology</option><option value="53">Associate in Technical Homemaking</option><option value="54">BS in Chemistry</option><option value="55">Diploma of Technology</option><option value="56">General Radio Communication Operator</option><option value="57">Certificate of Technology</option><option value="58">BS in Accounting Technology</option><option value="59">AB in English Language</option><option value="60">BS in Entrepreneurship</option><option value="61">BS in Business Administration (HRDM)</option><option value="62">BS in Tourism Management</option><option value="63">BS in Hospitality Management</option><option value="64">Bachelor in Automotive Technology</option><option value="65">B Technical Teachers Education</option><option value="66">Bachelor in Secondary Education (Filipino)</option><option value="67">Bachelor in Secondary Education (MAPEH)</option><option value="68">Bachelor in Secondary Education (SocStud)</option><option value="69">Bachelor in Secondary Education (TLE)</option><option value="70">Bachelor in Secondary Education (BioSci)</option><option value="71">Bachelor in Secondary Education (Math)</option><option value="72">Bachelor in Secondary Education (PhysSc)</option><option value="73">AB English Studies</option><option value="74">Bachelor of Laws</option><option value="75">BS in Business Administration (TM)</option><option value="76">BS in Business Administration (M)</option><option value="77">BS in Business Administration (MA)</option><option value="78">BS in Business Administration (Entrep)</option><option value="79">BS in Meteorology Engineering</option><option value="80">AB in English Studies (ESL)</option><option value="81">BS in Tourism Management (ISM)</option><option value="82">BS in Tourism Management (TTM)</option><option value="83">AB Communication</option><option value="84">BS in Industrial Technology (Computer Technology)</option><option value="85">BS in Industrial Technology (Garments Technology)</option><option value="86">BS in Industrial Technology (Food Technology)</option><option value="87">BS in Industrial Technology (Civil Technology)</option><option value="88">BS in Industrial Technology (Electrical Technology)</option><option value="89">BS in Industrial Technology (Electronics Technology)</option><option value="90">Bachelor of Technical Teacher Education (Garments, Fashion and Design)</option><option value="91">Bachelor of Technical Teacher Education (Drafting Technology)</option><option value="92">Bachelor of Technical Teacher Education (Computer Technology)</option><option value="93">Bachelor of Technical Teacher Education (Electronics Technology)</option><option value="94">Bachelor of Technical Teacher Education (Food and Service Management)</option><option value="95">Bachelor of Technical Teacher Education (Automotive Technology)</option><option value="96">-----</option><option value="97">BS in Fisheries Major in Aquaculture</option><option value="98">BS in Fisheries Major in Marine Fisheries</option><option value="99">BS in Fisheries Major in Fish Processing</option><option value="100">Bachelor of Agriculture Tech. Major in Animal Production</option><option value="101">Bachelor of Agriculture Tech. Major in Crop Production</option><option value="102">BS in Agri Business</option><option value="103">Bachelor in Elementary Education (SpEd)</option><option value="104">Bachelor in Elementary Education (Pre-School Ed)</option><option value="105">Bachelor in Elementary Education (Generalist)</option><option value="106">BS in Industrial Technology (Ref AC Technology)</option><option value="108">BS in Agriculture (Agricultural Ext)</option><option value="109">BS in Agriculture (Animal Science)</option><option value="110">BS in Agriculture (Horticulture)</option><option value="111">BS in Agriculture (Agronomy)</option><option value="112">BS in Agriculture (Soil Science)</option><option value="113">BS in Agriculture (Crop Protection)</option><option value="114">Doctor of Medicine</option><option value="115">BS in Industrial Technology (Ceramics Technology)</option><option value="116">BS in Industrial Technology (Electornics and Comm Tech)</option><option value="117">BS in Industrial Technology (Drafting Technology)</option><option value="118">Bachelor of Technical Teacher Education (Electrical Technology)</option><option value="119">Professional Education</option><option value="120">TCP</option></select>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- Scripts-->
<script src="http://app-grad.mmsu.edu.ph/js/jquery.js"></script>

<script src="http://app-grad.mmsu.edu.ph/js/bootstrap.js"></script>

<script src="http://app-grad.mmsu.edu.ph/js/jquery-ui.js"></script>


<script src="{{ asset('js/t7.js') }}"></script>

<script src="http://app-grad.mmsu.edu.ph/js/date.js"></script>

</body>
</html>

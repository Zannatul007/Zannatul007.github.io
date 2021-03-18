<!DOCTYPE html>
<html>

<head>
    <style>
        .front {}
        
        body {
            margin: 2% 25% 10% 25%;
            background-color: white;
            border: solid 1.5px #6f97ab;
            border-radius: 4px;
        }
        
        .title {
            color: #fff;
            background-color: #6f97ab;
            font-weight: bold;
            border-bottom: 1px solid #aaa;
            padding: 10px;
            text-align: center;
            border-radius: 4px;
            font-size: 30px;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            margin: 10px 10px 10px 10px;
        }
        
        .i {
            margin: 3% 5% 5% 5%;
            padding: 8px;
            font-size: 25px;
            background-color: white;
        }
        
        .Front {
            margin: 0px 10px 10px 10px;
            font-size: 15px;
            background-color: #eeeeeee0;
            border-radius: 4px;
            padding: 2px;
        }
    </style>
</head>

<body>
    <h2 class="title">Statistics Calculator</h2>
    <form method="post" action="process.php">
        <div class="Front">
            <h2 style="display: inline;">Enter the Data Set </h3><small>(Enter your input numbers seperated by comma)</small>
                <input class="i" type="text" name="number">
                <input type="submit" style="padding =3px; font-size:20px; background-color: #6f97ab4a; border-4adius:2px;" name="Submit" value="Calculate">
        </div>




    </form>


</body>

</html>
<html>
<head>
    <title>Filtering Form</title>
</head>
<body>
<form method="post" action="filter.php">
    <h3>Filter Reviews</h3>
    Order by rating <br />
    <select name="orderRating">
        <option value="Highest First">Highest First</option>
        <option value="Lowest First">Lowest First</option>
    </select><br/>
    Minimum rating: <br/>
    <select name="minRating">
        <option value="5">5</option>
        <option value="4">4</option>
        <option value="3">3</option>
        <option value="2">2</option>
        <option value="1">1</option>
    </select><br/>
    Order by date: <br/>
    <select name="orderDate">
        <option value="Newest First">Newest First</option>
        <option value="Oldest First">Oldest First</option>
    </select><br/>
    Prioritize by text:<br/>
    <select name="prioritizeText">
        <option value="Yes">Yes</option>
        <option value="No">No</option>
    </select><br/>

    <input type="submit" name="submit" value="Filter" />

</form>
</body>
</html>
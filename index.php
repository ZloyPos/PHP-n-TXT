<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Текстовый файл</title>
</head>
<body>
    <form method="post">
        <label for="first_name">Имя:</label><br>
        <input type="text" id="first_name" name="first_name" required pattern="[А-ЯЁа-яё]{2,100}"><br><br>
        <label for="birth_year">Год рождения:</label><br>
        <select name="birth_year">
            <?php
            foreach (range(1995,2005) as $year) { //Цикл создаёт несколько строк с <option> для диапазона чисел
                echo "<option value='$year'>$year</option>";
            }
            ?>
        </select><br>
        <label for="average_score">Средний балл:</label><br>
        <input type="number" id="average_score" name="average_score" step="any"><br><br>
        <button type="submit" name="submit">Отправить</button>
    </form>
    <table>
        <tr>
            <th>Имя</th>
            <th>Год рождения</th>
            <th>Средний балл</th>
        </tr>
        <?php
        if(isset($_POST["submit"])) {
            $first_name = $_POST["first_name"];
            $birth_year = $_POST["birth_year"];
            $average_score = $_POST["average_score"];

            $file = fopen("students_data.txt", "a");

            fputcsv($file, [$first_name, $birth_year, $average_score]);

            fclose($file);

            header("Location:index.php");
        }
        if (($handle = fopen("students_data.txt", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                echo "<tr>";
                foreach ($data as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            fclose($handle);
        }
        ?>
    </table>
</body>
</html>
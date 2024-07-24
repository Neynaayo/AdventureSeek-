<section id="edit-activities" class="page">
  <form action="search.php" method="post" autocomplete="off">
    <header class="search-bar">
      <input type="text" name="sportType" placeholder="Enter activity type" required>
      <button type="submit">SEARCH</button>
    </header>
    <section class="table-container">
      <table>
        <thead>
          <tr>
            <th>Activities Picture & Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Activities Type</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // PHP code for fetching and displaying activities
          include 'connectDB.php';
          $sql = "SELECT a.ActivityID, a.ActivityName, a.ActivityDescription, a.PriceChild, a.PriceAdult, l.SportType, l.pic
                  FROM activity a
                  JOIN location l ON a.LocationID = l.LocationID";
          $result = $link->query($sql);
          while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td><img src='img/" . $row['pic'] . "' alt='" . $row['ActivityName'] . "' class='activity-img'><br>" . $row['ActivityName'] . "</td>";
              echo "<td>" . $row['ActivityDescription'] . "</td>";
              echo "<td>Child: RM" . $row['PriceChild'] . "<br>Adult: RM" . $row['PriceAdult'] . "</td>";
              echo "<td>" . $row['SportType'] . "</td>";
              echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </section>
  </form>
</section>

        <section class="recipes-cards-section justify-content-center">
            <h4 class="display-6">Beliebte Rezepte</h4>
            <div class="container-fluid">
                <div class="recipe-grid container-fluid px-5 mt-5" id="featured-recipies-grid">
                    <?php
                        $conn = new DatabaseConnection($ini_array);
                        $result = $conn->query_database("SELECT * FROM recipie");
                        $rows = $result->fetch_all(MYSQLI_ASSOC);
                        foreach ($rows as $row) {


                            if ($row['image_path'] === null) {
                                echo '
                                <a href=' . $row['slug'] . '>
                                <div class="card" style="width: 18rem;">
                                  <div>
                                      <img src="img/icons/empty_plate.jpg" class="card-img-top card-img" alt="thumbnail">
                                  </div>
                                  <div class="card-body">
                                    <h5 class="card-title">' . htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . '</h5>
                                    <p class="card-text">' . htmlspecialchars(escape_newlines($row['description'], ENT_QUOTES, 'UTF-8')) . '</p>
                                  </div>
                                  <ul class="list-group list-group-flush">
                                      <li class="list-group-item">' . $conn->get_country_by_id($row['country'])['name'] . '</li>
                                  </ul>
                                </div>
                                </a>';
                            }
                            else {
                                echo '
                                <a href=/detail.php?recipie=' . $row['slug'] . '>
                                <div class="card" style="width: 18rem;">
                                  <div>
                                      <img src="img/useruploads/' . $row['image_path'] . '" class="card-img-top card-img" alt="thumbnail">
                                  </div>
                                  <div class="card-body">
                                    <h5 class="card-title">' . htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . '</h5>
                                    <p class="card-text">' . htmlspecialchars(escape_newlines($row['description'], ENT_QUOTES, 'UTF-8')) . '</p>
                                  </div>
                                  <ul class="list-group list-group-flush">
                                      <li class="list-group-item">' . $conn->get_country_by_id($row['country'])['name'] . '</li>
                                  </ul>
                                </div>
                                </a>';
                            }
                        }

                    ?>
                </div>
            </div>
        </section>

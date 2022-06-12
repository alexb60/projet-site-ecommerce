<?php
session_start();

require_once "../../../view/site/ViewTemplate.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Accueil");

// Si le client est connecté...
if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte(); // Header client connecté
} else {
  ViewTemplate::headerInvite(); // Header invité
}
?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mb-4">Conditions Générales de Ventes (CGV)</h2>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae odit corrupti cum fuga iste vel,
        provident officia cupiditate soluta repudiandae hic molestiae ex officiis. Odio corporis quos illo ullam
        delectus quis maiores iure in. Rerum cumque fuga autem eveniet numquam eligendi id ipsa perferendis repudiandae
        ratione, porro quidem eum aut possimus vel impedit alias ut. Rerum odit, itaque iure a ut officiis repellat tenetur
        est aspernatur doloremque vero molestiae omnis harum unde nesciunt! Cumque accusantium ducimus quae maxime, ut ullam
        dolor, porro maiores incidunt vel corporis sed quis eum laboriosam ad necessitatibus quos harum optio nemo laborum in
        voluptate ex reiciendis. Tempore aspernatur, reiciendis laboriosam perspiciatis architecto inventore, commodi, non
        recusandae deleniti cupiditate quisquam quibusdam beatae? Vero perspiciatis iusto illo aspernatur delectus est suscipit
        velit nobis reprehenderit accusantium? Eos architecto molestiae, vero aut molestias laboriosam voluptas dolorem veniam.
        Fugiat labore quibusdam, facilis atque vero ducimus tempora incidunt quas id velit?
      </p>
      <br />
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae odit corrupti cum fuga iste vel,
        provident officia cupiditate soluta repudiandae hic molestiae ex officiis. Odio corporis quos illo ullam
        delectus quis maiores iure in. Rerum cumque fuga autem eveniet numquam eligendi id ipsa perferendis repudiandae
        ratione, porro quidem eum aut possimus vel impedit alias ut. Rerum odit, itaque iure a ut officiis repellat tenetur
        est aspernatur doloremque vero molestiae omnis harum unde nesciunt! Cumque accusantium ducimus quae maxime, ut ullam
        dolor, porro maiores incidunt vel corporis sed quis eum laboriosam ad necessitatibus quos harum optio nemo laborum in
        voluptate ex reiciendis. Tempore aspernatur, reiciendis laboriosam perspiciatis architecto inventore, commodi, non
        recusandae deleniti cupiditate quisquam quibusdam beatae? Vero perspiciatis iusto illo aspernatur delectus est suscipit
        velit nobis reprehenderit accusantium? Eos architecto molestiae, vero aut molestias laboriosam voluptas dolorem veniam.
        Fugiat labore quibusdam, facilis atque vero ducimus tempora incidunt quas id velit?
      </p>
    </div>
  </div>
</div>
<?php
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html
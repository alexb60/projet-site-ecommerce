<?php
require_once '../../../model/ModelMessage.php';

class ViewMessage
{
  public static function ajoutMessageClient()
  {
?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Contact</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="col-md-6 offset-md-3">
            <div class="form-group">
              <label for="motif">Motif :</label>
              <select name="motif" id="motif" class="form-control">
                <option value="" selected disabled>Choisissez un motif de contact</option>
                <option value="Réclamation">Réclamation</option>
                <option value="Suggestion">Suggestion</option>
                <option value="Question">Poser une question</option>
              </select>
            </div>
            <div class="form-group">
              <label for="message">Message :</label>
              <textarea name="message" id="message" class="form-control" cols="30" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary" name="ajout" id="valider">Envoyer</button>
            <button type="reset" class="btn btn-danger">Réinitialiser</button>
          </form>
        </div>
      </div>
    </div>
<?php
  }
}
